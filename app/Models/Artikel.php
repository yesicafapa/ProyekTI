<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function storeData($request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id(); // Logika user masuk sini

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel', 'public');
        }

        return self::create($data);
    }

    public function updateData($request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id(); // Setiap update, penulis otomatis berganti ke pengedit

        if ($request->hasFile('thumbnail')) {
            if ($this->thumbnail) {
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