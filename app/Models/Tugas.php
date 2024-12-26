<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas'; // Nama tabel yang sesuai di database
    protected $dates = ['tanggal_mulai', 'tanggal_selesai']; // Menyatakan bahwa kolom ini adalah tanggal
    protected $fillable = ['id_user', 'id_pekerjaan', 'status', 'tanggal_mulai', 'tanggal_selesai']; // Kolom yang dapat diisi secara massal

    /**
     * Relasi ke model Lokasi
     * Satu pekerjaan terkait dengan satu lokasi
     */

    //  RELASI KE TABEL USER
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id'); // Relasi ke tabel USER
    }

    // RELASI KE TABEL PEKERJAAN
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan', 'id'); // Relasi ke tabel PEKERJAAN
    }
}
