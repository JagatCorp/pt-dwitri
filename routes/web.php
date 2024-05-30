<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

// Route::get('/', function () {
//     $users = DB::table('users')->get();
//         return view('login', compact('users'));
// });

Route::get('reset', [AdminController::class, 'reset']);
Route::post('cek_login', [AdminController::class, 'cek_login']);
Route::get('logout', [AdminController::class, 'logout']);
Route::get('user', [AdminController::class, 'user']);
Route::post('simpanuser', [AdminController::class, 'simpanuser']);
Route::get('hapususer/{id}', [AdminController::class, 'hapususer']);

Route::get('pegawai', [AdminController::class, 'pegawai']);
Route::post('simpanpegawai', [AdminController::class, 'simpanpegawai']);
Route::get('hapuspegawai/{id}', [AdminController::class, 'hapuspegawai']);

Route::get('nidi', [AdminController::class, 'nidi']);
Route::post('simpannidi', [AdminController::class, 'simpannidi']);
Route::get('hapusnidi/{id}', [AdminController::class, 'hapusnidi']);

Route::get('slo', [AdminController::class, 'slo']);
Route::post('simpanslo', [AdminController::class, 'simpanslo']);
Route::get('hapusslo/{id}', [AdminController::class, 'hapusslo']);


Route::get('jenisjasa', [AdminController::class, 'jenisjasa']);
Route::post('simpanjenisjasa', [AdminController::class, 'simpanjenisjasa']);
Route::get('hapusjenisjasa/{id}', [AdminController::class, 'hapusjenisjasa']);

Route::get('jenispengadaan', [AdminController::class, 'jenispengadaan']);
Route::post('simpanjenispengadaan', [AdminController::class, 'simpanjenispengadaan']);
Route::get('hapusjenispengadaan/{id}', [AdminController::class, 'hapusjenispengadaan']);

Route::get('pengadaan', [AdminController::class, 'pengadaan']);
Route::post('simpanpengadaan', [AdminController::class, 'simpanpengadaan']);
Route::get('hapuspengadaan/{id}', [AdminController::class, 'hapuspengadaan']);
