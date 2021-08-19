<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id','desc')->get();

        return view('user.index', compact('data'));
    }

    public function edit($id)
    {
        $data = User::find($id);

        return view('user.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'nama'  => 'required',
            'email' => 'required|email',
        ]);
        $user->update([
            'nama'  => $request->nama,
            'email' => strtolower($request->email),
        ]);

        return redirect()->route('user.index')->with('success', '');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user->role === 'admin') {
            return back()->with('failed', 'Akun ini tidak boleh dihapus.');
        }
        $user->delete();

        return back()->with('success','Akun telah berhasil dihapus.');
    }

    public function myAccount()
    {
        $data = User::find(Auth::user()->id);
        
        return view('user.profile', compact('data'));
    }
}
