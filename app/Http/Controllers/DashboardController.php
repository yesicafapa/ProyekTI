<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Portofolio;
use App\Models\Testimoni;
use App\Models\Faq;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data asli dari DB
        $data = [
            'total_artikel'    => Artikel::count(),
            'total_portofolio' => Portofolio::count(),
            'total_testimoni'  => Testimoni::count(),
            'total_faq'        => Faq::count(),
            'pesan_masuk'      => Contact::count(),
        ];

        return view('pages.dashboard.ecommerce', $data);
    }
}