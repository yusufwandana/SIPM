@extends('layouts.master-admin')

@section('title', 'Data Petugas')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center animated--grow-in">
      <div class="col-xl col-lg col-md">
        <div class="card o-hidden border-0">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg px-5 py-4">
                  <h5 class="text-gray-900">Form Tambah Petugas</h5>
                  <hr>
                  <form action="{{route('petugas.add')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" name="nama" placeholder="Masukkan nama.." class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" onkeypress="return validationAlpha(event)">
                              <label class="text-danger">{{$errors->first('nama')}}</label>
                            </div>
                            <div class="form-group">
                              <label for="jk">Jenis kelamin</label>
                              <select name="jk" id="jk" class="form-control custom-select @error('jk') is-invalid @enderror">
                                  <option value="" selected disabled>Pilih jenis kelamin..</option>
                                  <option value="l">Laki-laki</option>
                                  <option value="p">Perempuan</option>
                              </select>
                              <label class="text-danger">{{$errors->first('jk')}}</label>
                            </div>
                            <div class="form-group">
                              <label for="no_telp">Nomor telepon</label>
                              <input type="number" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon.." class="form-control @error('no_telp') is-invalid @enderror" value="{{old('no_telp')}}" onkeypress="return validationNumberOnly(event)">
                              <label class="text-danger">{{$errors->first('no_telp')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" id="email" name="email" placeholder="Masukkan email.." class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" onkeypress="return validationEmail(event)">
                              <label class="text-danger">{{$errors->first('email')}}</label>
                            </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" id="password" name="password" placeholder="Masukkan password.." class="form-control @error('password') is-invalid @enderror">
                              <label class="text-danger">{{$errors->first('password')}}</label>
                            </div>
                          <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea type="text" name="alamat" id="alamat" rows="5" cols="5" name="alamat" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan alamat...">{{old('alamat')}}</textarea>
                              <label class="text-danger">{{$errors->first('alamat')}}</label>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{route('petugas.index')}}" class="btn btn-sm btn-outline-danger float-right">
                                <i class="feather icon-slash"></i> Batal
                            </a>
                        </div>
                    </div>
                  </form>
                  <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
