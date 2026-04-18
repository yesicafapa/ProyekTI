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
| 1. FRONTEND ROUTES (DATABASE DRIVEN)
|--------------------------------------------------------------------------
*/

// Halaman Home Utama
Route::get('/', function () {
    $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(5)->get(); 
    $portofolios = \App\Models\Portofolio::latest()->take(6)->get();
    $faqs = \App\Models\Faq::all(); 
    $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
    
    return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
})->name('home');

// --- START FRONTEND GROUP ---
Route::prefix('frontend')->name('frontend.')->group(function () {
    
    // List Portofolio
    Route::get('/portofolio', function () {
        $portofolios = \App\Models\Portofolio::latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get(); 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $faqs = \App\Models\Faq::all();
        return view('pages.frontend.sections.portfolio', compact('portofolios', 'artikels', 'testimonis', 'faqs'));
    })->name('portofolio.index');

    // Detail Portofolio - FIXED ALL ERRORS
    Route::get('/portofolio/{id}', function ($id) {
        $portofolio = \App\Models\Portofolio::findOrFail($id);
        
        // Mengambil semua data pendukung karena template detail meng-include section lain
        $portofolios = \App\Models\Portofolio::latest()->get(); 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get();
        $faqs = \App\Models\Faq::all(); 

        return view('pages.frontend.sections.portfolio_detail', compact(
            'portofolio', 
            'portofolios', 
            'testimonis', 
            'artikels',
            'faqs'
        ));
    })->name('portofolio.detail');

    // FIX HALAMAN LIST BLOG: Mengambil data asli database
    Route::get('/blog', function () {
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->paginate(9);
        return view('pages.frontend.sections.blog', compact('artikels'));
    })->name('blog.index');

    // 2. DETAIL BLOG: FIX URL & QUERY
    // Cukup pakai '/blog/{id}', karena sudah dibungkus prefix 'frontend'
    Route::get('/blog/{id}', function ($id) {
        // Gunakan findOrFail agar kalau ID tidak ada langsung muncul 404 (bukan error SQL)
        $artikel = \App\Models\Artikel::findOrFail($id);
        
        // Ambil artikel lain untuk section "More Insights"
        $artikels = \App\Models\Artikel::where('id', '!=', $id)
                                    ->where('status', 1) 
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('pages.frontend.sections.blog_detail', compact('artikel', 'artikels'));
    })->name('blog.detail'); // Nama route jadi frontend.blog.detail

    // Rute Kontak (Tetap menggunakan database)
    Route::get('/contact-us', function () {
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get();
        return view('pages.frontend.sections.contact', compact('testimonis', 'artikels'));
    })->name('contact');

    Route::post('/contact-send', function (\Illuminate\Http\Request $request) {
        return redirect()->route('frontend.contact.success');
    })->name('contact.send');

    Route::get('/contact-success', function () {
        return view('pages.frontend.sections.contact_success');
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