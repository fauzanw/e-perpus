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
        'kategori_id',
        'penerbit_id',
        'tahun_terbit',
        'isbn',
        'cover_buku',
        'jumlah_buku_baik',
        'jumlah_buku_rusak',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function penerbit() {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
