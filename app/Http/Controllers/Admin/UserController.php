<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data user untuk ditampilkan di Tabel Admin
        $users = User::latest()->get();
        return view('pages.admin.user-management', compact('users'));
    }

    public function store(Request $request)
    {
        // Memanggil static method dari Model User untuk simpan data
        User::simpanUser($request);
        return redirect()->back()->with('success', 'Admin Berhasil Ditambah!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Memanggil method dari instance model untuk update data
        $user->updateUser($request);
        return redirect()->back()->with('success', 'Data Admin Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Memanggil method untuk hapus data & foto
        $user->hapusUser();
        return redirect()->back()->with('success', 'Admin Berhasil Dihapus!');
    }
}