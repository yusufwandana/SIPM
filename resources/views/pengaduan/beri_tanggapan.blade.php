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

@section('title', 'Beri Tanggapan')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md" style="">
                <h3>
                    Pengaduan No. {{$data->id}}
                </h3>
                {{-- Penanggalan Format Indonesia --}}
                {{-- @php
                    $tgl = $data->tanggal;
                    $bulan = [
                        1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
                    ];
                    $x = explode('-',$tgl);
                    $tanggal = $x[2].' '.$bulan[(int)$x[1]].' '.$x[0];
                @endphp
                <p class="mb-0">Dikirim pada {{$tanggal}}.</p> --}}
                <p class="mb-0">{{time_since(strtotime($data->created_at))}}</p>
                <p>
                    Status:
                    <span class="@if($data->status == 'terkirim') text-primary @elseif($data->status == 'proses') text-warning @elseif($data->status == 'selesai') text-success @else text-danger @endif">
                        {{ucwords($data->status)}}
                    </span>
                </p>

                <div style="border-bottom-color:grey; border-bottom-width:1px;border-bottom-style:solid;">
                </div>
                <div class="mt-3">
                    <h4>Pengirim</h4>
                    <p class="mb-0 text-justify">
                        @if ($data->masyarakat->jk == 'l')
                            Bapak/Saudara
                        @else
                            Ibu/Saudari
                        @endif
                        {{$data->masyarakat->nama}} - NIK. {{$data->masyarakat->nik}}
                    </p>
                    <p class="mb-0">
                        Dari {{ucwords($data->masyarakat->alamat)}}
                    </p>
                </div>
                <div class="mt-3">
                    <h4>Pesan</h4>
                    <p class="mb-0 text-justify">
                        {{$data->teks_pengaduan}}
                    </p>
                </div>
                <div class="mt-3">
                    <form action="{{route('pengaduan.post_tanggapan')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Tambah tanggapan</h5>
                                <input type="hidden" name="pengaduan_id" value="{{$data->id}}">
                                <div class="form-group">
                                    <textarea name="teks_respon" id="teks_respon" cols="30" rows="5" class="form-control @error('teks_respon') is-invalid @enderror" placeholder="Masukkan tanggapan"></textarea>
                                    <span class="text-danger">{{$errors->first('teks_respon')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Status</h5>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih status</option>
                                        <option value="terkirim" @if($data->status == 'terkirim') selected @endif >Terkirim</option>
                                        <option value="proses" @if($data->status == 'proses') selected @endif >Proses</option>
                                        <option value="selesai" @if($data->status == 'selesai') selected @endif >Selesai</option>
                                        <option value="ditolak" @if($data->status == 'ditolak') selected @endif >Ditolak</option>
                                        <option value="dibatalkan" @if($data->status == 'dibatalkan') selected @endif >Batalkan</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('status')}}</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary btn-sm m-t-5 float-right" type="submit">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <a class="btn btn-outline-danger btn-sm m-t-5 float-right" href="{{route('pengaduan.index')}}" >
                            <i class="feather icon-slash"></i>
                            Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md">
                <a class="btn btn-outline-primary btn-sm m-t-5 collapsed float-left" data-toggle="collapse" href="#response{{$data->id}}" role="button" aria-expanded="false" aria-controls="response{{$data->id}}">
                    <i class="fas fa-comments"></i>
                    Tampilkan Tanggapan
                </a>
                <a class="btn btn-outline-primary btn-sm m-t-5 collapsed float-left" data-toggle="collapse" href="#photo{{$data->id}}" role="button" aria-expanded="false" aria-controls="photo{{$data->id}}">
                    <i class="fas fa-image"></i>
                    Tampilkan Foto
                </a>
            </div>
        </div>
    </div>
    <div class="collapse" id="response{{$data->id}}">
        <div class="card-body">
            <h5 class="mb-4">Tanggapan</h5>
                @if (count($data->tanggapan)>0)
                @foreach ($data->tanggapan as $respon)
                    <div class="row mb-4">
                        <div class="col-md">
                            <h6 style="line-height:0;">{{$respon->user->nama}} ({{$respon->user->role}})</h6>
                            <p class="mb-0">
                                {{time_since(strtotime($respon->created_at))}} | <a href="{{route('pengaduan.hapus_tanggapan', $respon->id)}}">Hapus</a>
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
    <div class="collapse" id="photo{{$data->id}}">
        <div class="card-body">
            <h4>Foto</h4>
            @if(!$data->foto)
                <p class="mb-0">
                    Tidak ada foto yang ditambahkan.
                </p>
            @else
                <img src="" alt="">
            @endif
        </div>
    </div>
</div>
@endsection
