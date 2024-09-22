<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



/*----------------------------------------NON AUTH--------------------------------------*/
Route::get('/', function () {
    return view('auth.login');
});


/*----------------------------------------AUTH ROUTE--------------------------------------*/
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('home', function() {
        return view('home');
    })->name('home');

    /*----------------------------------------USER--------------------------------------*/
    Route::resource('user', UserController::class);
    Route::post('profile/update/{user}', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');


    /*----------------------------------------SURAT MASUK--------------------------------------*/
    Route::resource('suratMasuk', SuratMasukController::class);


    /*----------------------------------------SURAT Keluar--------------------------------------*/
    Route::resource('suratKeluar', SuratKeluarController::class);


    /*----------------------------------------Laporan--------------------------------------*/
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


    /*----------------------------------------Export--------------------------------------*/
    route::get('/laporan/surat-masuk', [LaporanController::class, 'getSuratMasuk']);
    route::get('/laporan/surat-keluar', [LaporanController::class, 'getSuratKeluar']);
    Route::get('/laporan/surat-masuk/export', [LaporanController::class, 'exportSuratMasuk'])->name('export.suratMasuk');
    Route::get('/laporan/surat-keluar/export', [LaporanController::class, 'exportSuratKeluar'])->name('export.suratKeluar');
    Route::get('/surat-masuk-pdf', [LaporanController::class, 'cetakSuratMasuk'])->name('surat_masuk_pdf');
    Route::get('/surat-keluar-pdf', [LaporanController::class, 'cetakSuratKeluar'])->name('surat_keluar_pdf');
});
