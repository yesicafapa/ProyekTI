<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        // Mengambil semua data testimoni untuk ditampilkan di Tabel Admin
        $testimonis = Testimoni::latest()->get();
        return view('pages.admin.testimoni', compact('testimonis'));
    }

    public function store(Request $request)
    {
        // Memanggil static method dari Model
        Testimoni::simpanTestimoni($request);
        return redirect()->back()->with('success', 'Testimoni Berhasil Ditambah!');
    }

    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->updateTestimoni($request);
        return redirect()->back()->with('success', 'Testimoni Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->hapusTestimoni();
        return redirect()->back()->with('success', 'Testimoni Berhasil Dihapus!');
    }
}