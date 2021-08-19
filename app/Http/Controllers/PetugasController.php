<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use App\User;

class PetugasController extends Controller
{
    public function index()
    {
        $data = Petugas::all();
        return view('petugas.index', compact('data'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function addPetugas(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'email'     => 'required|email',
            'jk'        => 'required',
            'no_telp'   => 'required|min:10|max:15',
            'password'  => 'required|alpha_num|min:6',
            'alamat'    => 'required'
        ]);

        $user = User::create([
            'nama'      =>  ucwords($request->nama),
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
            'role'      =>  'petugas'
        ]);

        Petugas::create([
            'nama'      =>  ucwords($request->nama),
            'jk'        =>  $request->jk,
            'no_telp'   =>  $request->no_telp,
            'alamat'    =>  ucwords($request->alamat),
            'user_id'   =>  $user->id
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas telah berhasil ditambahkan!');
    }

    public function edit(Petugas $petugas)
    {
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, Petugas $petugas)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'email'     => 'required|email',
            'jk'        => 'required',
            'no_telp'   => 'required|min:10|max:15',
            'alamat'    => 'required'
        ]);

        $user = User::find($petugas->user_id);

        $petugas->update([
            'nama'     => ucwords($request->nama),
            'jk'       => $request->jk,
            'no_telp'  => $request->no_telp,
            'alamat'   => ucwords($request->alamat),
        ]);

        $user->update([
            'nama'  => ucwords($request->nama),
            'email' => strtolower($request->email),
            'role'  => 'petugas'
        ]);

        return redirect()->route('petugas.index')->with('success', 'Data petugas telah berhasil diupdate!');
    }

    public function hapus(Petugas $petugas)
    {
        if ($petugas) {
            $petugas->delete();
        }
        User::find($petugas->user_id)->delete();

        return redirect()->back()->with('success', 'Data petugas berhasil dihapus!');
    }
}
