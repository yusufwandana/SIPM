@extends('layouts.master-admin')

@section('title','Ajukan Pengaduan')

@section('content')
<div class="row justify-content-center animated--grow-in">
    <div class="col-md">
        <div class="card o-hidden border-0">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="px-5 py-4">
                            <h3 class="mb-0">Form Pengajuan Pengaduan</h3>
                            <p class="mb-0">Sampaikan pengaduan Anda disini, kami siap melayani</p>
                            <small class="my-0">
                                <i>*Anda hanya bisa mengajukan satu Pengaduan dalam sehari</i>
                            </small>
                            <hr>
                            <form action="{{route('pengaduan.post')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" placeholder="Masukan Judul Pengaduan" value="{{old('judul')}}">
                                    @error('judul')
                                        <span class="text-danger mt-1" style="font-size:14px;">{{$errors->first('judul')}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea type="text" rows="8" cols="5" name="teks_pengaduan" class="form-control @error('teks_pengaduan') is-invalid @enderror" placeholder="Ketikan Teks Pengaduan">{{old('teks_pengaduan')}}</textarea>
                                    @error('teks_pengaduan')
                                        <span class="text-danger mt-1" style="font-size:14px;">{{$errors->first('teks_pengaduan')}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="customFile">Tambahkan foto</label> --}}
                                    <div class="custom-file">
                                        <input type="file" name="file" id="customFile" class="custom-file-input">
                                        <label for="customFile" class="custom-file-label" style="text-align:left;">
                                            Tambahkan foto (opsional)
                                        </label>
                                        @error('file')
                                            <span class="text-danger mt-1" style="font-size:14px;">{{$errors->first('file')}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" onclick="return confirm('Kirim pengaduan ini?');" class="btn btn-outline-primary btn-user">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#customFile').on('change', function(){
                var x = $(this).val();
                var fileName = x.substring(12,999);
                $(this).next('.custom-file-label').html(fileName);
            });
        })
    </script>
@endsection