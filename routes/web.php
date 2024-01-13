<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\MahasiswaController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [SkripsiController::class, 'landingpage']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('about', function (){
    return view ('about');
});

Route::get('kontak', function (){
    return view ('kontak');
});

Route::middleware('auth')->group(function () {
    // Route Mahasiswa --------------------------------------------------------------------------------
    Route::get('/admin/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/admin/mahasiswa', [MahasiswaController::class, 'tambah'])->name('tambah.mahasiswa');
    Route::patch('/admin/mahasiswa/ubah', [MahasiswaController::class, 'ubah'])->name('ubah.mahasiswa');
    Route::get('admin/ajaxadmin/dataMahasiswa/{id}', [MahasiswaController::class, 'getDataMahasiswa']);
    Route::get('/admin/mahasiswa/hapus/{id}', [MahasiswaController::class,'hapus'])->name('hapus.mahasiswa');

    // Route Dosen ------------------------------------------------------------------------------------
    Route::get('/admin/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::post('/admin/dosen', [DosenController::class, 'tambah'])->name('tambah.dosen');
    Route::patch('/admin/dosen/ubah', [DosenController::class, 'ubah'])->name('ubah.dosen');
    Route::get('admin/ajaxadmin/dataDosen/{id}', [DosenController::class, 'getDataDosen']);
    Route::get('/admin/dosen/hapus/{id}', [DosenController::class, 'hapus'])->name('hapus.dosen');

    // Route Skripsi ----------------------------------------------------------------------------------
    Route::get('/admin/skripsi', [SkripsiController::class, 'index'])->name('skripsi');
    Route::post('/admin/skripsi', [SkripsiController::class, 'tambah'])->name('tambah.skripsi');
    Route::patch('/admin/skripsi/ubah', [SkripsiController::class, 'ubah'])->name('ubah.skripsi');
    Route::get('admin/ajaxadmin/dataSkripsi/{id}', [SkripsiController::class, 'getDataSkripsi']);
    Route::get('/admin/skripsi/hapus/{id}', [SkripsiController::class, 'hapus'])->name('hapus.skripsi');

});
// View File PDF -----------------------------------------------------------------------------------
Route::get('/pdf/{id}', [SkripsiController::class, 'showPdf'])->name('pdf.show');