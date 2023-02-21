<?php

namespace App\Http\Controllers;

use App\Models\{Buku, Kategori, Peminjaman, Penerbit, User};
use DateTime;
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

    public function buku()
    {
        $bukus = Buku::with('kategori', 'penerbit')->get()->sortByDesc('id_buku');
        $kode_kategori = strtoupper("KKB". Str::random(5));
        return view('dashboard.data.buku', compact('bukus'));
    }
    
    public function createBuku(Request $request)
    {
        $kategoris = Kategori::all()->sortByDesc('id_kategori');
        $penerbits = Penerbit::all()->sortByDesc('id_penerbit');
        return view('dashboard.data.create_buku', compact('kategoris', 'penerbits'));
    }

    public function doCreateBuku(Request $request)
    {
        $data = $request->validate([
            'judul_buku' => 'required|min:8',
            'tahun_terbit' => 'required|numeric',
            'kategori' => 'required|exists:kategoris,id_kategori',
            'nama_penerbit' => 'required|exists:penerbits,id_penerbit',
            'isbn' => 'required|size:13',
            'cover_buku' => 'required|image|mimes:jpg,png,jpeg',
            'jumlah_buku_baik' => 'required|numeric',
            'jumlah_buku_rusak' => 'required|numeric',
        ]);
        $image = $request->file('cover_buku');
        $filename = uniqid() . date('dmY') . '-' . $image->getClientOriginalName();

        $image->store(public_path('img/cover_buku'), $filename);

        echo $filename; die;

        return redirect()->route('dashboard.data.create_buku')->with(['success' => 'Registration successfull!']);
    }

    public function kategoriBuku()
    {
        $kategori_bukus = Kategori::get()->sortByDesc('id_kategori');
        $kode_kategori = strtoupper("KKB". Str::random(5));
        return view('dashboard.data.kategori_buku', compact('kategori_bukus', 'kode_kategori'));
    }

    public function createKategoriBuku(Request $request)
    {
        $data = $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required|min:5',
        ]);
    
        Kategori::create($data);
    
        return redirect()->route('dashboard.data.kategori_buku')->with(['success' => 'Berhasil menambahkan kategori buku!']);
    }
    
    public function deleteKategoriBuku(Kategori $id_kategori)
    {
        $id_kategori->delete();
        return redirect()->route('dashboard.data.kategori_buku')->with(['success' => 'Delete successfull!']);
    }

    public function getKategoriBuku()
    {
        $kategori = Kategori::where('id_kategori', $_GET['id'])->first();
        if($kategori) {
            echo $kategori;
        }else {
            abort(404);
        }
    }

    public function editKategoriBuku(Request $request)
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

    public function anggota()
    {
        $users = User::where('role', 'user')->get();
        return view('dashboard.data.anggota', compact('users'));
    }

    public function createAnggota(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|min:8',
            'username' => 'required|min:8',
            'password' => 'required|min:8'
        ]);

        $data['kode_user'] = Str::random(8);
        $data['role'] = 'user';
        $data['password'] = Hash::make($request->get('password'));

        User::create($data);

        return redirect()->route('dashboard.data.anggota')->with(['success' => 'Registration successfull!']);
    }

    public function deleteAnggota(User $id_user)
    {
        $id_user->delete();
        return redirect()->route('dashboard.data.anggota')->with(['success' => 'Delete successfull!']);
    }
    
    public function getAnggota()
    {
        $user = User::where('id_user', $_GET['id'])->select('kode_user', 'id_user', "fullname", "username")->first();
        if($user) {
            echo $user;
        }else {
            abort(404);
        }
    }
    
    public function editAnggota(Request $request)
    {
        $id = $request->get('id');
        $update = User::where('id_user', $id)->update([
            'fullname' => $request->get('fullname'),
            'username' => $request->get('username')
        ]);
        if($update) {
            return redirect()->route('dashboard.data.anggota')->with(['success' => 'Update successfull!']);
        }else{
            return redirect()->route('dashboard.data.anggota')->with(['error' => 'Update error!']);
        }
    }
    
    public function penerbit()
    {
        $penerbits = Penerbit::get()->sortByDesc('id_penerbit');
        $kode_penerbit = strtoupper("KP". Str::random(5) . date('my'));
        return view('dashboard.data.penerbit', compact('penerbits', 'kode_penerbit'));
    }
    
    public function verifyPenerbit(Request $request)
    {
        $id = $request->get('id');
        $check = Penerbit::where('id_penerbit', $id)->first();
        if($check) {
            Penerbit::where('id_penerbit', $id)->update(['verif_penerbit' => 'verified']);
            return redirect()->route('dashboard.data.penerbit')->with(['success' => 'Verif successfull!']);
        }else {
            return redirect()->route('dashboard.data.penerbit')->with(['error' => 'Unregistered publisher id
            !']);
        }
    }
    
    public function createPenerbit(Request $request) {
        $data = $request->validate([
            'kode_penerbit' => 'required|min:8',
            'nama_penerbit' => 'required|min:8',
        ]);
        
        $data['verif_penerbit'] = 'not_verified';
        
        Penerbit::create($data);
        return redirect()->route('dashboard.data.penerbit')->with(['success' => 'Create penerbit successfull!']);
    }

    public function editPenerbit(Request $request)
    {
        $id = $request->get('id');
        $update = Penerbit::where(['id_penerbit' => $id, 'kode_penerbit' => $request->get('kode_penerbit')])->update([
            'nama_penerbit' => $request->get('nama_penerbit')
        ]);
        if($update) {
            return redirect()->route('dashboard.data.penerbit')->with(['success' => 'Update successfull!']);
        }else{
            return redirect()->route('dashboard.data.penerbit')->with(['error' => 'Update error!']);
        }
    }

    public function deletePenerbit(Penerbit $id_penerbit)
    {
        $id_penerbit->delete();
        return redirect()->route('dashboard.data.penerbit')->with(['success' => 'Delete successfull!']);
    }

    public function getPenerbit()
    {
        $user = Penerbit::where('id_penerbit', $_GET['id'])->select('id_penerbit', 'kode_penerbit', "nama_penerbit", "verif_penerbit")->first();
        if($user) {
            echo $user;
        }else {
            abort(404);
        }
    }

    public function administrator()
    {
        $administrators = User::where('role', 'admin')->get()->sortByDesc('id_user');
        return view('dashboard.data.administrator', compact('administrators'));
    }

    public function createAdministrator(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|min:8',
            'username' => 'required|min:8',
            'password' => 'required|min:8'
        ]);

        $data['kode_user'] = Str::random(8);
        $data['role'] = 'admin';
        $data['password'] = Hash::make($request->get('password'));

        User::create($data);

        return redirect()->route('dashboard.data.administrator')->with(['success' => 'Registration successfull!']);
    }

    public function deleteAdministrator(User $id_user)
    {
        $id_user->delete();
        return redirect()->route('dashboard.data.administrator')->with(['success' => 'Delete successfull!']);
    }
}