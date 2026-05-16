<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Testimoni;
use App\Http\Controllers\Admin\{
    UserController, ArtikelController, PortofolioController, 
    TestimoniController, FaqController, ContactController, ProfileController
};

/*
|--------------------------------------------------
| 1. FRONTEND ROUTES (Sisi Pengunjung) - URL
|--------------------------------------------------
*/

// Halaman Home Utama
Route::get('/', function () {
    $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(5)->get(); 
    $portofolios = \App\Models\Portofolio::latest()->take(6)->get();
    $faqs = \App\Models\Faq::all(); 
    $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
    
    return view('pages.frontend.index', compact('artikels', 'portofolios', 'faqs', 'testimonis'));
})->name('home');

Route::name('frontend.')->group(function () {
    
    // List Portofolio -> URL 
    Route::get('/portofolio', function () {
        $portofolios = \App\Models\Portofolio::latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get(); 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $faqs = \App\Models\Faq::all();
        return view('pages.frontend.sections.portfolio', compact('portofolios', 'artikels', 'testimonis', 'faqs'));
    })->name('portofolio.index');

    // Detail Portofolio -> URL 
    Route::get('/portofolio/{id}', function ($id) {
        $portofolio = \App\Models\Portofolio::findOrFail($id);
        $portofolios = \App\Models\Portofolio::latest()->get(); 
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get();
        $faqs = \App\Models\Faq::all(); 

        return view('pages.frontend.sections.portfolio_detail', compact(
            'portofolio', 'portofolios', 'testimonis', 'artikels', 'faqs'
        ));
    })->name('portofolio.detail');

    // List Blog -> URL 
    Route::get('/blog', function () {
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->paginate(9);
        return view('pages.frontend.sections.blog', compact('artikels'));
    })->name('blog.index');

    // Detail Blog -> URL 
    Route::get('/blog/{id}', function ($id) {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $artikels = \App\Models\Artikel::where('id', '!=', $id)
                                    ->where('status', 1) 
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('pages.frontend.sections.blog_detail', compact('artikel', 'artikels'));
    })->name('blog.detail');

    // Halaman Kontak
    Route::get('/contact-us', function () {
        $testimonis = \App\Models\Testimoni::where('status', 1)->latest()->get();
        $artikels = \App\Models\Artikel::where('status', 1)->latest()->take(3)->get();
        return view('pages.frontend.sections.contact', compact('testimonis', 'artikels'));
    })->name('contact');

    // Proses Kirim Pesan
    Route::post('/contact-send', [ContactController::class, 'send'])->name('contact.send');

    // Halaman Sukses
    Route::get('/contact-success', function () {
        return view('pages.frontend.sections.contact_success');
    })->name('contact.success');
});

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

    // --- USER MANAGEMENT ---
    Route::resource('user-management', UserController::class)->names('user-management');
    Route::patch('/user-management/{id}/toggle', [UserController::class, 'toggleStatus'])->name('user-management.toggle');
   
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    Route::resource('portofolio', PortofolioController::class)->except(['show']);
    Route::resource('testimoni', TestimoniController::class)->except(['show']);
    Route::resource('faq', FaqController::class)->except(['show']);

    Route::controller(App\Http\Controllers\Admin\ContactController::class)->group(function () {
        
        // PINTU 1: Nama rute pakai 'admin.contact.' (Untuk tombol di tabel Blade)
        Route::prefix('contact')->name('admin.contact.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/{id}/status', 'updateStatus')->name('updateStatus');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // PINTU 2: Nama rute tanpa 'admin.' (Untuk Sidebar / MenuHelper)
        Route::name('contact.')->group(function () {
            Route::get('/contact', 'index')->name('index');
            Route::patch('/contact/{id}/status', 'updateStatus')->name('updateStatus');
            Route::delete('/contact/{id}', 'destroy')->name('destroy');
        });
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });
});