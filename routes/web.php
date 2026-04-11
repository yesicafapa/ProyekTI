<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Testimoni;
use App\Http\Controllers\Admin\{
    UserController, ArtikelController, PortofolioController, 
    TestimoniController, FaqController, ContactController, ProfileController
};

/*
|--------------------------------------------------------------------------
| 1. FRONTEND DATA HELPER (DUMMY DATA)
|--------------------------------------------------------------------------
*/

if (!function_exists('getDummyData')) {
    function getDummyData() {
        return [
            'portofolios' => collect([
                (object)[
                    'judul' => 'Psikotes Gratis',
                    'slug' => 'psikotes-gratis',
                    'deskripsi' => 'Pengembangan sistem ujian psikotes berbasis web untuk mempermudah proses penilaian secara digital dan akurat.',
                    'gambar' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068',
                    'link' => '#',
                    'created_at' => now()->subDays(10)
                ],
                (object)[
                    'judul' => 'SIAKAD PNM',
                    'slug' => 'siakad-pnm',
                    'deskripsi' => 'Solusi manajemen akademik terpadu untuk pengelolaan data mahasiswa dan kurikulum pendidikan secara efisien.',
                    'gambar' => 'https://images.unsplash.com/photo-1454165833762-0102b282f06b?q=80&w=2070',
                    'link' => '#',
                    'created_at' => now()->subMonths(2)
                ],
                (object)[
                    'judul' => 'SEO Optimization',
                    'slug' => 'seo-optimization',
                    'deskripsi' => 'Meningkatkan trafik website hingga 200% dengan teknik SEO modern dan optimasi keyword yang tepat.',
                    'gambar' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015',
                    'link' => '#',
                    'created_at' => now()->subMonths(5)
                ]
            ]),
            'artikels' => collect([
                (object)[
                    'id' => 1,
                    'judul' => 'Masa Depan AI di Tahun 2026',
                    'slug' => 'masa-depan-ai',
                    'konten' => '<p>Teknologi AI semakin berkembang pesat dan mulai menggeser cara kerja konvensional di industri kreatif.</p>',
                    'thumbnail' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=2070',
                    'created_at' => now()
                ],
                (object)[
                    'id' => 2,
                    'judul' => 'Optimasi Website Modern 2026',
                    'slug' => 'optimasi-website-2026',
                    'konten' => '<p>Bagaimana cara menjaga performa website tetap stabil dengan teknologi caching terbaru.</p>',
                    'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072',
                    'created_at' => now()->subDays(2)
                ],
                (object)[
                    'id' => 3,
                    'judul' => 'Keamanan Siber untuk Bisnis',
                    'slug' => 'keamanan-siber-bisnis',
                    'konten' => '<p>Langkah praktis melindungi data perusahaan dari serangan siber di era digital modern.</p>',
                    'thumbnail' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070',
                    'created_at' => now()->subDays(5)
                ]
            ])
        ];
    }
}

/*
|--------------------------------------------------------------------------
| 2. FRONTEND ROUTES (FIXED)
|--------------------------------------------------------------------------
*/

// Halaman Home Utama
Route::get('/', function () {
    $data = getDummyData();
    $portofolios = $data['portofolios']->take(6);
    $artikels = $data['artikels']->take(3); 
    $faqs = \App\Models\Faq::all(); 
    $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
    
    return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
})->name('home');

// --- START FRONTEND GROUP ---
Route::prefix('frontend')->name('frontend.')->group(function () {
    
    Route::get('/portofolio', function () {
        $data = getDummyData();
        $portofolios = $data['portofolios'];
        $artikels = $data['artikels']; 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        return view('pages.frontend.sections.portfolio', compact('portofolios', 'artikels', 'testimonis'));
    })->name('portofolio.index');

    Route::get('/portofolio/{slug}', function ($slug) {
        $data = getDummyData();
        $portofolio = $data['portofolios']->firstWhere('slug', $slug);
        $artikels = $data['artikels']; 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        if (!$portofolio) abort(404);
        return view('pages.frontend.sections.portfolio_detail', compact('portofolio', 'artikels', 'testimonis'));
    })->name('portofolio.detail');

    Route::get('/blog', function () {
        $data = getDummyData();
        $artikels = $data['artikels'];
        $portofolios = $data['portofolios'];
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        return view('pages.frontend.sections.blog', compact('artikels', 'portofolios', 'testimonis'));
    })->name('blog.index');

    Route::get('/blog/{slug}', function ($slug) {
        $data = getDummyData();
        $artikel = $data['artikels']->firstWhere('slug', $slug);
        $artikels = $data['artikels']; 
        $portofolios = $data['portofolios'];
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        if (!$artikel) abort(404);
        return view('pages.frontend.sections.blog_detail', compact('artikel', 'artikels', 'portofolios', 'testimonis'));
    })->name('blog.detail');

    // Rute Utama Halaman Kontak
    // 1. Halaman Form Kontak
    // Nama lengkap rute ini: frontend.contact
    Route::get('/contact-us', function () {
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $data = getDummyData(); 
        return view('pages.frontend.sections.contact', [
            'testimonis' => $testimonis,
            'artikels' => $data['artikels'] ?? [],
            'portofolios' => $data['portofolios'] ?? []
        ]);
    })->name('contact');

    // 2. Proses Submit (Bypass Controller agar tidak error method store)
    // Nama lengkap rute ini: frontend.contact.send
    Route::post('/contact-send', function (\Illuminate\Http\Request $request) {
        // Logika simpan data bisa ditaruh di sini nanti
        return redirect()->route('frontend.contact.success');
    })->name('contact.send');

    // 3. Halaman Sukses
    // Nama lengkap rute ini: frontend.contact.success
    Route::get('/contact-success', function () {
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $data = getDummyData(); 
        return view('pages.frontend.sections.contact_success', [
            'testimonis' => $testimonis,
            'artikels' => $data['artikels'] ?? [],
            'portofolios' => $data['portofolios'] ?? []
        ]);
    })->name('contact.success');

}); // <--- PENUTUP FRONTEND GROUP YANG TADI HILANG

/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES (MANAGEMENT)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('management')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('pages.dashboard.ecommerce'); 
    })->name('dashboard');

    Route::resource('user-management', UserController::class)->names('user-management');
   
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    Route::resource('portofolio', PortofolioController::class)->except(['show']);
    Route::resource('testimoni', TestimoniController::class)->except(['show']);
    Route::resource('faq', FaqController::class)->except(['show']);

    Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{id}/status', 'updateStatus')->name('updateStatus');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });
});