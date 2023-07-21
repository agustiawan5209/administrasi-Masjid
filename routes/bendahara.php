<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataDonaturController;
use App\Http\Controllers\KasMasjidController;
use App\Http\Controllers\LaporanController;

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

Route::middleware(['auth', 'role:bendahara'])->group(function () {

    // Route Jadwal DataDonatur
    Route::group(['prefix' => 'DataDonatur', 'as' => 'DataDonatur.'], function () {
        Route::controller(DataDonaturController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');
            Route::get('/getDonatur', 'GetDonatur')->name('getDonatur');

            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });
    // Route kas Masjid

    Route::group(['prefix' => 'KasMasjid', 'as' => 'KasMasjid.'], function () {
        Route::controller(KasMasjidController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');
            Route::get('/getDonatur', 'GetDonatur')->name('getDonatur');

            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });
    Route::group(['prefix' => 'Laporan', 'as' => 'Laporan.'], function () {
        Route::controller(LaporanController::class)->group(function () {
            Route::get('/keuangan', 'LaporanKeuangan')->name('keuangan-bendahara');
            Route::get('Excel', 'generateLaporanKeuanganExcel')->name('keuangan-Export-Excel');
            Route::get('PDF', 'generateLaporanKeuanganPDF')->name('keuangan-Export-PDF');
        });
    });

});
