<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Buku, Kategori, Peminjaman, Penerbit, User, Identitas};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users_count = User::where('role', 'user')->get()->count();
        $buku_count = Buku::get()->count();
        $peminjaman_count = Peminjaman::whereNull('kondisi_buku_saat_dikembalikan')->get()->count();
        $pengembalian_count = Peminjaman::whereNotNull('kondisi_buku_saat_dikembalikan')->get()->count();
        return view('dashboard.admin.index', compact('users_count', 'buku_count', 'peminjaman_count', 'pengembalian_count'));
    }

    public function identitas()
    {
        $identitas = Identitas::first();
        $last_updated = Carbon::createFromDate($identitas->updated_at)->diffForHumans();
        return view('dashboard.admin.identitas', compact('identitas', 'last_updated'));
    }

    public function identitasUpdate(Request $request)
    {
        $update = Identitas::where([
            'id_identitas' => 1,
        ])->update([
            'nama_app' => $request->get('nama_app'),
            'alamat_hp' => $request->get('alamat_app'),
            'email_hp' => $request->get('email_app'),
            'nomor_hp' => $request->get('no_app'),
        ]);
        if($update) {
            return redirect()->route('dashboard.admin.identitas')->with(['success' => 'Update successfull!']);
        }else{
            return redirect()->route('dashboard.admin.identitas')->with(['error' => 'Update error!']);
        }
    }
}