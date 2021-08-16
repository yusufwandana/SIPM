@extends('layouts.master-admin')

@section('title', 'Laporan Pengaduan')

@section('content')

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Grafik Data Pengaduan</h4>
            </div>
            <div class="card-body">

                {!! $chart->container() !!}

                {!! $chart->script() !!}

            </div>
        </div>
    </div>
</div>

@endsection
