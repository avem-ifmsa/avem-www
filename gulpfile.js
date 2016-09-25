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
        '../../../node_modules/font-awesome/css/font-awesome.css',
        '../../../node_modules/mdbootstrap/css/bootstrap.css',
        '../../../node_modules/mdbootstrap/css/mdb.css',
    ], 'public/css/vendor.css');

    mix.scripts('app.js', 'public/js/app.js').scripts([
        '../../../node_modules/mdbootstrap/js/jquery-2.2.3.js',
        '../../../node_modules/mdbootstrap/js/tether.js',
        '../../../node_modules/mdbootstrap/js/bootstrap.js',
        '../../../node_modules/mdbootstrap/js/mdb.js',
    ], 'public/js/vendor.js');

    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
    mix.copy('node_modules/mdbootstrap/font', 'public/build/font');
    mix.copy('node_modules/mdbootstrap/img', 'public/build/img');

    mix.version([
        'public/css/vendor.css',
        'public/css/app.css',
        'public/js/vendor.js',
        'public/js/app.js'
    ]);
});
