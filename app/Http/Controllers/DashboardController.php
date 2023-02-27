<?php

namespace App\Http\Controllers;

use App\Models\{Buku, Kategori, Peminjaman, Penerbit, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users_count = User::where('role', 'user')->get()->count();
        $buku_count = Buku::get()->count();
        $peminjaman_count = Peminjaman::whereNull('kondisi_buku_saat_dikembalikan')->get()->count();
        $pengembalian_count = Peminjaman::whereNotNull('kondisi_buku_saat_dikembalikan')->get()->count();
        return view('dashboard.index', compact('users_count', 'buku_count', 'peminjaman_count', 'pengembalian_count'));
    }
}