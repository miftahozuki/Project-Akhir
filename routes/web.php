<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['role:admin']], function () {
        Route::name('admin.')->group(function () {
            Route::resource('mahasiswa', 'StudentController');
            Route::post('mahasiswa/filter', 'StudentController@index')->name('mahasiswa.filter');

            Route::resource('user', 'UserController');
            Route::post('user/filter', 'UserController@index')->name('user.filter');

            Route::resource('jurusan', 'MajorController');
            Route::post('jurusan/filter', 'MajorController@index')->name('jurusan.filter');

            Route::resource('kelas', 'GradeController');
            Route::post('kelas/filter', 'GradeController@index')->name('kelas.filter');

            Route::resource('ukt', 'BillController');

            Route::get('laporan', 'PDFController@index');
        });
    });

    Route::group(['middleware' => ['role:admin,petugas']], function () {
        Route::get('pembayaran', 'PaymentController@index')->name('payment.index');
        Route::post('pembayaran/cari', 'PaymentController@search')->name('payment.search');
        Route::post('pembayaran', 'PaymentController@store')->name('payment.store');
    });

    Route::group(['middleware' => ['role:admin,petugas,siswa']], function () {
        Route::get('riwayat', 'HistoryController@index')->name('history.index');
    });
});
