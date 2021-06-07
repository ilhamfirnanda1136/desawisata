<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    homeController,
    pendampingController,
    wisataController,
    aparatDesaController,
    ProjectController,
    ProjectTypeController,
    UserController
};


Route::get('/', function () {
    return redirect('login');
});

/* Authentication Admin */
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'process'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    /* Home */
    Route::get('home', [homeController::class, 'index'])->name('home');

    /* Pendamping */
    Route::get('pendamping', [pendampingController::class, 'index']);
    Route::get('pendamping/table', [pendampingController::class, 'tablePendamping']);
    Route::post('simpan/pendamping', [pendampingController::class, 'simpanPendamping']);
    Route::get('pendamping/hapus/{id}', [pendampingController::class, 'hapusPendamping']);

    /* Desa Wisata */
    Route::get('wisata', [wisataController::class, 'index']);
    Route::get('wisata/table', [wisataController::class, 'tableWisata']);
    Route::get('ambil/wisata/{id}', [wisataController::class, 'ambilWisata']);
    Route::post('simpan/wisata', [wisataController::class, 'simpanWisata']);
    Route::get('wisata/hapus/{id}', [wisataController::class, 'hapusWisata']);

    Route::prefix('aparat')->group(function () {

        /* Master Jabatan */
        Route::get('master', [aparatDesaController::class, 'indexMaster']);
        Route::get('/master/table', [aparatDesaController::class, 'tableMaster'])->name('aparat.master.table');
        Route::get('/master/hapus/{id}', [aparatDesaController::class, 'hapusMaster'])->name('aparat.master.hapus');
        Route::post('/simpan/master', [aparatDesaController::class, 'simpanMaster'])->name('aparat.master.simpan');

        /* Aparat Desa */
        Route::prefix('desa')->group(function () {
            Route::get('/', [aparatDesaController::class, 'index']);
            Route::get('/show/{id}', [aparatDesaController::class, 'show']);
            Route::get('/json-dt', [aparatDesaController::class, 'jsonDT']);
            Route::post('/save', [aparatDesaController::class, 'store']);
            Route::delete('/delete/{aparatdesa}', [aparatDesaController::class, 'destroy']);
        });
    });
    Route::prefix('master-project')->group(function () {
        Route::prefix('project-type')->group(function () {
            Route::get('/', [ProjectTypeController::class, 'index'])->name('project-type.index');
            Route::get('/json-dt', [ProjectTypeController::class, 'jsonDT']);
            Route::post('/save', [ProjectTypeController::class, 'store']);
            Route::get('/show/{projectType}', [ProjectTypeController::class, 'show']);
            Route::delete('/delete/{projectType}', [ProjectTypeController::class, 'destroy']);
        });
        Route::prefix('project')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('project.index');
            Route::get('/show/{project}', [ProjectController::class, 'show']);
            Route::get('/json-dt', [ProjectController::class, 'jsonDT']);
            Route::get('/board-control/{project}', [ProjectController::class, 'viewBoardControl'])->name('project.board');
            Route::post('/save', [ProjectController::class, 'store']);
            Route::delete('/delete/{project}', [ProjectController::class, 'destroy']);
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/json-dt', [UserController::class, 'jsonDT']);
        Route::get('/show/{id}', [UserController::class, 'show']);
        Route::post('/save', [UserController::class, 'store']);
        Route::delete('/delete/{user}', [UserController::class, 'destroy']);
    });
});
