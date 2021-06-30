<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{apiController};
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('data/kota', [apiController::class, 'apiKota']);
Route::get('data/kecamatan', [apiController::class, 'apiKecamatan']);

Route::get('desa/wisata/{pusatid}', [apiController::class, 'apiDesa']);
Route::get('desa/pendamping', [apiController::class, 'pendampingAll']);
Route::get('pusat/json', [apiController::class, 'jsonPusat']);
Route::get('wisata', [apiController::class, 'jsonWisata'])->name('wisata');
