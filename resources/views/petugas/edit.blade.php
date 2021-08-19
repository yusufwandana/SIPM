@extends('layouts.master-admin')

@section('title', 'Edit Data Petugas')

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
                        <h3 class="m-0 font-weight-bold">Edit Data Petugas</h3>
                        <hr>
                        <form action="{{route('petugas.update', $petugas->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" placeholder="Masukkan nama.." class="form-control @error('nama') is-invalid @enderror" value="{{$petugas->nama}}" onkeypress="return validationAlpha(event)">
                                        <label class="text-danger">{{$errors->first('nama')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="jk1" name="jk" class="custom-control-input" value="l" {{$petugas->jk === 'l' ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="jk1">Laki-laki</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="jk2" name="jk" class="custom-control-input" value="p" {{$petugas->jk === 'p' ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="jk2">Perempuan</label>
                                          </div>
                                        <label class="text-danger">{{$errors->first('jk')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No.Telp</label>
                                        <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan no_telp.." class="form-control @error('no_telp') is-invalid @enderror" value="{{$petugas->no_telp}}" onkeypress="return validationNumberOnly(event)">
                                        <label class="text-danger">{{$errors->first('no_telp')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" placeholder="Masukkan email.." class="form-control @error('email') is-invalid @enderror" value="{{$petugas->user->email}}" onkeypress="return validationEmail(event)">
                                        <label class="text-danger">{{$errors->first('email')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" placeholder="Masukkan alamat.." class="form-control @error('alamat') is-invalid @enderror" rows="5">{{$petugas->alamat}}</textarea>
                                        <label class="text-danger">{{$errors->first('alamat')}}</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" placeholder="Masukkan nama.." class="form-control @error('nama') is-invalid @enderror" value="{{$data->nama}}">
                                        <span class="text-danger">{{$errors->first('nama')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="jk">Jenis kelamin</label>
                                        <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                                            <option value="" disabled>Pilih jenis kelamin..</option>
                                            <option value="l" @if($data->jk == 'l') selected @endif>Laki-laki</option>
                                            <option value="p" @if($data->jk == 'p') selected @endif>Perempuan</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('jk')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">Nomor telepon</label>
                                        <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon.." class="form-control @error('no_telp') is-invalid @enderror" value="{{$data->no_telp}}">
                                        <span class="text-danger">{{$errors->first('no_telp')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea type="text" name="alamat" id="alamat" rows="5" cols="5" name="teks_masalah" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat...">{{$data->alamat}}</textarea>
                                        <span class="text-danger">{{$errors->first('alamat')}}</span>
                                    </div>
                                </div>
                            </div> --}}
                            <hr>
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right mb-3">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{route('petugas.index')}}" class="btn btn-sm btn-outline-danger float-right">
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
