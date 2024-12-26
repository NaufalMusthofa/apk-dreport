<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_lokasi', 'deskripsi'];

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'id_lokasi');
    }
}

