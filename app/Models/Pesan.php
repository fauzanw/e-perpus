<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    public $fillable = [
        'penerima',
        'pengirim',
        'judul_pesan',
        'isi_pesan',
        'status',
        'tanggal_kirim',
    ];
}
