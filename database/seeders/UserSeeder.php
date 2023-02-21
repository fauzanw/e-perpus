<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'kode_user' => Str::random(8),
            'fullname' => 'Admin Perpustakaan',
            'username' => 'adminperpus',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);
        User::create([
            'kode_user' => Str::random(8),
            'fullname' => 'User Perpustakaan',
            'username' => 'userperpus',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);
    }
}
