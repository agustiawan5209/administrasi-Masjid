<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\TabelShalatController;
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

Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Route Jadwal Kegiatan
    Route::group(['prefix' => 'Kegiatan', 'as' => 'Kegiatan.'], function () {
        Route::controller(JadwalKegiatanController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');

            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    // Route Struktur Organisasi
    Route::group(['prefix' => 'Struktur', 'as' => 'Struktur.'], function () {
        Route::controller(StrukturOrganisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    // ROute Kajian
    Route::group(['prefix' => 'Kajian', 'as' => 'Kajian.'], function () {
        Route::controller(KajianController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');

            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });

    // Route Data Donatur
    Route::group(['prefix' => 'Donatur', 'as' => 'Donatur.'], function () {
        Route::controller(DonaturController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');

            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });

    // Route Data Artikel
    Route::group(['prefix' => 'Artikel', 'as' => 'Artikel.'], function () {
        Route::controller(ArtikelController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/detail', 'show')->name('show');

            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });
    // Route Jadwal Shalat
    Route::group(['prefix' => 'JadwalShalat', 'as' => 'JadwalShalat.'], function () {
        Route::controller(TabelShalatController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/edit_jumat', 'edit_jumat')->name('edit_jumat');
            Route::get('/detail', 'show')->name('show');

            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/updateJumat', 'updateJumat')->name('updateJumat');
            Route::delete('/delete', 'destroy')->name('delete');
            Route::delete('/deleteJumat', 'destroyJumat')->name('deleteJumat');
        });
    });
});
