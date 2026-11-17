<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tiket_seo',
        'foto',
        'kategori',
        'harga',
        'tgl_berlaku',
    ];

    // Menjadikan tgl_berlaku instance Carbon agar bisa di-format('d/m/Y')
    protected $casts = [
        'tgl_berlaku' => 'date',
    ];

    // Relasi One-to-Many ke tabel tiket_galleries (sesuai fungsi photos() pada modul)
    public function photos()
    {
        return $this->hasMany(TiketGallery::class, 'tiket_id', 'id');
    }
}