<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Portofolio;
use App\Models\Faq;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // 1. Ambil 2 Artikel terbaru (Status 1 berarti Terbit/Aktif)
        $artikels = Artikel::where('status', 1)
                            ->latest()
                            ->take(2)
                            ->get(); 

        // 2. Ambil semua Portofolio terbaru
        $portofolios = Portofolio::latest()->get();

        // 3. Ambil semua FAQ
        $faqs = Faq::all();

        // 4. Ambil 2 Testimoni terbaru (Hanya yang statusnya aktif jika ada kolom status)
        $testimonis = Testimoni::latest()
                                ->take(2)
                                ->get();

        // Mengirim data ke view index (hitam-orange)
        return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
    }

    public function showPortofolio($id)
    {
        // Mencari portofolio berdasarkan ID, jika tidak ketemu akan muncul error 404
        $porto = Portofolio::findOrFail($id);
        
        // Mengirim ke view detail portofolio
        return view('pages.frontend.portofolio-detail', compact('porto'));
    }
}