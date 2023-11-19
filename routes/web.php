<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [PendudukController::class, 'index'])->name('penduduk');
Route::get('/create', [PendudukController::class, 'create'])->name('create.penduduk');
Route::get('/get-district', [PendudukController::class, 'getDistrict']);
Route::get('/get-filtered-data', [PendudukController::class, 'getFilteredData']);
Route::post('/store', [PendudukController::class, 'store'])->name('store.penduduk');
Route::get('/edit/{id}', [PendudukController::class, 'edit'])->name('edit.penduduk');
Route::put('/update/{id}', [PendudukController::class, 'update'])->name('update.penduduk');
Route::delete('/delete/{id}', [PendudukController::class, 'destroy'])->name('delete.penduduk');

Route::get('/report/penduduk/province', [ReportController::class, 'reportPendudukProvince'])->name('report.penduduk.province');
Route::get('/report/penduduk/district', [ReportController::class, 'reportPendudukDistrict'])->name('report.penduduk.district');