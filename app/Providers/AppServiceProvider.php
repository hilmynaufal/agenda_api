<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Library vendor (Laravel 8 / Filament 2) belum kompatibel penuh dengan PHP 8.4; sembunyikan notice deprecated.
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // asset() butuh Request aktif, yang tidak tersedia saat boot lewat
        // artisan (mis. `artisan serve` sendiri, migrate, tinker). Skip di
        // konteks console — request HTTP sungguhan lewat public/index.php
        // selalu punya Request, jadi tema tetap terdaftar untuk halaman admin.
        if ($this->app->runningInConsole()) {
            return;
        }

        $themePath = public_path('css/filament/theme.css');
        $version = file_exists($themePath) ? filemtime($themePath) : time();

        Filament::registerTheme(asset('css/filament/theme.css') . '?v=' . $version);
    }
}
