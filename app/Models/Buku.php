<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'kategori_buku',
        'penerbit_buku',
        'tahun_terbit',
        'isbn',
        'id_buku_baik',
        'id_buku_rusak',
    ];
}
