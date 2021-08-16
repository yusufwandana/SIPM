<!DOCTYPE html>
<html lang="en">

<head>

	<title>@yield('title')</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords"
		content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />

	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('lite/assets/images/favicon.ico')}}" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="{{asset('lite/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
	<!-- animation css -->
	<link rel="stylesheet" href="{{asset('lite/assets/plugins/animation/css/animate.min.css')}}">
	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('lite/assets/css/style.css')}}">
    {{-- Data tables --}}
    <script src="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"></script>
	{{-- Ajax --}}
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- Custom styles for this page -->
    <link href="{{asset('template/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        p, span{
            font-size: 16px;
        }
    </style>
</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
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
    <script src="{{asset('/template/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/template/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('/template/admin/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <script>
        $(document).ready(function() {
            $('.myTable').DataTable();
        });
    </script>

	@yield('customjs')

</body>

</html>
