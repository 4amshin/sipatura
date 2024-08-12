<?php

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

    Route::get('surat-keluar', function() {
        return view('admin.surat_keluar.surat-keluar');
    })->name('surat-keluar');

    Route::get('laporan', function() {
        return view('admin.laporan.laporan');
    })->name('laporan');

    /*----------------------------------------USER--------------------------------------*/
    Route::resource('user', UserController::class);
    Route::post('profile/update/{user}', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');


    /*----------------------------------------SURAT MASUK--------------------------------------*/
    Route::resource('suratMasuk', SuratMasukController::class);
});
