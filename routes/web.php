<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProdiController;

Route::get('/', function () {
    return view('dashboard', [
        'jumlahProdi' => \App\Models\Prodi::count(),
        'jumlahMahasiswa' => \App\Models\Mahasiswa::count(),
        'jumlahMataKuliah' => \App\Models\MataKuliah::count(),
    ]);
})->name('dashboard');

Route::resource('prodi', ProdiController::class);
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('mata_kuliah', MataKuliahController::class);