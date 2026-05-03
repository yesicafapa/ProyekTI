<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Tambahkan import model User

class LoginController extends Controller
{
    public function showLoginForm() 
    {
        return view('pages.auth.signin'); 
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Ambil input email & password
        $credentials = $request->only('email', 'password');

        // 2. Tambahkan syarat: Status harus 1 (Aktif)
        $credentials['status'] = 1;

        // 3. Proses Attempt Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard')); 
        }

        // 4. Logika Pesan Error Spesifik (Jika user ada tapi tidak aktif)
        $user = User::where('email', $request->email)->first();
        
        if ($user && $user->status != 1) {
            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi Super Admin.',
            ])->onlyInput('email');
        }

        // Error default jika password/email salah
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