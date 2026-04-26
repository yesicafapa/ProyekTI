<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Artikel extends Model
{
    protected $table = 'artikel';
    // Gunakan fillable untuk keamanan ekstra agar status tidak terabaikan
    protected $fillable = ['judul', 'ringkasan', 'isi', 'status', 'thumbnail', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function storeData($request)
    {
        $data = $request->only(['judul', 'ringkasan', 'isi', 'status']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        return self::create($data);
    }

    public function updateData($request)
    {
        // Ambil data spesifik agar status tidak tertimpa nilai default jika request kosong
        $data = $request->only(['judul', 'ringkasan', 'isi', 'status']);
        
        // Opsional: Tetap pertahankan user_id pembuat asli jika tidak ingin berubah saat diedit
        // $data['user_id'] = Auth::id(); 

        if ($request->hasFile('thumbnail')) {
            if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
                Storage::disk('public')->delete($this->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        return $this->update($data);
    }

    public function deleteWithImage()
    {
        if ($this->thumbnail) {
            Storage::disk('public')->delete($this->thumbnail);
        }
        return $this->delete();
    }
}