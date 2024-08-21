<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Hapus semua file di storage/public sebelum migrasi
        // Artisan::call('migrate:preparing');

        // Jika Anda ingin memastikan bahwa key string tidak terlalu panjang
        // Schema::defaultStringLength(191);
    }
}
