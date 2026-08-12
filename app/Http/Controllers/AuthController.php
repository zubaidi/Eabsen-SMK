<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        // Jika user sudah login, langsung lempar ke dasbor
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login'); // Nanti kita buat view-nya
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email dan password cocok, dan pastikan status_aktif = true
        if (Auth::attempt(array_merge($credentials, ['status_aktif' => true]))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah, atau akun Anda dinonaktifkan.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
