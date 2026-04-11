<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';
    protected $fillable = ['pertanyaan', 'jawaban', 'status', 'user_id'];

    /**
     * Logika: Simpan FAQ Baru
     */
    public static function storeFaq(array $data)
    {
        $data['user_id'] = Auth::id();
        return self::create($data);
    }

    /**
     * Logika: Update FAQ
     */
    public function updateFaq(array $data)
    {
        return $this->update($data);
    }

    /**
     * Logika: Ambil Data Terbaru (Query Scope)
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}