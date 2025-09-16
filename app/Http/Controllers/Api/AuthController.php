<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->email == '' || $request->password == '') {
            return response()->json([
                'message' => 'Harap diisi email dan password.'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak terdaftar.'
            ], 401);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password yang anda masukkan salah.'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $nama = $request->nama;
            $email = $request->email;
            $telp = $request->telp;
            $password = $request->password;

            if (User::where('email', $email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah terdaftar.'
                ], 409);
            }

            $user = User::create([
                'name' => $nama,
                'email' => $email,
                'telp' => $telp,
                'password' => Hash::make($password),
                'role' => 'pengguna',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil.',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function profile()
    {
        $data = User::find(Auth::user()->id);
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth::user()->id,
                'telp' => 'nullable|string|max:20',
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|required_with:current_password|confirmed|min:8',
                'new_password_confirmation' => 'nullable|required_with:new_password',
            ], [
                'name.required' => 'Nama lengkap harus diisi.',
                'name.max' => 'Nama lengkap maksimal 255 karakter.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
                'telp.max' => 'Nomor telepon maksimal 20 karakter.',
                'current_password.required_with' => 'Password saat ini harus diisi untuk mengubah password.',
                'new_password.required_with' => 'Password baru harus diisi.',
                'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
                'new_password.min' => 'Password baru minimal 8 karakter.',
                'new_password_confirmation.required_with' => 'Konfirmasi password baru harus diisi.',
            ]);

            $id = auth::user()->id;
            $user = User::find($id);

            if (!empty($validatedData['current_password'])) {
                if (!Hash::check($validatedData['current_password'], $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password saat ini tidak sesuai.',
                        'errors' => ['current_password' => ['Password saat ini tidak sesuai.']]
                    ], 422);
                }
            }

            $updateData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'telp' => $validatedData['telp'] ?? null,
            ];

            if (!empty($validatedData['new_password'])) {
                $updateData['password'] = Hash::make($validatedData['new_password']);
            }

            $user->name = $updateData['name'];
            $user->email = $updateData['email'];
            $user->telp = $updateData['telp'];

            if (isset($updateData['password'])) {
                $user->password = $updateData['password'];
            }

            $user->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui',
            ], 200);
        } catch (ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
