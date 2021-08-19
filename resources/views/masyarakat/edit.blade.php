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
                        <h3 class="m-0 font-weight-bold border-bottom pb-2 mb-3">Edit Data Masyarakat</h3>
                        <form action="{{route('masyarakat.update', $masyarakat->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" placeholder="Masukkan NIK.." class="form-control @error('nik') is-invalid @enderror" value="{{$masyarakat->nik}}" onkeypress="return validationNumberOnly(event)">
                                        <label class="text-danger">{{$errors->first('nik')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" placeholder="Masukkan nama.." class="form-control @error('nama') is-invalid @enderror" value="{{$masyarakat->nama}}" onkeypress="return validationAlpha(event)">
                                        <label class="text-danger">{{$errors->first('nama')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <br>
                                        <div class="custom-control custom-radio custom-control-inline mt-2">
                                            <input type="radio" id="jk1" name="jk" class="custom-control-input" value="l" {{$masyarakat->jk === 'l' ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="jk1">Laki-laki</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="jk2" name="jk" class="custom-control-input" value="p" {{$masyarakat->jk === 'p' ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="jk2">Perempuan</label>
                                          </div>
                                        <label class="text-danger">{{$errors->first('jk')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" placeholder="Masukkan email.." class="form-control @error('email') is-invalid @enderror" value="{{$masyarakat->user->email}}" onkeypress="return validationEmail(event)">
                                        <label class="text-danger">{{$errors->first('email')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_telp">No.Telp</label>
                                        <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan no_telp.." class="form-control @error('no_telp') is-invalid @enderror" value="{{$masyarakat->no_telp}}" onkeypress="return validationNumberOnly(event)">
                                        <label class="text-danger">{{$errors->first('no_telp')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" placeholder="Masukkan alamat.." class="form-control @error('alamat') is-invalid @enderror" rows="5">{{$masyarakat->alamat}}</textarea>
                                        <label class="text-danger">{{$errors->first('alamat')}}</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right mb-3">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{route('masyarakat.index')}}" class="btn btn-sm btn-outline-danger float-right">
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
