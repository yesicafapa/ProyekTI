<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Contact; // Memastikan model Contact ter-import dengan benar

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan data otomatis khusus untuk komponen dropdown notifikasi
        View::composer('components.header.notification-dropdown', function ($view) {
            
            // Membuat base query untuk menyaring pesan yang BELUM direspon
            // Mengantisipasi jika nilai di database berupa string kosong '', angka 0 (false), atau NULL
            $unreadQuery = Contact::where(function ($query) {
                $query->where('is_responded', '')
                      ->orWhere('is_responded', false)
                      ->orWhereNull('is_responded');
            });

            // 1. Hitung jumlah total kontak yang belum direspon
            // Menggunakan (clone) agar tidak mengganggu query utama di bawahnya
            $unreadCount = (clone $unreadQuery)->count();
            
            // 2. Ambil 5 data pesan terbaru yang belum direspon untuk di-looping
            $notifications = $unreadQuery->latest()
                                         ->take(5)
                                         ->get();

            // Kirim kedua data tersebut ke file blade dropdown secara aman
            $view->with(compact('unreadCount', 'notifications'));
        });
    }
}