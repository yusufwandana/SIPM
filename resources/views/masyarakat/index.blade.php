@extends('layouts.master-admin')

@section('title', 'Data Masyarakat')

@section('content')
<div class="card shadow mb-4 animated--grow-in">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md">
                <h3 class="m-0 font-weight-bold">Data Masyarakat</h3>
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
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
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
                <td>{{$item->user->email}}</td>
                <td>{{$item->no_telp}}</td>
                <td>{{$item->alamat}}</td>
                @if (Auth::user()->role == 'admin')
                <td>
                    <form action="{{route('masyarakat.hapus', $item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{route('masyarakat.edit', $item->id)}}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i>Edit</a>
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
