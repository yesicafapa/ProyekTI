<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Portofolio extends Model
{
    protected $table = 'portofolio';
    protected $fillable = ['judul', 'deskripsi', 'url', 'gambar', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * LOGIKA: Menyimpan data baru & Upload Gambar
     */
    public static function storeData($request)
    {
        $data = $request->only(['judul', 'deskripsi', 'url']);
        $data['user_id'] = Auth::id();
        $data['status'] = (int) $request->status;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('portofolio', 'public');
        }

        return self::create($data);
    }

    /**
     * LOGIKA: Update data & Ganti Gambar (Hapus yang lama)
     */
    public function updateData($request)
    {
        $data = $request->only(['judul', 'deskripsi', 'url']);
        $data['status'] = (int) $request->status;

        if ($request->hasFile('gambar')) {
            if ($this->gambar) {
                Storage::disk('public')->delete($this->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('portofolio', 'public');
        }

        return $this->update($data);
    }

    /**
     * LOGIKA: Hapus data & Bersihkan Storage
     */
    public function drop()
    {
        if ($this->gambar) {
            Storage::disk('public')->delete($this->gambar);
        }
        return $this->delete();
    }
}