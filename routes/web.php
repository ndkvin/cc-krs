<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\MatkulMahasiswaController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/mahasiswa', MahasiswaController::class);
Route::resource('/matkul', MatkulController::class);
Route::post('/matkul_mahasiswa', [MatkulMahasiswaController::class, 'store']);
Route::get('/matkul_mahasiswa/{mahasiswa}', [MatkulMahasiswaController::class, 'show']);
Route::delete('/matkul_mahasiswa', [MatkulMahasiswaController::class, 'destroy']);