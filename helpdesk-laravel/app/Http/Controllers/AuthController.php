<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('faq.daftar'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Menampilkan form buat akun (Register)
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses pembuatan akun baru dengan role otomatis 'user'
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('faq.daftar')->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->username . '.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('faq.daftar');
    }
}
