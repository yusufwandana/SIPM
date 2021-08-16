@extends('layouts.master-admin')

@section('title', 'Data Masyarakat')

@section('content')
<div class="card shadow mb-4 animated--grow-in">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md">
                <h4 class="m-0 font-weight-bold">Data Masyarakat</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            @if (Auth::user()->role == 'admin')
            <th>Aksi</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $item)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$item->nik}}</td>
                <td>{{ucwords($item->nama)}}</td>
                <td>@if ($item->jk == 'l') Laki-laki @elseif($item->jk == 'p') Perempuan @endif</td>
                <td>{{$item->no_telp}}</td>
                <td>{{$item->alamat}}</td>
                @if (Auth::user()->role == 'admin')
                <td>
                    <form action="{{route('masyarakat.hapus', $item->id)}}">
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data pengaduan ini?');">
                            <span class="fas fa-fw fa-trash"></span> Hapus
                        </button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection


{{-- <!-- Main Content -->
<div id="content">

<!-- Topbar -->


    <!-- Nav Item - Alerts -->
<!--             <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>

        <span class="badge badge-danger badge-counter">9999</span>
        </a>

        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Noftifikasi
        </h6>
        <a class="dropdown-item d-flex align-items-center">
            <div class="mr-3">
            <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
            </div>
            </div>
            <div>
            <div class="small text-gray-500">tgl</div>
            <span class="small text-dark-500">P</span>
            </div>
        </a>
        <a class="dropdown-item text-center small text-gray-500" href="#">Tampilkan semua Notifikasi</a>
        </div>
    </li>
    <div class="topbar-divider d-none d-sm-block"></div> -->

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 animated--grow-in d-lg-inline text-gray-600"><i class="fas fa-user fa-fw mr-2 text-gray-400"></i> </span>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="profil.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profil
        </a>
        <a onclick="dark();" class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Tema Gelap (Beta)
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Keluar
        </a>
        </div>
    </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4 animated--grow-in">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md">
                <h6 class="m-0 font-weight-bold text-primary float-left">DATA MASYARAKAT</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>No. Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $item)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ucwords($item->nama)}}</td>
                <td>@if ($item->jk == 'l') Laki-laki @elseif($item->jk == 'p') Perempuan @endif</td>
                <td>{{$item->no_telp}}</td>
                <td>{{$item->user->email}}</td>
                <td>{{$item->alamat}}</td>
                <td><a onclick="return confirm('Yakin ingin menghapus data pengaduan ini?');" href="{{route('masyarakat.hapus', $item->id)}}" class="btn btn-danger btn-sm"><span class="fas fa-fw fa-trash"></span></a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->
 --}}
