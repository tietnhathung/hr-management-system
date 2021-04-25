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

mix.combine([
    'public/assets/plugins/jquery/jquery-3.5.1.min.js',
    'public/assets/themes/coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js',
    'public/assets/themes/coreui/vendors/@coreui/icons/js/svgxuse.min.js',
    'public/assets/plugins/select2/js/select2.min.js',
    'public/assets/plugins/toastr/toastr.min.js',
    'public/assets/plugins/mustache/mustache.js',
    'public/assets/plugins/mustache/jquery.mustache.js',
    'public/assets/plugins/moment/moment.min.js',
    'public/assets/plugins/datetimepicker/locales/vi.js',
    'public/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js',
    'public/assets/plugins/checkall/checkall.min.js',
    'node_modules/bootstrap4-duallistbox/dist/jquery.bootstrap-duallistbox.min.js',
], 'public/js/master.js');

mix.combine([
    'node_modules/bootstrap4-duallistbox/dist/bootstrap-duallistbox.min.css',
    'public/assets/themes/coreui/css/style.css',
    'public/assets/plugins/fontawesome/css/all.min.css',
    'public/assets/plugins/select2/css/select2.min.css',
    'public/assets/plugins/toastr/toastr.min.css',
    'public/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css'
], 'public/css/master.css');

mix.js('cores/Menu/Resources/assets/js/app.js', 'public/mix/js/menu.js');

mix.sass('cores/Menu/Resources/assets/sass/app.scss', 'public/mix/css/menu.css');

mix.copy('public/assets/plugins/fontawesome/webfonts/', "public/webfonts/");
