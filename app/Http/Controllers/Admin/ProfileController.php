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
        // Langsung ambil user yang sedang login
        return view('pages.profile', ['user' => Auth::user()]); 
    }

    /**
     * Memperbarui data profil dan login.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi Input (Tetap di Controller)
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:user,email,' . $user->id, 
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Tambah webp agar modern
            'password' => 'nullable|confirmed|min:8', 
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'password.min' => 'Password minimal harus 8 karakter!',
        ]);

        // 2. Eksekusi Logika di Model (Thin Controller)
        // Kita panggil fungsi updateUser yang sudah kita buat di Model tadi
        if (!$user->updateUser($request)) {
            // Jika return false, berarti password lama salah
            return back()->with('error', 'Password lama yang Anda masukkan salah!');
        }

        // 3. Berhasil
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}