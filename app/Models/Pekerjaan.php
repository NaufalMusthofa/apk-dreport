<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    // protected $table = 'pekerjaans'; // Nama tabel di database // sifatnya tidak wajib, karna laravel membuat sendiri dibelakang nya jadi + s
    protected $fillable = ['id_lokasi', 'nama_pekerjaan', 'nominal', 'deskripsi']; // Kolom yang dapat diisi secara massal

    /**
     * Relasi ke model Lokasi
     * Satu pekerjaan terkait dengan satu lokasi
     */
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id'); // Relasi ke tabel lokasi
    }

    // Relasi ke model Tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_pekerjaan', 'id');
    }
}
