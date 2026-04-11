<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::with('user')->latest()->get();
        return view('pages.admin.portofolio', compact('portofolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jembatan ke Model
        Portofolio::storeData($request);
        
        return redirect()->route('portofolio.index')->with('success', 'Berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jembatan ke Model
        $portofolio->updateData($request);

        return redirect()->route('portofolio.index')->with('success', 'Berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        
        // Jembatan ke Model
        $portofolio->drop();

        return redirect()->route('portofolio.index')->with('success', 'Berhasil dihapus!');
    }
}