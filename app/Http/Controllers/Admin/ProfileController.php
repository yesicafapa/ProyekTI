<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User; 

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        return view('pages.profile', compact('user')); 
    }

    /**
     * Memperbarui data profil dan login.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi
        // Pastikan 'unique:user' sesuai dengan nama tabel di database kamu
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:user,email,' . $user->id, 
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|confirmed|min:8', 
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'password.min' => 'Password minimal harus 8 karakter!',
        ]);

        // 2. Update Nama dan Email
        $user->nama = $request->nama;
        $user->email = $request->email;

        // 3. Logic Password: Hanya di-hash dan diupdate jika kolom diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Logic Foto: Hapus foto lama jika ada sebelum simpan yang baru
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            // Simpan ke storage/app/public/profile
            $user->foto = $request->file('foto')->store('profile', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}