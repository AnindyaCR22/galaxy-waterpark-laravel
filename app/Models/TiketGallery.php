<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'tiket_id',
        'nama_galeri',
        'foto',
        'keterangan',
    ];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id', 'id');
    }
}