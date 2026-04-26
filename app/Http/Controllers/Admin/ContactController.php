<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk di Panel Admin
     */
    public function index()
    {
        $messages = Contact::latest()->get(); 
        return view('pages.admin.contact', compact('messages'));
    }

    /**
     * Mengubah status is_responded (0 jadi 1 atau sebaliknya)
     */
    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Cara manual agar tidak error jika fungsi toggleResponse() di Model belum ada
        $contact->is_responded = !$contact->is_responded;
        $contact->save();

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
     * MENGHUBUNGKAN FRONTEND KE DATABASE
     */
    public function send(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email',
            'telepon' => 'required',
            'alamat'  => 'required',
            'pesan'   => 'required',
        ]);

        Contact::create([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
            'pesan'   => $request->pesan,
            'is_responded' => 0 
        ]);

        return redirect()->route('frontend.contact.success')->with('success', 'Pesan terkirim!');
    }
}