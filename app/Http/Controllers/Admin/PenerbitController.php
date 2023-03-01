<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::get()->sortByDesc('id_penerbit');
        $kode_penerbit = strtoupper("KP". Str::random(5) . date('my'));
        return view('dashboard.admin.data.penerbit', compact('penerbits', 'kode_penerbit'));
    }
    
    public function verify(Request $request)
    {
        $id = $request->get('id');
        $check = Penerbit::where('id_penerbit', $id)->first();
        if($check) {
            Penerbit::where('id_penerbit', $id)->update(['verif_penerbit' => 'verified']);
            return redirect()->route('dashboard.admin.data.penerbit')->with(['success' => 'Verif successfull!']);
        }else {
            return redirect()->route('dashboard.admin.data.penerbit')->with(['error' => 'Unregistered publisher id
            !']);
        }
    }
    
    public function create(Request $request) {
        $data = $request->validate([
            'kode_penerbit' => 'required|min:8',
            'nama_penerbit' => 'required|min:8',
        ]);
        
        $data['verif_penerbit'] = 'not_verified';
        
        Penerbit::create($data);
        return redirect()->route('dashboard.admin.data.penerbit')->with(['success' => 'Create penerbit successfull!']);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $update = Penerbit::where([
            'id_penerbit' => $id, 
            'kode_penerbit' => $request->get('kode_penerbit'), 
        ])->update([
            'nama_penerbit' => $request->get('nama_penerbit')
        ]);
        if($update) {
            return redirect()->route('dashboard.admin.data.penerbit')->with(['success' => 'Update successfull!']);
        }else{
            return redirect()->route('dashboard.admin.data.penerbit')->with(['error' => 'Update error!']);
        }
    }

    public function delete(Penerbit $id_penerbit)
    {
        $id_penerbit->delete();
        return redirect()->route('dashboard.admin.data.penerbit')->with(['success' => 'Delete successfull!']);
    }

    public function get()
    {
        $user = Penerbit::where('id_penerbit', $_GET['id'])->select('id_penerbit', 'kode_penerbit', "nama_penerbit", "verif_penerbit")->first();
        if($user) {
            echo $user;
        }else {
            abort(404);
        }
    }
}
