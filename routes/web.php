<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MasterFakultasController;


use App\Http\Controllers\MasterProdiController;


use App\Http\Controllers\MasterMahasiswaController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# ROUTE MASTER FAKULTAS

Route::middleware(['auth'])->prefix('fakultas')->as('fakultas.')->group(function () {

    Route::get('/', [MasterFakultasController::class, 'index'])->name('index');
    Route::get('/data', [MasterFakultasController::class, 'data'])->name('data');
    Route::get('/add', [MasterFakultasController::class, 'add'])->name('add');
    Route::post('/save', [MasterFakultasController::class, 'save'])->name('save');

});

# ROUTE MASTER PRODI

Route::middleware(['auth'])->prefix('prodi')->as('prodi.')->group(function () {

    Route::get('/', [MasterProdiController::class, 'index'])->name('index');

});

# ROUTE MASTER MAHASISWA

Route::middleware(['auth'])->prefix('mahasiswa')->as('mahasiswa.')->group(function () {

    Route::get('/', [MasterMahasiswaController::class, 'index'])->name('index');

});

