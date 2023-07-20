<?php

use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\StrukturOrganisasiController;
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

Route::middleware(['auth','role:Admin'])->group(function(){
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
    Route::group(['prefix' => 'Struktur', 'as' => 'Struktur.'], function () {
        Route::controller(StrukturOrganisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
    });
});
