<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Aktivitas;
use App\Masyarakat;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
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

            $user = auth()->user();

            Aktivitas::create([
                'aktivitas' =>  'login',
                'user_id'   =>  $user->id,
            ]);

            $role = $user->role;
            if ($role == 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Selamat datang!');
            }elseif ($role == 'petugas') {
                return redirect()->route('dashboard.admin')->with('success', 'Selamat datang!');
            }elseif ($role == 'masyarakat') {
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
        Aktivitas::create([
            'aktivitas' =>  'logout',
            'user_id'   =>  auth()->user()->id,
        ]);
        Auth::logout();
        return redirect('login');
    }
}
