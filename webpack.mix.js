const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// Tema Filament (warna/font Siagan Bedas) di-build lewat Tailwind CLI langsung,
// bukan lewat Mix — lihat npm script "build:filament-theme". Laravel Mix 6 di
// environment ini konflik versi dengan webpack terbaru untuk build CSS-only ini.
