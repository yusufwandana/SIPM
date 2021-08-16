@extends('layouts.master-admin')

@section('title', 'Akun Pengguna')

@section('content')
<div class="card shadow mb-4 animated--grow-in">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md">
                <h4 class="font-weight-bold mt-2">Akun Pengguna</h4>
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
        <table class="table table-bordered table-sm" id="dataTable" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            @if (Auth::user()->role == 'admin')
            <th width="100px">Aksi</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $item)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ucwords($item->nama)}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <p class="badge @if($item->role == 'admin') badge-primary @elseif($item->role == 'petugas') badge-warning @elseif($item->role == 'masyarakat') badge-success @endif">
                        {{$item->role}}
                    </p>
                </td>
                @if (Auth::user()->role == 'admin')
                <td>
                    <form action="{{route('user.delete', $item->id)}}" method="post">
                        @csrf @method('delete')
                        <a href="{{route('user.edit', $item->id)}}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i>Edit</a>
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Jika Anda menghapus data ini, maka seluruh data yang berhubungan dengan data ini akan ikut terhapus. Anda yakin?')">
                            <i class="fas fa-trash"></i>Hapus
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
