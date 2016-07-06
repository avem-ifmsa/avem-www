var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss').styles([
        '../../../bower_components/bootstrap/dist/css/bootstrap.css',
        '../../../bower_components/chosen/chosen.css',
    ], 'public/css/vendor.css');

    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.js',
        '../../../bower_components/bootstrap/dist/js/bootstrap.js',
        '../../../bower_components/chosen/chosen.jquery.js',
    ], 'public/js/vendor.js');

    mix.copy('bower_components/bootstrap/fonts', 'public/build/fonts');

    mix.version([
        'public/css/vendor.css',
        'public/js/vendor.js',
        'public/css/app.css',
    ]);
});
