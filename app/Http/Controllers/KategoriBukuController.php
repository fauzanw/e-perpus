<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategori_bukus = Kategori::get()->sortByDesc('id_kategori');
        $kode_kategori = strtoupper("KKB". Str::random(5));
        return view('dashboard.data.kategori_buku', compact('kategori_bukus', 'kode_kategori'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required|min:5',
        ]);
    
        Kategori::create($data);
    
        return redirect()->route('dashboard.data.kategori_buku')->with(['success' => 'Berhasil menambahkan kategori buku!']);
    }
    
    public function delete(Kategori $id_kategori)
    {
        $id_kategori->delete();
        return redirect()->route('dashboard.data.kategori_buku')->with(['success' => 'Delete successfull!']);
    }

    public function get()
    {
        $kategori = Kategori::where('id_kategori', $_GET['id'])->first();
        if($kategori) {
            echo $kategori;
        }else {
            abort(404);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $update = Kategori::where('id_kategori', $id)->update([
            'nama_kategori' => $request->get('namaKategori')
        ]);
        if($update) {
            return redirect()->route('dashboard.data.kategori_buku')->with(['success' => 'Update successfull!']);
        }else{
            return redirect()->route('dashboard.data.kategori_buku')->with(['error' => 'Update error!']);
        }
    }
}
