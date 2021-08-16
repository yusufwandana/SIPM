<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Daftar Akun</title>
  <!-- Custom fonts for this template-->
  <link href="{{asset('template/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('template/admin/css/sb-admin-2.css')}}" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="row justify-content-center" style="margin-top:1.5%; margin-bottom:1.5%;">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="head text-center">
                        <h5>
                            <b>Buat Akun</b>
                        </h5>
                        <p>
                            Kantor Desa Cigombong <br>
                            Kabupaten Bogor
                        </p>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md my-3 px-3">
                            @if($msg = Session::get('failed'))
                                <div class="alert alert-danger">
                                    <small>{{$msg}}</small>
                                </div>
                            @endif
                            <form action="{{route('postreg')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="Masukkan NIK" value="{{old('nik')}}" autocomplete="off" onkeypress="return validationNumberOnly(event)" autofocus>
                                        <div>
                                            @error('nik')
                                                <small class="text-danger">{{$errors->first('nik')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama (sesuai KTP)" value="{{old('nama')}}" onkeypress="return validationAlpha(event)" autocomplete="off" autofocus>
                                        <div>
                                            @error('nama')
                                                <small class="text-danger">{{$errors->first('nama')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select class="form-control custom-select @error('jk') is-invalid @enderror" name="jk" id="jk">
                                            <option value="" selected disabled>Pilih jenis kelamin</option>
                                            <option value="l" @if(old('jk') == 'l') selected @endif>Laki-laki</option>
                                            <option value="p" @if(old('jk') == 'p') selected @endif>Perempuan</option>
                                        </select>
                                        <div>
                                            @error('jk')
                                                <small class="text-danger">{{$errors->first('jk')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telp">Nomor Telepon</label>
                                        <input class="form-control @error('no_telp') is-invalid @enderror" type="text" name="no_telp" id="no_telp" placeholder="Masukkan nomor telepon" value="{{old('no_telp')}}" onkeypress="return validationNumberOnly(event)">
                                        <div>
                                            @error('no_telp')
                                                <small class="text-danger custom-number">{{$errors->first('no_telp')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" value="{{old('email')}}" autocomplete="off" autofocus onkeypress="return validationEmail(event)">
                                        <div>
                                            @error('email')
                                                <small class="text-danger">{{$errors->first('email')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" value="{{old('password')}}" autocomplete="off" autofocus>
                                        <div>
                                            @error('password')
                                                <small class="text-danger">{{$errors->first('password')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" placeholder="Masukkan alamat">{{old('alamat')}}</textarea>
                                        <div>
                                            @error('alamat')
                                                <small class="text-danger">{{$errors->first('alamat')}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4 mt-3" onclick="return confirm('PENTING! Apakah Anda yakin bahwa data yang Anda masukan benar dan sesuai dengan data yang sebenarnya?')">Daftar</button>
                            </div>
                            </form>
                            <div class="text-center mt-2">
                                <small>Sudah punya akun? <a href="{{route('login')}}">Masuk</a>.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('template/admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('template/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('template/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('template/admin/js/sb-admin-2.min.js')}}"></script>
  <script src="{{asset('custom/script.js')}}"></script>

  {{-- <script>
    var numberOnly = document.getElementsByTagName('input');
    numberOnly.type = 'number';
    numberOnly.onkeypress = numberOnly;

    function numberOnly(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) 
            return false;
        return true;
        console.log('p');
    }
  </script> --}}


</body>
</html>
