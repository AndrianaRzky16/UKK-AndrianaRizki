<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\petugasController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\sppController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\pembayaranController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('pembayaran', pembayaranController::class);
Route::resource('spp', sppController::class);
Route::resource('kelas', kelasController::class);
Route::resource('siswa', siswaController::class);
Route::resource('log', logBayar::class);
Route::resource('logsiswa', logsiswaController::class);
// Route::resource('petugas', petugasController::class);
Route::resource('employ', petugasController::class);
Route::get('siswa/json', 'SiswaController@json');
Route::get('/laporan/excel', [logBayar::class, 'excel']);
route::get('/history/index', [HistoryController::class, 'index'])->name('history.index');
route::get('/history', [HistoryController::class, 'indexx'])->name('history.indexx');
route::get('/history/export_excel', [HistoryController::class, 'export_excel'])->name('history.export_excel');

Route::get('/pembayaran/create2', [PembayaranController::class, 'create2'])->name('pembayaran.create2')->middleware('auth');
Route::post('/pembayaran/create2', [PembayaranController::class, 'store2'])->name('pembayaran.store2')->middleware('auth');
// GET DATA SPP
Route::get('pembayaran/getData/{nisn}/{berapa}', [PembayaranController::class, 'getData'])->name('pembayaran.getData');

// EXPORT EXCEL
Route::get('export/pembayaran', [PembayaranController::class, 'excelExport'])->name('pembayaran.export');
Route::get('generate-pdf/{nisn}', [PembayaranController::class, 'generatePDF'])->name('print.pdf');
