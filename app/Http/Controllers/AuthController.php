<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Masyarakat;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::all()->count();
        if ($user == 0) {
            User::create([
                'nama' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ]);
        }

        return view('auth.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     =>  'required|email',
            'password'  =>  'required'
        ]);

        $data = User::whereEmail($request->email)->first();

        if (!$data) {
            return redirect()->back()->with('failed', 'Email tersebut belum terdaftar.');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Selamat datang!');
            }elseif (auth()->user()->role == 'petugas') {
                return redirect()->route('dashboard.admin')->with('success', 'Selamat datang!');
            }elseif (auth()->user()->role == 'masyarakat') {
                return redirect()->route('dashboard.masyarakat')->with('success', 'Selamat datang!');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('failed', 'Email atau password tidak cocok!');
        }
    }

    public function postreg(Request $request)
    {
        $this->validate($request, [
            'nik'       => 'required|numeric|digits:16',
            'nama'      => 'required',
            'email'     => 'required|email',
            'jk'        => 'required',
            'password'  => 'required|alpha_num|min:6',
            'no_telp'   => 'required|min:10|max:15',
            'alamat'    => 'required|min:8'
        ]);

        $user = User::create([
            'nama'      => ucwords($request->nama),
            'email'     => strtolower($request->email),
            'password'  => bcrypt($request->password),
            'role'      => 'masyarakat'
        ]);

        Masyarakat::create([
            'nik'       =>  $request->nik,
            'nama'      =>  ucwords($request->nama),
            'jk'        =>  $request->jk,
            'no_telp'   =>  $request->no_telp,
            'alamat'    =>  $request->alamat,
            'user_id'   =>  $user->id
        ]);

        return redirect()->route('login')->with('success', 'Akun telah berhasil dibuat.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
