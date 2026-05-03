<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini di atas

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('pages.admin.user-management', compact('users'));
    }

    public function store(Request $request)
    {
        User::simpanUser($request);
        return redirect()->back()->with('success', 'Admin Berhasil Ditambah!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->updateUser($request);
        return redirect()->back()->with('success', 'Data Admin Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->hapusUser();
        return redirect()->back()->with('success', 'Admin Berhasil Dihapus!');
    }

    /**
     * Fitur Baru: Toggle Status Aktif/Non-Aktif
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Menggunakan Auth::id() agar Intelephense tidak error
        if (Auth::id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menonaktifkan akun sendiri!');
        }

        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Status Admin Berhasil Diperbarui!');
    }
}