<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MasterFakultasController;
use App\Http\Controllers\MasterProdiController;

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

# ROUTE FAKULTAS

Route::group([

    'prefix'     => 'fakultas',
    'as'         => 'fakultas.',
    'middleware' => ['auth']

], function () {

    Route::get('/', [MasterFakultasController::class, 'index'])->name('index');
    Route::get('/data', [MasterFakultasController::class, 'data'])->name('data');
    Route::get('/add', [MasterFakultasController::class, 'add'])->name('add');
    Route::post('/save', [MasterFakultasController::class, 'save'])->name('save');
    Route::get('/edit', [MasterFakultasController::class, 'edit'])->name('edit');
    Route::post('/update', [MasterFakultasController::class, 'update'])->name('update');
    Route::post('/aktif', [MasterFakultasController::class, 'aktif'])->name('aktif');
    Route::post('/nonaktif', [MasterFakultasController::class, 'nonaktif'])->name('nonaktif');

});

# ROUTE PRODI

Route::group([

    'prefix'     => 'prodi',
    'as'         => 'prodi.',
    'middleware' => ['auth']

], function () {

    Route::get('/', [MasterProdiController::class, 'index'])->name('index');
    Route::get('/data', [MasterProdiController::class, 'data'])->name('data');
    Route::get('/add', [MasterProdiController::class, 'add'])->name('add');
    Route::post('/save', [MasterProdiController::class, 'save'])->name('save');
    Route::get('/edit', [MasterProdiController::class, 'edit'])->name('edit');
    Route::post('/update', [MasterProdiController::class, 'update'])->name('update');
    Route::post('/aktif', [MasterProdiController::class, 'aktif'])->name('aktif');
    Route::post('/nonaktif', [MasterProdiController::class, 'nonaktif'])->name('nonaktif');

});

# ROUTE MAHASISWA

Route::group([

    'prefix'     => 'mahasiswa',
    'as'         => 'mahasiswa.',
    'middleware' => ['auth']

], function () {

    Route::get('/', [MasterMahasiswaController::class, 'index'])->name('index');
    Route::get('/data', [MasterMahasiswaController::class, 'data'])->name('data');
    Route::get('/add', [MasterMahasiswaController::class, 'add'])->name('add');
    Route::post('/save', [MasterMahasiswaController::class, 'save'])->name('save');
    Route::get('/edit', [MasterMahasiswaController::class, 'edit'])->name('edit');
    Route::post('/update', [MasterMahasiswaController::class, 'update'])->name('update');
    Route::post('/aktif', [MasterMahasiswaController::class, 'aktif'])->name('aktif');
    Route::post('/nonaktif', [MasterMahasiswaController::class, 'nonaktif'])->name('nonaktif');

});





