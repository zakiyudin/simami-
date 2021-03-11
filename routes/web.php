<?php

use App\Http\Controllers\MuadzinController;
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

Route::get('/', 'HomeController@index');

Route::get('/pemasukan_depan', 'PemasukanFrontController@index')->name('pemasukan_index');
Route::get('/pengeluaran_depan', 'PengeluaranFrontController@index')->name('pengeluaran_index');
Route::get('/penceramah_depan', 'PenceramahFrontController@index')->name('penceramah_index');
Route::get('/kegiata_depan', 'KegiatanFrontController@index')->name('kegiatan_index');


Route::get('/login', 'AuthController@login')->name('login');
Route::post('/doLogin', 'AuthController@doLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');




Route::group(['middleware' => ['auth', 'cekRole:admin,sekretaris']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/kegiatan', 'KegiatanController')->except(['show', 'update']);
});

Route::group(['middleware' => ['auth', 'cekRole:admin,bendahara']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/pemasukan/export', 'PemasukanController@export')->name('excel');
    Route::get('/pemasukan/print_pdf/{tgl_awal}/{tgl_akhir}', 'PemasukanController@print_pdf')->name('pdf');
    Route::get('/pengeluaran/print_pdf/{tgl_awal}/{tgl_akhir}', 'PengeluaranController@print_pdf')->name('pdf_pengeluaran');
    Route::resource('/pemasukan', 'PemasukanController');
    Route::resource('/pengeluaran', 'PengeluaranController');
    Route::resource('/rekaptulasi', 'RekaptulasiKeuanganController'); 
});



Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::resource('visi', 'VisiController');
    Route::resource('misi', 'MisiController');
    Route::resource('tentang', 'TentangController');
    Route::resource('penceramah', 'PenceramahController');
    Route::resource('users', 'UserController')->except('users.update');
    Route::resource('jenis_kegiatan', 'JenisKegiatanController');
});










