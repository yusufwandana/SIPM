@extends('layouts.master-admin')

@section('title', 'Akun Saya')

@section('content')
<div class="card shadow mb-4 animated--grow-in">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md">
                <h4 class="font-weight-bold mt-2">Informasi Umum</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
    @if($msg = Session::get('failed'))
        <div class="alert alert-danger">
            {{$msg}}
        </div>
    @elseif($msg = Session::get('success'))
        <div class="alert alert-success">
            {{$msg}}
        </div>
    @endif

    <div class="row px-4">
        <div class="col-md-5">
            <div class="text-center">
                <img src="{{asset('/images/foto-profil/snapx-logo.png')}}" alt="Foto profil saya" class="mb-3 text-center" width="100%">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="file" id="customFile" class="custom-file-input">
                            <label for="customFile" class="custom-file-label" style="text-align:left;">
                                Ganti foto profil
                            </label>
                            @error('file')
                                <span class="text-danger mt-1" style="font-size:14px;">{{$errors->first('file')}}</span>
                            @enderror
                        </div>
                        <button class="btn btn-success mt-3 float-left"> <i class="fas fa-save"></i>Update foto</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" name="" value="{{$data->nama}}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="" value="{{$data->email}}" readonly>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" class="form-control" name="" value="{{ucwords($data->role)}}" readonly>
            </div>
            
        </div>
    </div>

    </div>
</div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#customFile').on('change', function(){
                var x = $(this).val();
                var fileName = x.substring(12,999);
                $(this).next('.custom-file-label').html(fileName);
            });
        })
    </script>
@endsection