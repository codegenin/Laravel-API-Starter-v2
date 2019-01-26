let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'public/css/plugin/datatables/jquery.dataTables.min.css',
        'public/css/backend/plugin/datatables/dataTables.bootstrap.min.css',
        'public/css/plugin/datatables/buttons.dataTables.min.css',
        'public/js/select2/select2.css',
        //'public/css/bootstrap.min.css',
        'public/css/custom-style.css',
        'public/css/loader.css',
        'public/css/bootstrap-datetimepicker.min.css'
    ], 'public/css/backend-custom.css')
    .scripts([
        //"node_modules/moment/moment.js",
        "node_modules/select2/dist/js/select2.full.js",
        //"public/js/bootstrap-datetimepicker.min.js",
        "public/js/backend/custom-file-input.js",
        "public/js/backend/admin.js"
    ], 'public/js/backend-custom.js')
    .scripts([
        'node_modules/datatables.net/js/jquery.dataTables.js',
        //'public/js/plugin/datatables/dataTables.bootstrap.min.js',
        'node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        'node_modules/datatables.net-buttons/js/buttons.flash.js',
        'public/js/plugin/datatables/jszip.min.js',
        'public/js/plugin/datatables/pdfmake.min.js',
        'public/js/plugin/datatables/vfs_fonts.js',
        'node_modules/datatables.net-buttons/js/buttons.html5.js',
        'node_modules/datatables.net-buttons/js/buttons.print.js',
    ], 'public/js/dataTable.js')
    .version();
