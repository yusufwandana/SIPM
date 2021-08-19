<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

// Authentication
Route::get('login', 'AuthController@index')->name('login');
Route::get('buat-akun', 'AuthController@register')->name('register');
Route::post('login/post', 'AuthController@login')->name('postlog');
Route::post('register/post', 'AuthController@postreg')->name('postreg');
Route::get('logout', 'AuthController@logout')->name('logout');

// Profile
Route::group(['middleware' => ['auth']], function(){
    Route::get('informasi-akun', 'UserController@myAccount')->name('myAccount');
});


Route::group(['middleware' => ['auth', 'cekRole:admin']], function(){
    // Petugas
    Route::get('petugas/tambah', 'PetugasController@create')->name('petugas.create');
    Route::post('petugas', 'PetugasController@addPetugas')->name('petugas.add');
    Route::get('petugas/{petugas:id}', 'PetugasController@edit')->name('petugas.edit');
    Route::put('petugas/{petugas:id}', 'PetugasController@update')->name('petugas.update');
    Route::delete('petugas/{petugas:id}', 'PetugasController@hapus')->name('petugas.hapus');
    // User
    Route::get('akun', 'UserController@index')->name('user.index');
    // Route::get('akun/{id}', 'UserController@edit')->name('user.edit');
    // Route::put('akun/{id}', 'UserController@update')->name('user.update');
    Route::delete('akun/{id}', 'UserController@delete')->name('user.delete');
});

Route::group(['middleware' => ['auth', 'cekRole:admin,petugas']], function(){
    // Dashboard
    Route::get('dashboard', 'DashboardController@admin')->name('dashboard.admin');
    // Data Petugas
    Route::get('petugas', 'PetugasController@index')->name('petugas.index');
    // Masyarakat
    Route::get('masyarakat', 'MasyarakatController@index')->name('masyarakat.index');
    Route::get('masyarakat/{masyarakat:id}', 'MasyarakatController@edit')->name('masyarakat.edit');
    Route::put('masyarakat/{masyarakat:id}', 'MasyarakatController@update')->name('masyarakat.update');
    Route::delete('masyarakat/{id}', 'MasyarakatController@hapus')->name('masyarakat.hapus');
    // Pengaduan
    Route::get('pengaduan/cari', 'PengaduanController@cari')->name('pengaduan.cari');
    Route::delete('pengaduan/{id}', 'PengaduanController@hapusPengaduan')->name('pengaduan.hapus');
    Route::get('pengaduan/beri-tanggapan/{id}', 'PengaduanController@beriTanggapan')->name('pengaduan.beri_tanggapan');
    Route::post('pengaduan/tanggapan/post', 'PengaduanController@postTanggapan')->name('pengaduan.post_tanggapan');
    Route::get('pengaduan/hapus-tanggapan/{id}', 'PengaduanController@hapusTanggapan')->name('pengaduan.hapus_tanggapan');
    // Laporan
    Route::get('laporan', 'PengaduanChartController@index')->name('pengaduan.laporan');
});

Route::group(['middleware' => ['auth', 'cekRole:admin,petugas,masyarakat']], function(){
    Route::get('dashboard/masyarakat', 'DashboardController@masyarakat')->name('dashboard.masyarakat');
    // Pengaduan
    Route::get('pengaduan', 'PengaduanController@index')->name('pengaduan.index');
    Route::get('pengaduan/pengajuan', 'PengaduanController@ajukanPengaduan')->name('pengaduan.ajukan');
    Route::post('pengaduan', 'PengaduanController@postPengaduan')->name('pengaduan.post');
    Route::get('pengaduan/batal/{id}', 'PengaduanController@batalkanPengaduan')->name('pengaduan.batalkan');
    Route::get('pengaduan/riwayat', 'PengaduanController@riwayatPengaduan')->name('pengaduan.riwayat');
});


