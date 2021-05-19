<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,homeController,pendampingController,
    wisataController,aparatDesaController
};


Route::get('/', function () {
    return redirect('login');
});

/* Authentication Admin */
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'process'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    /* Home */
    Route::get('home', [homeController::class,'index'])->name('home');

    /* Pendamping */
    Route::get('pendamping',[pendampingController::class,'index']);
    Route::get('pendamping/table',[pendampingController::class,'tablePendamping']);
    Route::post('simpan/pendamping',[pendampingController::class,'simpanPendamping']);
    Route::get('pendamping/hapus/{id}',[pendampingController::class,'hapusPendamping']);

    /* Desa Wisata */
    Route::get('wisata',[wisataController::class,'index']);
    Route::get('wisata/table',[wisataController::class,'tableWisata']);
    Route::get('ambil/wisata/{id}',[wisataController::class,'ambilWisata']);
    Route::post('simpan/wisata',[wisataController::class,'simpanWisata']);
    Route::get('wisata/hapus/{id}',[wisataController::class,'hapusWisata']);

    Route::prefix('aparat')->group(function () {
        
        /* Master Jabatan */
        Route::get('master',[aparatDesaController::class,'indexMaster']);
        Route::get('/master/table',[aparatDesaController::class,'tableMaster'])->name('aparat.master.table');
        Route::get('/master/hapus/{id}',[aparatDesaController::class,'hapusMaster'])->name('aparat.master.hapus');
        Route::post('/simpan/master',[aparatDesaController::class,'simpanMaster'])->name('aparat.master.simpan');

        /* Aparat Desa */
        Route::get('desa',[aparatDesaController::class,'index']);
        

    });
});