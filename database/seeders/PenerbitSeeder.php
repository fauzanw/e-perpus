<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penerbit::create([
            'kode_penerbit' => strtoupper("KP". Str::random(5) . date('my')),
            'nama_penerbit' => 'Deepublish'
        ]);
        Penerbit::create([
            'kode_penerbit' => strtoupper("KP". Str::random(5) . date('my')),
            'nama_penerbit' => 'Keira Publishing'
        ]);
        Penerbit::create([
            'kode_penerbit' => strtoupper("KP". Str::random(5) . date('my')),
            'nama_penerbit' => 'Pustaka Asy-Syafi\'i'
        ]);
    }
}
