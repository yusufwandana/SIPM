<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Aktivitas;
use App\Masyarakat;
use App\Pengaduan;
use App\Tanggapan;

class PengaduanController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $user = Auth::user();
        $teks= [];

        if ($user->role == 'admin' || $user->role == 'petugas') {

            $data = Pengaduan::orderBy('created_at', 'desc')
                        ->where('status', 'terkirim')
                        ->orWhere('status', 'proses')
                        ->get();
                        
            return view('pengaduan.index', compact('data','teks'));

        }elseif($user->role == 'masyarakat'){

            $data = Pengaduan::orderBy('created_at','desc')
                        ->where('user_id', $user->id)
                        ->where('status', 'terkirim')
                        ->orWhere('status', 'proses')
                        ->get();

            return view('pengaduan.index', compact('data','teks'));

        }else{
            return redirect()->route('logout');
        }
    }

    public function ajukanPengaduan()
    {
        return view('masyarakat.ajukan_pengaduan');
    }

    public function  postPengaduan(Request $request)
    {
        $this->validate($request, [
            'judul'             =>  'required',
            'teks_pengaduan'    =>  'required',
            'file'              =>  'file|mimes:.jpeg,jpg,png|max:2048'
        ]);

        $user = Auth::user();
        $masyarakat = Masyarakat::where('user_id', $user->id)->first();

        if ($request->file) {
            $time = time();
            $id   = uniqid();
            $file = $request->file;
            $fileName  = $time . $id . '.' . $file->getClientOriginalExtension();
            $moveto = 'images/pengaduan';
            $file->move($moveto, $fileName);
        }else{
            $fileName = '';
        }

        Pengaduan::create([
            'judul'             => htmlspecialchars($request->judul),
            'slug'              => str_replace(' ', '-', $request->judul),
            'masyarakat_id'     => $masyarakat->id,
            'teks_pengaduan'    => htmlspecialchars($request->teks_pengaduan),
            'foto'              => $fileName,
            'status'            => 'terkirim',
            'user_id'           => $user->id
        ]);

        Aktivitas::create([
            'aktivitas' =>  'ajukan pengaduan',
            'user_id'   =>  auth()->user()->id
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah dikirimkan. Tunggu respon dari petugas dalam 2x24 jam. Terima kasih.');
    }

    public function batalkanPengaduan($id)
    {
        $pengaduan = Pengaduan::find($id);
        if ($pengaduan->status === 'dibatalkan') {
            return back()->with('failed', 'Akun ini telah dibatalkan sebelumnya.');
        }
        $pengaduan->update([
            'status'    =>  'dibatalkan'
        ]);
        Aktivitas::create([
            'aktivitas' => 'Pembatalan pengaduan No. ' . $pengaduan->id,
            'user_id'   => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Pengaduan No.'.$pengaduan->id.' telah Anda batalkan.');
    }

    public function beriTanggapan($id)
    {
        $data = Pengaduan::whereId($id)->with('Masyarakat')->first();
        return view('pengaduan.beri_tanggapan', compact('data'));
    }

    public function postTanggapan(Request $request)
    {
        $this->validate($request, [
            'pengaduan_id'  =>  'required',
            'teks_respon'   =>  'required',
            'status'        =>  'required'
        ]);

        $date = date('Y-m-d');
        $time = date('G:i:s');
        $fullTime = $date.' '.$time;
        Tanggapan::create([
            'teks_respon'   =>  $request->teks_respon,
            'pengaduan_id'  =>  $request->pengaduan_id,
            'user_id'       =>  auth()->user()->id,
            'created_at'    =>  $fullTime
        ]);

        $data = Pengaduan::find($request->pengaduan_id);
        $data->status = $request->status;
        $data->updated_at = $fullTime;
        $data->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah berhasil ditanggapi.');
    }

    public function riwayatPengaduan()
    {
        $user = Auth::user();
        $teks = [];

        if ($user->role == 'admin' || $user->role == 'petugas') {

            $data = Pengaduan::orderBy('created_at', 'desc')
                            ->where('status', 'selesai')
                            ->orWhere('status', 'dibatalkan')
                            ->orWhere('status', 'ditolak')->get();

            return view('pengaduan.index', compact('data','teks'));

        }elseif($user->role == 'masyarakat'){

            $data = Pengaduan::orderBy('created_at', 'desc')
                            ->where('user_id', $user->id)
                            ->orWhere('status', 'selesai')
                            ->orWhere('status', 'dibatalkan')
                            ->orWhere('status', 'ditolak')->get();

            return view('pengaduan.index', compact('data','teks'));

        }else{
            return redirect()->route('logout');
        }
    }

    public function hapusPengaduan($id)
    {
        $data = Pengaduan::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Pengaduan No.'.$data->id.' telah berhasil dihapus.');
    }

    public function hapusTanggapan($id)
    {
        $data = Tanggapan::find($id);
        $data->delete();

        return redirect()->back()->with('success', 'Tanggapan telah bershasil dihapus.');
    }

    public function cari(Request $request)
    {
        $keyWord = $request->kata_kunci;
        if ($keyWord != null) {
            $data = Pengaduan::where('status' ,'like','%'.$keyWord.'%')
                            ->orWhere('id'    ,'like','%'.$keyWord.'%')
                            ->orWhere('judul' ,'like','%'.$keyWord.'%')
                            ->orWhere('teks_pengaduan' ,'like','%'.$keyWord.'%')
                            ->orderBy('id','desc')->get();

            $jumlah = $data->count();
            $teks = [
                'keyWord'   =>  $keyWord,
                'jumlah'    =>  $jumlah
            ];
        }else{
            return redirect()->route('pengaduan.index');
        }

        return view('pengaduan.index', compact('data','teks'));
    }

    // public function cariRiwayat(Request $request)
    // {
    //     $keyWord = $request->kata_kunci;
    //     if ($keyWord != null) {
    //         $data = Pengaduan::where('status','selesai')
    //                         ->orWhere('status','ditolak')
    //                         ->orWhere('status','dibatalkan')
    //                         ->orWhere('id'    ,'like','%'.$keyWord.'%')
    //                         ->orWhere('judul' ,'like','%'.$keyWord.'%')
    //                         ->orWhere('teks_pengaduan' ,'like','%'.$keyWord.'%')
    //                         ->orderBy('id','desc')->get();

    //         $jumlah = $data->count();
    //         $teks = [
    //             'keyWord'   =>  $keyWord,
    //             'jumlah'    =>  $jumlah
    //         ];
    //     }else{
    //         return redirect()->route('pengaduan.histori');
    //     }

    //     return view('pengaduan.riwayat', compact('data','teks'));
    // }
}
