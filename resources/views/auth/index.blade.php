<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <link rel="icon" href="{{asset('lite/assets/images/favicon.ico')}}" type="image/x-icon">
  <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{asset('template/css/sb-admin-2.css')}}" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="row justify-content-center" style="margin-top:10%;">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <div class="head text-center">
                        <h5>
                            <b>Login</b>
                        </h5>
                        <p>
                            Kantor Desa Cigombong <br>
                            Kabupaten Bogor
                        </p>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-md-11 my-3">
                            @if($msg = Session::get('success'))
                                <div class="alert alert-success">
                                    <small>{{$msg}}</small>
                                </div>
                            @endif
                            @if($msg = Session::get('failed'))
                                <div class="alert alert-danger">
                                    <small>{{$msg}}</small>
                                </div>
                            @endif
                            <form action="{{route('postlog')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" value="{{old('email')}}" autocomplete="off" autofocus>
                                    <div>
                                        @error('email')
                                            <small class="text-danger">{{$errors->first('email')}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password">
                                    @error('password')
                                        <small class="text-danger">{{$errors->first('password')}}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="mt-4 btn btn-primary btn-user btn-block">Masuk</button>
                            </form>
                            <div class="text-center mt-4">
                                <small>Belum punya akun? <a href="{{route('register')}}">Buat akun</a>.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>
</body>
</html>
