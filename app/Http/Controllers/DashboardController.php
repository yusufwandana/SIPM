<?php

namespace App\Http\Controllers;

use App\Aktivitas;
use App\Pengaduan;
use App\Masyarakat;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = auth()->user(); 
        $belum      = Pengaduan::where('status', 'terkirim')->get()->count();
        $proses     = Pengaduan::where('status', 'proses')->get()->count();
        $selesai    = Pengaduan::where('status', 'selesai')->get()->count();
        $jumlah     = Pengaduan::all()->count();

        $data = [
            'belum'     => $belum,
            'proses'    => $proses,
            'selesai'   => $selesai,
            'jumlah'    => $jumlah
        ];

        if ($user->role === 'admin') {
            $aktivitas = Aktivitas::orderBy('created_at','desc')->get();
        }else{
            $aktivitas = Aktivitas::orderBy('created_at','desc')->where('user_id', auth()->user()->id)->get();
        }

        
        return view('admin.dashboard', compact('data','user','aktivitas'));
    }

    public function petugas()
    {
        return view('admin.dashboard');
    }

    public function masyarakat()
    {
        $masyarakat = Masyarakat::where('user_id', auth()->user()->id)->first();
        $belum      = Pengaduan::where(['status' => 'terkirim',
                                        'masyarakat_id' => $masyarakat->id])->get()->count();
        $proses     = Pengaduan::where(['status' => 'proses',
                                        'masyarakat_id' => $masyarakat->id])->get()->count();
        $selesai    = Pengaduan::where(['status' => 'selesai',
                                        'masyarakat_id' => $masyarakat->id])->get()->count();
        $jumlah     = Pengaduan::where('masyarakat_id', $masyarakat->id)->get()->count();

        $data = [
            'belum'     =>  $belum,
            'proses'    =>  $proses,
            'selesai'   =>  $selesai,
            'jumlah'    =>  $jumlah
        ];

        $aktivitas = Aktivitas::orderBy('created_at','desc')->where('user_id', auth()->user()->id)->get();

        return view('masyarakat.dashboard', compact('data', 'aktivitas'));
    }
}
