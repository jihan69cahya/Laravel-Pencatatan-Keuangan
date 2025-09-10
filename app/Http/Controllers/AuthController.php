<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Berhasil Logout');
    }
}
