@extends('layouts.master-admin')

@section('title', 'Edit Akun')

@section('content')
    <!-- Begin Page Content -->
<div class="row justify-content-center animated--grow-in">
    <div class="col-xl col-lg col-md">
        <div class="card o-hidden border-0">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="px-5 py-3">
                        <h5 class="m-0 font-weight-bold border-bottom pb-2 mb-3">EDIT AKUN</h5>
                        <form action="{{route('user.update', $data->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" placeholder="Masukkan nama.." class="form-control @error('nama') is-invalid @enderror" value="{{$data->nama}}">
                                        <span class="text-danger">{{$errors->first('nama')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" placeholder="Masukkan email.." class="form-control @error('email') is-invalid @enderror" value="{{$data->email}}">
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="" disabled>Pilih role</option>
                                            <option value="masyarakat" @if($data->role == 'masyarakat') selected @endif>Masyarakat</option>
                                            <option value="petugas" @if($data->role == 'petugas') selected @endif>Petugas</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('role')}}</span>
                                    </div>
                                </div> --}}
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right mb-3">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{route('user.index')}}" class="btn btn-sm btn-outline-danger float-right">
                                <i class="feather icon-slash"></i> Batal
                            </a>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
