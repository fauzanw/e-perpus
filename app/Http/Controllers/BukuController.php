<?php

namespace App\Http\Controllers;
use App\Models\{Buku, Kategori, Penerbit};
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori', 'penerbit')->get()->sortByDesc('id_buku');
        $kode_kategori = strtoupper("KKB". Str::random(5));
        $kategoris = Kategori::all()->sortByDesc('id_kategori');
        $penerbits = Penerbit::all()->sortByDesc('id_penerbit');
        return view('dashboard.data.buku', compact('bukus', 'penerbits', 'kategoris'));
    }
    
    public function create(Request $request)
    {
        $kategoris = Kategori::all()->sortByDesc('id_kategori');
        $penerbits = Penerbit::all()->sortByDesc('id_penerbit');
        return view('dashboard.data.create_buku', compact('kategoris', 'penerbits'));
    }

    public function doCreate(Request $request)
    {
        $data = $request->validate([
            'judul_buku' => 'required|min:8',
            'tahun_terbit' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id_kategori',
            'penerbit_id' => 'required|exists:penerbits,id_penerbit',
            'isbn' => 'required|max:20',
            'cover_buku' => 'required|image|mimes:jpg,png,jpeg',
            'jumlah_buku_baik' => 'required|numeric',
            'jumlah_buku_rusak' => 'required|numeric',
        ]);

        $data['cover_buku'] = $request->file('cover_buku')->store('cover_buku');

        Buku::create($data);

        return redirect()->route('dashboard.data.buku')->with(['success' => 'Add buku successfull!']);
    }

    public function get()
    {
        $buku = Buku::where('id_buku', $_GET['id'])->with('kategori', 'penerbit')->first();
        if($buku) {
            echo $buku;
        }else {
            abort(404);
        }
    }
}
