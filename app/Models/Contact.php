<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts'; // Nama tabel di database

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama', 
        'email', 
        'telepon', 
        'alamat', 
        'pesan', 
        'is_responded'
    ];

    // Mengubah angka 0/1 di database menjadi true/false secara otomatis
    protected $casts = [
        'is_responded' => 'boolean',
    ];

    /**
     * Logika untuk Admin: Mengubah status pesan (Belum/Sudah Dibalas)
     */
    public function toggleResponse()
    {
        $this->is_responded = !$this->is_responded;
        return $this->save();
    }
}