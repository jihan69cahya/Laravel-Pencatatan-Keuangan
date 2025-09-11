<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $rolesName = Auth::user()->role;
            return response([
                'message' => 'Berhasil Login!',
                'route' => route("dashboard.{$rolesName}")
            ], 200);
        }

        $exists = User::where('email', $request->email)->exists();
        return response($exists ? 'Password Salah' : 'Email tidak terdaftar', 401);
    }

    public function index_register()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'telp'     => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'pengguna',
                'telp' => $validated['telp'],
            ]);

            DB::commit();

            return response([
                'message' => 'Berhasil Registrasi!',
                'route' => route("login")
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response('Gagal melakukan register', 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')->with('message', 'Berhasil Logout');
    }
}
