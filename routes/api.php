<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\PelangganController;
use App\http\Controllers\KasirController;
use App\http\Controllers\PaketController;
use App\http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pelanggan
Route::get('/getpelanggan',[PelangganController::class,'getpelanggan']);
Route::get('/getid_pelanggan/{id_pelanggan}',[PelangganController::class,'getid_pelanggan']);
Route::post('/createpelanggan',[PelangganController::class,'createpelanggan']);
Route::put('/updatepelanggan/{id_pelanggan}',[PelangganController::class, 'updatepelanggan']);
Route::delete('/deletepelanggan/{id_pelanggan}',[PelangganController::class, 'deletepelanggan']);

//Kasir
Route::get('/getkasir',[KasirController::class,'getkasir']);
Route::get('/getid_kasir/{id_kasir}',[KasirController::class,'getid_kasir']);
Route::post('/createkasir',[KasirController::class,'createkasir']);
Route::put('/updatekasir/{id_kasir}',[KasirController::class, 'updatekasir']);
Route::delete('/deletekasir/{id_kasir}',[KasirController::class, 'deletekasir']);

//Paket
Route::get('/getpaket',[PaketController::class,'getpaket']);
Route::get('/getid_paket/{id_paket}',[PaketController::class,'getid_paket']);
Route::post('/createpaket',[PaketController::class,'createpaket']);
Route::put('/updatepaket/{id_paket}',[PaketController::class, 'updatepaket']);
Route::delete('/deletepaket/{id_paket}',[PaketController::class, 'deletepaket']);

//transaksi
Route::get('/gettransaksi',[TransaksiController::class,'gettransaksi']);
Route::get('/getid_transaksi/{id_transaksi}',[TransaksiController::class,'getid_transaksi']);
Route::post('/createtransaksi',[TransaksiController::class,'createtransaksi']);
Route::put('/updatetransaksi/{id_transaksi}',[TransaksiController::class, 'updatetransaksi']);
Route::delete('/deletetransaksi/{id_transaksi}',[TransaksiController::class, 'deletetransaksi']);