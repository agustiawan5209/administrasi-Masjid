<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class,'index'])->name('welcome');
Route::get('/pengumuman', [HomeController::class,'artikel'])->name('pengumuman');
Route::get('/pengumuman/{tanggal}', [HomeController::class,'showArtikel'])->name('pengumuman.detail');
Route::get('/jadwal-kegiatan', [HomeController::class,'kegiatan'])->name('kegiatan-masjid');
Route::get('/jadwal-kajian', [HomeController::class,'kajian'])->name('kajian-masjid');
Route::get('/struktur-organisasi', [HomeController::class,'struktur'])->name('struktur-masjid');
Route::get('/laporan-kas', [HomeController::class,'laporankas'])->name('laporankas-masjid');
Route::get('/tentang', [HomeController::class,'tentang'])->name('tentang-masjid');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/bendahara.php';

