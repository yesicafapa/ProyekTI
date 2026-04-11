<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $fillable = ['pengguna', 'deskripsi', 'status', 'image_pengguna', 'user_id'];

    protected $casts = [
        'status' => 'integer',
    ];

    // Method Simpan (DIPANGGIL DI CONTROLLER)
    public static function simpanTestimoni($request)
    {
        $data = $request->validate([
            'pengguna'       => 'required|string|max:100',
            'deskripsi'      => 'required|string|max:512',
            'status'         => 'required|in:0,1', // Menangkap input status dari modal
            'image_pengguna' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image_pengguna')) {
            $data['image_pengguna'] = $request->file('image_pengguna')->store('testimoni', 'public');
        }

        // HAPUS baris $data['status'] = 1; agar mengikuti pilihan user
        $data['user_id'] = Auth::id(); 

        return self::create($data);
    }

    // Method Update (DIPANGGIL DI CONTROLLER)
    public function updateTestimoni($request)
    {
        $data = $request->validate([
            'pengguna'       => 'required|string|max:100',
            'deskripsi'      => 'required|string|max:512',
            'status'         => 'required|in:0,1', // WAJIB ADA AGAR BISA UPDATE DRAFT
            'image_pengguna' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image_pengguna')) {
            // Hapus foto lama jika ada
            if ($this->image_pengguna) {
                Storage::disk('public')->delete($this->image_pengguna);
            }
            $data['image_pengguna'] = $request->file('image_pengguna')->store('testimoni', 'public');
        }

        // $data['status'] sekarang sudah berisi nilai 0 atau 1 dari form
        return $this->update($data);
    }

    // Method Hapus
    public function hapusTestimoni()
    {
        if ($this->image_pengguna) {
            Storage::disk('public')->delete($this->image_pengguna);
        }
        return $this->delete();
    }
}