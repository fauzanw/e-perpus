<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Buku, Kategori};

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::get()->sortByDesc('id_buku');
        $kategoris = Kategori::get()->sortByDesc('id_kategori');
        return view('dashboard.user.buku', compact('bukus', 'kategoris'));
    }
    
    public function search(Request $request)
    {
        $bukus = Buku::where('judul_buku', 'like', '%' . $request->get('keyword') . '%')->get()->sortByDesc('id_buku');
        $kategoris = Kategori::get()->sortByDesc('id_kategori');
        return view('dashboard.user.buku', compact('bukus', 'kategoris'));
    }
}
