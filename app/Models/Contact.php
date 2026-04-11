<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts'; // Nama tabel di phpMyAdmin kamu

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama', 
        'email', 
        'telepon', 
        'alamat', 
        'pesan', 
        'is_responded'
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