<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() 
    {
        // Pastikan file ini ada di resources/views/pages/auth/signin.blade.php
        return view('pages.auth.signin'); 
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    
    // Memastikan redirect ke route 'dashboard' (yang sekarang /management/dashboard)
    return redirect()->intended(route('dashboard')); 
}

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}