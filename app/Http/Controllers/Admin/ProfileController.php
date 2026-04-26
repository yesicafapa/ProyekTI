<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // FIX: password_lama WAJIB diisi (required) agar tidak bisa bypass password lama
            'password_lama' => 'required', 
            'password'      => 'nullable|confirmed|min:8', 
        ], [
            'password_lama.required' => 'Password lama wajib diisi untuk verifikasi keamanan!',
            'password.confirmed'     => 'Konfirmasi password baru tidak cocok!',
            'password.min'           => 'Password minimal harus 8 karakter!',
        ]);

        // 2. Eksekusi Logika di Model
        // Jika return false (karena Hash::check gagal di Model), kirim error
        if (!$user->updateUser($request)) {
            return back()->with('error', 'Password lama yang Anda masukkan salah!');
        }

        // 3. Jika Berhasil
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}