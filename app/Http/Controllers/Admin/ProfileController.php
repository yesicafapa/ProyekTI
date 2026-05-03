<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        return view('pages.profile', ['user' => Auth::user()]); 
    }

    /**
     * Memperbarui data profil dan login.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'nama'          => 'required|string|max:100',
            'email'         => 'required|email|unique:user,email,' . $user->id, 
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            
            // LOGIKA FIX: 
            // password_lama wajib diisi (required) HANYA JIKA kolom 'password' (password baru) diisi.
            'password_lama' => [
                $request->filled('password') ? 'required' : 'nullable',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value && !Hash::check($value, $user->password)) {
                        $fail('Password lama yang Anda masukkan salah!');
                    }
                },
            ],
            'password'      => 'nullable|confirmed|min:8', 
        ], [
            'password_lama.required' => 'Password lama wajib diisi untuk verifikasi perubahan password!',
            'password.confirmed'     => 'Konfirmasi password baru tidak cocok!',
            'password.min'           => 'Password minimal harus 8 karakter!',
        ]);

        // 2. Eksekusi Logika di Model
        // Panggil method updateUser di Model User
        if (!$user->updateUser($request)) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil!');
        }

        // 3. Jika Berhasil
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}