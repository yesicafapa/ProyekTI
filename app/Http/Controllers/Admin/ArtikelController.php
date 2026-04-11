<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('user')->latest()->get();
        return view('pages.admin.artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:512',
            'ringkasan' => 'required',
            'isi' => 'required',
            'status' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Langsung panggil fungsi di Model, urusan siapa yang login biar Model yang urus
        Artikel::storeData($request);
        return redirect()->back()->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|max:512',
            'ringkasan' => 'required',
            'isi' => 'required',
            'status' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $artikel->updateData($request);
        return redirect()->back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->deleteWithImage();
        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }
}