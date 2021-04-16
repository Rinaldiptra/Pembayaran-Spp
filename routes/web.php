<?php
use App\Http\Controllers\kelasController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\sppController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\logBayar;
use App\Http\Controllers\logsiswaController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\petugasController;

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
Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::resource('pembayaran', pembayaranController::class);
    Route::resource('spp', sppController::class);
    Route::resource('kelas', kelasController::class);
    Route::resource('siswa', siswaController::class);
    Route::resource('log', logBayar::class);
    Route::resource('logsiswa', logsiswaController::class);
    // Route::resource('petugas', petugasController::class);
    Route::resource('employ', petugasController::class);
    Route::get('/laporan/excel', [logBayar::class, 'excel']);
    Route::get('/pembayaran/get-data/{nisn}', [pembayaranController::class,  'getData']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});

