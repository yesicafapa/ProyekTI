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
        // 1. Ambil 5 Artikel terbaru (Hanya status 1)
        $artikels = Artikel::where('status', 1)
                            ->latest()
                            ->take(5) 
                            ->get(); 

        // 2. Ambil semua Portofolio (Hanya status 1)
        $portofolios = Portofolio::where('status', 1)
                                  ->latest()
                                  ->get();

        // 3. FIX: Ambil FAQ (Hanya status 1) biar Draft tidak muncul
        $faqs = Faq::where('status', 1)->get();

        // 4. Ambil 2 Testimoni terbaru (Pastikan di database juga ada kolom status jika perlu)
        $testimonis = Testimoni::latest()
                                ->take(2)
                                ->get();

        return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
    }

    /**
     * Halaman Daftar Semua Blog
     */
    public function blog()
    {
        $artikels = Artikel::where('status', 1)
                            ->latest()
                            ->paginate(9); 

        return view('pages.frontend.sections.blog', compact('artikels'));
    }

    /**
     * Halaman Isi Detail Blog
     */
    public function blogDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)->where('status', 1)->firstOrFail();

        $related_artikels = Artikel::where('id', '!=', $artikel->id)
                                    ->where('status', 1)
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('pages.frontend.sections.blog_detail', compact('artikel', 'related_artikels'));
    }

    /**
     * Halaman Isi Detail Portofolio
     */
    public function showPortofolio($id)
    {
        // Proteksi agar ID yang statusnya 0 tidak bisa dibuka paksa via URL
        $portofolio = Portofolio::where('status', 1)->findOrFail($id);
        
        // Ambil list portofolio lain untuk section di bawah (Hanya status 1)
        $portofolios = Portofolio::where('status', 1)->latest()->get();

        return view('pages.frontend.portofolio-detail', compact('portofolio', 'portofolios'));
    }
}