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

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        return back()->with('success','Akun telah berhasil dihapus.');
    }

    public function myAccount()
    {
        $data = User::find(Auth::user()->id);
        
        return view('user.profile', compact('data'));
    }
}
