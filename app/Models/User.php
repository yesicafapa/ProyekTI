<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Sesuai database kamu
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'password', 'level', 'status', 'foto'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Logika: Update Data, Password, & Foto Profil (UNTUK FITUR PROFILE & EDIT ADMIN)
     * JANGAN DIGANTI karena ini yang dipakai berdua.
     */
   public function updateUser($request)
    {
        // 1. Cek Password Lama Dulu (Keamanan Utama)
        // Kita cek: Jika password_lama diisi ATAU password baru diisi
        if ($request->filled('password_lama') || $request->filled('password')) {
            // Jika password lama salah, langsung tendang keluar
            if (!Hash::check($request->password_lama, $this->password)) {
                return false; 
            }
            
            // Jika password lama benar DAN ada input password baru, baru kita ganti
            if ($request->filled('password')) {
                $this->password = Hash::make($request->password);
            }
        }

        // 2. Update data dasar
        $this->nama = $request->nama;
        $this->email = $request->email;
        
        if ($request->has('level')) {
            $this->level = $request->level;
        }

        // 3. Logika Foto Profil
        if ($request->hasFile('foto')) {
            if ($this->foto && Storage::disk('public')->exists($this->foto)) {
                Storage::disk('public')->delete($this->foto);
            }
            $this->foto = $request->file('foto')->store('profile', 'public');
        }

        return $this->save();
    }

    /**
     * Logika: Jembatan buat UserController (Fungsi Tambah Admin)
     */
    public static function simpanUser($request)
    {
        return self::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level ?? 'admin',
            'status'   => 1,
            'foto'     => null,
        ]);
    }

    /**
     * Logika: Hapus User & Foto (Biar UserController gak error pas Destroy)
     */
    public function hapusUser()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            Storage::disk('public')->delete($this->foto);
        }
        return $this->delete();
    }

    /**
     * Logika: Registrasi Admin Baru (Tetap ada biar gak error kalau dipanggil di tempat lain)
     */
    public static function storeAdmin(array $data)
    {
        return self::create([
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'level'    => 'admin',
            'status'   => 1,
            'foto'     => null,
        ]);
    }
}