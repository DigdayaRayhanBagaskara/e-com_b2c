<?php

use App\Http\Middleware\Customer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'Admin'])
    ->group(function () {

        Route::get('/','DashboardController@index');
        
        //Master Data
            //Kelola User
            Route::resource('/kelola_user', 'UserController');

            Route::resource('/profil_admin', 'ProfilController');

            //Kelola Menu
            Route::resource('/kelola_menu', 'MenuController');
            
            //Kelola Rekening
            Route::resource('/kelola_rekening', 'RekeningController');
        
        //Kelola Pesanan 
        Route::resource('/kelola_pesanan', 'PesananController');
        Route::post('/kelola_pesanan/proses/{id}', 'PesananController@proses');
        Route::get('/kelola_pesanan/profile-customer/{id}', 'PesananController@profileCustomer');
        
        Route::get('/laporan_transaksi', 'PesananController@laporanTransaksi');
        Route::post('/laporan_transaksi/cetak', 'PesananController@laporanTransaksiCetak');
    });

Route::prefix('customer')
    ->namespace('App\Http\Controllers\Customer')
    ->middleware(['auth', 'Customer'])
    ->group(function () {

        Route::get('/','CustomerController@index');

        Route::get('/profile','CustomerController@profile');
        Route::put('/profile-change/{id}','CustomerController@profileChange');

        Route::get('/menu','CustomerController@menu');

        Route::get('/riwayat','CustomerController@riwayat');
        Route::get('/riwayatDetail/{id}','CustomerController@riwayatDetail');
        Route::delete('/riwayatHapus/{id}','CustomerController@riwayatHapus');

        Route::get('/keranjang','CustomerController@keranjang');

        Route::get('/pembayaran','CustomerController@pembayaran');
        Route::post('/pembayaranProses','CustomerController@pembayaranProses');
    });

Auth::routes();
