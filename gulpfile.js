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
    mix.sass('app.scss');

    mix.scripts('app.js', 'public/js/app.js').scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        '../../../node_modules/select2/dist/js/select2.js',
        '../../../node_modules/bootstrap-sidebar/dist/js/sidebar.js',
    ], 'public/js/vendor.js');

    mix.copy('node_modules/bootstrap-sass/assets/fonts', 'public/build/fonts');

    mix.version([
        'public/css/app.css',
        'public/js/vendor.js',
        'public/js/app.js'
    ]);
});
