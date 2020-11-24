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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/doLogin', 'AuthController@doLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::resource('penceramah', 'PenceramahController');
    Route::resource('users', 'UserController')->except('users.update');
    Route::resource('jenis_kegiatan', 'JenisKegiatanController');
});

Route::group(['middleware' => ['auth', 'cekRole:admin,bendahara']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('/pemasukan', 'PemasukanController');
    Route::get('/pemasukan/export', 'PemasukanController@export')->name('excel');
    Route::get('/pemasukan/print_pdf', 'PemasukanController@print_pdf')->name('pdf');
    Route::resource('/pengeluaran', 'PengeluaranController');
   
});

Route::group(['middleware' => ['auth', 'cekRole:admin,sekretaris']], function () {
    Route::get('/kegiatan', 'KegiatanController@index');
    Route::get('/kegiatan/create', 'KegiatanController@create');
    Route::get('/kegiatan/store', 'KegiatanController@store');
    Route::get('/kegiatan/{id}/destroy', 'KegiatanController@destroy');
});
