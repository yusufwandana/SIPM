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
    Route::post('petugas/tambah/post', 'PetugasController@addPetugas')->name('petugas.add');
    Route::get('petugas/edit/{id}', 'PetugasController@edit')->name('petugas.edit');
    Route::post('petugas/update/{id}', 'PetugasController@update')->name('petugas.update');
    Route::delete('petugas/hapus/{id}', 'PetugasController@hapus')->name('petugas.hapus');
    // User
    Route::get('akun', 'UserController@index')->name('user.index');
    Route::get('akun/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::delete('akun/delete/{id}', 'UserController@delete')->name('user.delete');
});

Route::group(['middleware' => ['auth', 'cekRole:admin,petugas']], function(){
    // Dashboard
    Route::get('dashboard', 'DashboardController@admin')->name('dashboard.admin');
    // Data Petugas
    Route::get('petugas', 'PetugasController@index')->name('petugas.index');
    // Masyarakat
    Route::get('masyarakat', 'MasyarakatController@index')->name('masyarakat.index');
    Route::delete('masyarakat/hapus/{id}', 'MasyarakatController@hapus')->name('masyarakat.hapus');
    Route::get('pengaduan/cari', 'PengaduanController@cari')->name('pengaduan.cari');
    Route::delete('pengaduan/hapus/{id}', 'PengaduanController@hapusPengaduan')->name('pengaduan.hapus');
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
    Route::get('ajukan-pengaduan', 'MasyarakatController@ajukanPengaduan')->name('pengaduan.ajukan');
    Route::post('riwayat-pengaduan', 'MasyarakatController@postPengaduan')->name('pengaduan.post');
    Route::get('batalkan-pengaduan/{id}', 'MasyarakatController@batalkanPengaduan')->name('pengaduan.batalkan');
    Route::get('riwayat-pengaduan', 'MasyarakatController@riwayatPengaduan')->name('pengaduan.riwayat');
});


