<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('contents_pengguna.profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        $id = Auth::user()->id;

        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'telp'  => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            User::where('id', $id)->update([
                'name'  => $validated['name'],
                'email' => $validated['email'],
                'telp'  => $validated['telp'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Profile berhasil diperbarui'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editPassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'password_lama' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if (!Hash::check($validated['password_lama'], $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah']);
        }

        DB::beginTransaction();
        try {

            User::where('id', $user->id)->update([
                'password' => Hash::make($validated['password'])
            ]);

            DB::commit();
            return back()->with('success', 'Password berhasil diupdate!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }
}
