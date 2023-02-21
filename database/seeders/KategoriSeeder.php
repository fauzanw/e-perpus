<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'kode_kategori' => strtoupper("KKB". Str::random(5)),
            'nama_kategori' => 'Sains'
        ]);
        Kategori::create([
            'kode_kategori' => strtoupper("KKB". Str::random(5)),
            'nama_kategori' => 'Komik'
        ]);
        Kategori::create([
            'kode_kategori' => strtoupper("KKB". Str::random(5)),
            'nama_kategori' => 'Biografi'
        ]);
        Kategori::create([
            'kode_kategori' => strtoupper("KKB". Str::random(5)),
            'nama_kategori' => 'Ensiklopedia'
        ]);
        Kategori::create([
            'kode_kategori' => strtoupper("KKB". Str::random(5)),
            'nama_kategori' => 'Arkeologi'
        ]);
    }
}
