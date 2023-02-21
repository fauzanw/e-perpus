<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Hash, Auth};

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|min:8|exists:users',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('username', 'password');
        
        if(Auth::attempt($credentials)) {
            // User::g
            User::where('id_user', User::where('id_user', Auth::user()->id_user)->update(['terakhir_login' => date('h:i:s d/m/Y')]));
            $request->session()->put(['user' => [
                'id_user' => Auth::user()->id_user,
                'kode_user' => Auth::user()->kode_user,
                'fullname' => Auth::user()->fullname,
                'username' => Auth::user()->username
            ]]);
            return redirect()->intended(route('dashboard.index'));
        }

        return back()->with('error', 'Login failed!');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
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

        return redirect()->route('auth.login')->with(['success' => 'Registration successfull!']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();
    
        return redirect()->route('auth.login');
    }
}
