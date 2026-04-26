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
        // 1. Ambil 5 Artikel terbaru (Hanya yang Publish / Status 1)
        $artikels = Artikel::where('status', 1)
                            ->latest()
                            ->take(5) 
                            ->get(); 

        // 2. Ambil semua Portofolio (Hanya yang Publish / Status 1)
        // PASTIKAN di phpMyAdmin, data 'Psikotes Gratis' statusnya adalah 0
        $portofolios = Portofolio::where('status', 1)
                                  ->latest()
                                  ->get();

        // 3. Ambil FAQ (Hanya yang Publish / Status 1)
        $faqs = Faq::where('status', 1)->get();

        // 4. Ambil 2 Testimoni terbaru (Tambahkan filter status jika ada kolomnya di ERD)
        $testimonis = Testimoni::where('status', 1) // Tambahkan ini jika ada kolom status di tabel testimoni
                                ->latest()
                                ->take(2)
                                ->get();

        return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
    }

    public function blog()
    {
        // Menampilkan daftar artikel dengan pagination
        $artikels = Artikel::where('status', 1)
                            ->latest()
                            ->paginate(9); 

        return view('pages.frontend.sections.blog', compact('artikels'));
    }

    public function blogDetail($slug)
    {
        // Pastikan artikel yang dicari melalui slug juga harus berstatus Publish
        $artikel = Artikel::where('slug', $slug)->where('status', 1)->firstOrFail();

        $related_artikels = Artikel::where('id', '!=', $artikel->id)
                                    ->where('status', 1)
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('pages.frontend.sections.blog_detail', compact('artikel', 'related_artikels'));
    }

    public function showPortofolio($id)
    {
        // Jika pengunjung iseng ganti ID di URL ke data Draft, Laravel akan kasih error 404 (Bagus untuk keamanan)
        $portofolio = Portofolio::where('status', 1)->findOrFail($id);
        
        $portofolios = Portofolio::where('status', 1)->latest()->get();

        return view('pages.frontend.portofolio-detail', compact('portofolio', 'portofolios'));
    }
}