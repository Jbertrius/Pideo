var elixir = require('laravel-elixir');
require('laravel-elixir-jade');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery': 'node_modules/jquery.2/node_modules/jquery/',
    'bootstrap': 'node_modules/bootstrap-sass/assets/',
    'fontawesome': 'node_modules/font-awesome/'
};

elixir(function(mix) {
     mix.sass('*.scss', 'public/css/')
        .sass('style.scss', 'public/css/style.css')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap')
        .copy(paths.fontawesome + 'fonts/**', 'public/fonts/fontawesome')
        .browserify('app.js')
        .styles([
            'style.css',
            'style-responsive.min.css'
        ])
 
        .version([
            'css/app.css',
            'css/all.css',
            'js/app.js'
        ])
});



