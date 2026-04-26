<?php

namespace App\View\Components\header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Contact; // Import model Contact kamu

class NotificationDropdown extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        // Ambil 5 pesan terbaru yang statusnya belum direspon
        $notifications = Contact::where('is_responded', false)
            ->latest()
            ->take(5)
            ->get();

        // Hitung total pesan yang belum direspon untuk badge angka
        $unreadCount = Contact::where('is_responded', false)->count();

        return view('components.header.notification-dropdown', compact('notifications', 'unreadCount'));
    }
}