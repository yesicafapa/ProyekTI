<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk dari pengunjung
     */
    public function index()
    {
        // Mengambil pesan terbaru
        $messages = Contact::latest()->get(); 
        return view('pages.admin..contact', compact('messages'));
    }

    /**
     * Mengubah status is_responded (0 jadi 1 atau sebaliknya)
     */
    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Memanggil logika toggle yang ada di Model
        $contact->toggleResponse();

        return back()->with('success', 'Status respon berhasil diperbarui!');
    }

    /**
     * Menghapus pesan
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * TENTANG: Method untuk simulasi kiriman form (DATA DUMMY)
     * Bagian simpan ke database dimatikan agar tidak error MySQL.
     */
    public function send(Request $request)
    {
        // 1. Validasi input agar form tidak kosong
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required',
            'address' => 'required',
            'message' => 'required',
        ]);

        // 2. DATA DUMMY MODE:
        // Kita tidak menjalankan Contact::create agar tidak bentrok dengan tabel MySQL.
        // Cukup biarkan kosong di sini atau Anda bisa log data jika ingin cek.

        // 3. Langsung lempar ke halaman sukses zigzag yang sudah dibuat di web.php
        return redirect()->route('frontend.contact.success');
    }
}