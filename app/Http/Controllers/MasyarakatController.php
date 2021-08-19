<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masyarakat;
use App\Pengaduan;
use App\User;
use Auth;

class MasyarakatController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = Masyarakat::orderBy('nama', 'asc')->get();
        return view('masyarakat.index', compact('data'));
    }

    public function edit(Masyarakat $masyarakat)
    {
        return view('masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, Masyarakat $masyarakat)
    {
        $this->validate($request, [
            'nik'     =>  'required|numeric|digits:16',
            'nama'    =>  'required',
            'email'   =>  'required|email',
            'jk'      =>  'required',
            'no_telp' =>  'required|min:10|max:15',
            'alamat'  =>  'required|min:8',
        ]);

        $masyarakat->update([
            'nik'     =>  ucwords($request->nik),
            'nama'    =>  ucwords($request->nama),
            'jk'      =>  $request->jk,
            'no_telp' =>  $request->no_telp,
            'alamat'  =>  $request->alamat,
        ]);

        $user = User::find($masyarakat->user_id);
        $user->update([
            'nama'  =>  ucwords($request->nama),
            'email' =>  $request->email,
        ]);

        return redirect()->route('masyarakat.index')->with('success', 'Data telah berhasi diupdate!');
    }

    public function hapus($id)
    {
        $masyarakat = Masyarakat::find($id);
        $user = User::find($masyarakat->user_id);
        if ($user) {
            $user->delete();
        }

        $masyarakat->delete();

        return redirect()->route('masyarakat.index')->with('success', 'Data telah berhasi dihapus!');
    }

    
    public function detailPengaduan($id)
    {
        $data = Pengaduan::where('id', $id)->with('Masyarakat')->first();
        return view('masyarakat.detail-pengaduan', compact('data'));
    }

}
