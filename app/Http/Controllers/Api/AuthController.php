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
            $id = auth::user()->id;
            $user = User::find($id);

            if (!empty($request->current_password)) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Password saat ini tidak sesuai.',
                    ], 422);
                }
            }

            $check_email = User::where('email', $request->email)->where('id', '!=', $id)->count();
            if ($check_email > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan anggota lain.',
                ], 422);
            }

            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'telp' => $request->telp ?? null,
            ];

            if (!empty($request->new_password)) {
                $updateData['password'] = Hash::make($request->new_password);
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
