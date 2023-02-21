<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kategori',
        'nama_kategori'
    ];

    protected $primaryKey = 'id_kategori';

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}
