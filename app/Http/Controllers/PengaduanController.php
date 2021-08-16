<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use App\Tanggapan;
use Auth;

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

            $data = Pengaduan::orderBy('created_at', 'desc')->get();
            return view('pengaduan.index', compact('data','teks'));

        }elseif($user->role == 'masyarakat'){

            $data = Pengaduan::whereUserId($user->id)->orderBy('created_at','desc')->get();
            return view('pengaduan.index', compact('data','teks'));

        }else{
            return redirect()->route('logout');
        }
    }

    // public function histori()
    // {
    //     $teks=[];
    //     $data = Pengaduan::where('status','selesai')
    //             ->orWhere('status','ditolak')
    //             ->orWhere('status','dibatalkan')
    //             ->orderBy('created_at', 'desc')->get();

    //     return view('pengaduan.riwayat', compact('data','teks'));
    // }

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

    public function hapusPengaduan($id)
    {
        $data = Pengaduan::find($id);
        $data->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan No.'.$data->id.' telah berhasil dihapus.');
    }

    public function hapusTanggapan($id)
    {
        $data = Tanggapan::find($id);
        $data->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Tanggapan telah bershasil dihapus.');
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


    public function getNotif(){
        $data = Pengaduan::whereStatus('terkirim')->get();

        return response()->json($data);
    }
}
