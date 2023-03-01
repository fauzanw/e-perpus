<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $administrators = User::where('role', 'admin')->get()->sortByDesc('id_user');
        return view('dashboard.admin.data.administrator', compact('administrators'));
    }

    public function create(Request $request)
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

        return redirect()->route('dashboard.admin.data.administrator')->with(['success' => 'Registration successfull!']);
    }

    public function delete(User $id_user)
    {
        $id_user->delete();
        return redirect()->route('dashboard.admin.data.administrator')->with(['success' => 'Delete successfull!']);
    }
}
