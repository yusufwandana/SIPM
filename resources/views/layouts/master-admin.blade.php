<!DOCTYPE html>
<html lang="en">

<head>

	<title>@yield('title')</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Sistem Aplikasi Pengaduan Keluhan Masyarakat" />
	<meta name="keywords"
		content="pengaduan, sistem, aplikasi, laravel, bootstrap, javascript, masyarakat">
	<meta name="author" content="Codedthemes" />

	<link rel="icon" href="{{asset('lite/assets/images/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" href="{{asset('lite/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{asset('lite/assets/plugins/animation/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('lite/assets/css/style.css')}}">
    <script src="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        p, span{
            font-size: 16px;
        }
    </style>
</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	{{-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div> --}}
	</div>
	<!-- [ Pre-loader ] End -->

	@include('layouts.side')

	@include('layouts.header')

	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
                            @include('layouts.breadcrumb')
                            @yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end -->

	<!-- Required Js -->
	<script src="{{asset('lite/assets/js/vendor-all.min.js')}}"></script>
	<script src="{{asset('lite/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('lite/assets/js/pcoded.min.js')}}"></script>
    <script src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/template/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
	<script src="{{asset('custom/script.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.myTable').DataTable();
        });
    </script>

	@yield('customjs')

</body>

</html>
