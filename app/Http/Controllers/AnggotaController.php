<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get()->sortByDesc('id_user');
        return view('dashboard.data.anggota', compact('users'));
    }

    public function create(Request $request)
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

    public function delete(User $id_user)
    {
        $id_user->delete();
        return redirect()->route('dashboard.data.anggota')->with(['success' => 'Delete successfull!']);
    }
    
    public function get()
    {
        $user = User::where('id_user', $_GET['id'])->select('kode_user', 'id_user', 'nis', 'kelas', 'terakhir_login', "fullname", "username")->first();
        if($user) {
            echo $user;
        }else {
            abort(404);
        }
    }
    
    public function edit(Request $request)
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
}
