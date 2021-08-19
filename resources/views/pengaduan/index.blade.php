<?php

    function time_since($original){
        date_default_timezone_set('Asia/Jakarta');
        $chunks = array(
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60, 'jam'),
            array(60, 'menit'),
            array(1, 'detik'),
        );

        $monthName = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

        $today = time();
        $since = $today - $original;

        if ($since > 604800){
            $date = date("j-m-Y", $original);
            $explode = explode('-', $date);
            $x=(int)$explode[1];
            $month = $monthName[$x];
            $print = $explode[0].' '.$month;


            if ($since > 31536000){
            $print .= ", " . date("Y", $original);
            }

            return $print;
        }

        for ($i = 0, $j = count($chunks); $i < $j; $i++){
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($since / $seconds)) != 0)
            break;
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
        return $print . ' yang lalu';
    }

?>


@extends('layouts.master-admin')

@section('title', 'Pengaduan')

@section('content')

@if ($msg = Session::get('success'))
<div class="row">
    <div class="col-md">
        <div class="alert alert-success">
            <i class="fas fa-check-circle mr-1"></i>
            {{$msg}}
        </div>
    </div>
</div>
@elseif($msg = Session::get('failed'))
<div class="row">
    <div class="col-md">
        <div class="alert alert-danger">
            <i class="fas fa-times-circle mr-1"></i>
            {{$msg}}
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Kolom pencarian</label>
                    <form action="{{route('pengaduan.cari')}}" method="get">
                        <div class="form-group" style="display: flex;">
                            <input type="text" name="kata_kunci" class="form-control" placeholder="Masukkan kata kunci" value="{{old('kata_kunci')}}">
                            <button class="btn btn-outline-primary mx-2" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($teks != null)
        <div class="row">
            <div class="col-md">
                <div class="alert alert-success">
                    Menampilkan {{$teks['jumlah']}} data yang berhubungan dengan kata '{{$teks['keyWord']}}'.
                </div>
            </div>
        </div>

        @endif
    </div>
</div>

@forelse ($data as $item)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <h3>Pengaduan No. {{$item->id}}
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                        <form action="{{route('pengaduan.hapus', $item->id)}}" method="post">
                            @csrf @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm m-t-5 collapsed float-right" onclick="return confirm('PENTING! Dengan mengklik OK, data ini dihapus dan tidak dapat kembali.')">
                                <i class="fas fa-trash"></i>
                                Hapus
                            </button>
                        </form>
                        @endif
                    </h3>
                    {{-- Penanggalan Format Indonesia --}}
                    {{-- @php
                        $tgl = $item->tanggal;
                        $bulan = [
                            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                        ];
                        $x = explode('-',$tgl);
                        $tanggal = $x[2].' '.$bulan[(int)$x[1]].' '.$x[0];
                    @endphp --}}
                    {{-- <p class="mb-0">Dikirim pada {{$tanggal}}.</p> --}}
                    <p class="mb-0">{{time_since(strtotime($item->created_at))}}</p>
                    <p>
                        Status:
                        <span class="@if($item->status == 'terkirim') text-primary @elseif($item->status == 'proses') text-warning @elseif($item->status == 'selesai') text-success @else text-danger @endif">
                            {{ucwords($item->status)}}
                        </span>
                        {{-- <span class="mb-0"> sejak {{time_since(strtotime($item->updated_at))}}</span> --}}
                    </p>

                    <div style="border-bottom-color:grey; border-bottom-width:1px;border-bottom-style:solid;">
                    </div>
                    <div class="mt-3">
                        <h4 class="text-center">{{$item->judul}}</h4>
                    </div>
                    <div class="mt-3">
                        <h4>Pengirim</h4>
                        <p class="mb-0 text-justify">
                            {{ $item->masyarakat->jk === 'l' ? 'Bapak/Saudara' : 'Ibu/Saudari' }}
                            {{ucwords($item->masyarakat->nama)}} - NIK. {{$item->masyarakat->nik}}
                        </p>
                        <p class="mb-0">
                            Dari {{ucwords($item->masyarakat->alamat)}}
                        </p>
                    </div>
                    <div class="mt-3">
                        <h4>Pesan</h4>
                        <p class="mb-0 text-justify">
                            {{$item->teks_pengaduan}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <a class="btn btn-outline-primary btn-sm m-t-5" href="{{route('pengaduan.beri_tanggapan', $item->id)}}">
                <i class="fas fa-reply"></i>
                Beri Tanggapan
            </a>
            @endif
            <a class="btn btn-outline-primary btn-sm m-t-5 collapsed" data-toggle="collapse" href="#response{{$item->id}}" role="button" aria-expanded="false" aria-controls="response{{$item->id}}">
                <i class="fas fa-comments"></i>
                Tanggapan
            </a>
            <a class="btn btn-outline-primary btn-sm m-t-5 collapsed" data-toggle="collapse" href="#photo{{$item->id}}" role="button" aria-expanded="false" aria-controls="photo{{$item->id}}">
                <i class="fas fa-image"></i>
                Foto
            </a>
            @if (Auth::user()->role == 'masyarakat' && $item->status != 'dibatalkan')
            <a class="btn btn-outline-danger btn-sm m-t-5" href="{{route('pengaduan.batalkan', $item->id)}}">
                <i class="fas fa-ban"></i>
                Batalkan
            </a>
            @endif
        </div>
        <div class="collapse" id="response{{$item->id}}">
            <div class="card-body">
                <h4 class="mb-4">Tanggapan</h4>
                    @if (count($item->tanggapan)>0)
                    @foreach ($item->tanggapan as $respon)
                        <div class="row mb-4">
                            <div class="col-md">
                                <h6 style="line-height:0;">{{ucwords($respon->user->nama)}}</h6>
                                <p class="mb-0">
                                    {{time_since(strtotime($respon->created_at))}} @if (Auth::user()->role == 'admin') | <a href="{{route('pengaduan.hapus_tanggapan', $respon->id)}}">Hapus</a> @endif
                                </p>
                                <div class="my-1" style="border-bottom-color:blue; border-bottom-width:2px;border-bottom-style:solid;width:50px;"></div>
                                <p class="mb-0">
                                    {{$respon->teks_respon}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <p class="mb-0">
                            Belum ada tanggapan, mohon bersabar ya..
                        </p>
                    @endif
            </div>
        </div>
        <div class="collapse" id="photo{{$item->id}}">
            <div class="card-body">
                <h4>Foto</h4>
                @if(!$item->foto)
                    <p class="mb-0">
                        Tidak ada foto yang ditambahkan.
                    </p>
                @else
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('images/pengaduan/'.$item->foto)}}" width="300px" alt="">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <p class="text-center" style="margin-bottom: 0;">Belum ada pengaduan saat ini..</p>
                </div>
            </div>
        </div>
    </div>
@endforelse

@endsection
