<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Panggil logika dari model
        $faqs = Faq::latest()->get();
        return view('pages.admin.faq', compact('faqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'status'     => 'required|in:0,1',
        ]);

        // Jembatan ke Model
        Faq::storeFaq($validated);

        return redirect()->route('faq.index')->with('success', 'FAQ Berhasil!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
            'status'     => 'required|in:0,1',
        ]);

        // Jembatan ke Model
        $faq = Faq::findOrFail($id);
        $faq->updateFaq($validated);

        return redirect()->route('faq.index')->with('success', 'FAQ Diperbarui!');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ Dihapus!');
    }
}