<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

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

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function penerbit() {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
