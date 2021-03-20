const mix = require('laravel-mix');

if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map'
    })
        .sourceMaps();
}

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
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/login.js', 'public/js')
    .sass('resources/sass/login.scss', 'public/css')
    .js('resources/js/script.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .browserSync('localhost:8001')
    .version();

//Admin area
mix.copy('node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css', 'public/css/admin');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css/admin');
//main css
mix.sass('resources/sass/admin/style.scss', 'public/css/admin/style.css').version();

//************** SCRIPTS ******************
// general scripts
mix.copy('node_modules/@coreui/utils/dist/coreui-utils.js', 'public/js/admin');
mix.copy('node_modules/axios/dist/axios.min.js', 'public/js/admin');
//mix.copy('node_modules/pace-progress/pace.min.js', 'public/js/admin');
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js', 'public/js/admin');
// views scripts
mix.copy('node_modules/chart.js/dist/Chart.min.js', 'public/js/admin');
mix.copy('node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js', 'public/js/admin');

mix.copy('node_modules/cropperjs/dist/cropper.js', 'public/js/admin');
// details scripts
mix.copy('resources/js/coreui/main.js', 'public/js/admin');
mix.copy('resources/js/coreui/colors.js', 'public/js/admin');
mix.copy('resources/js/coreui/charts.js', 'public/js/admin');
mix.copy('resources/js/coreui/widgets.js', 'public/js/admin');
mix.copy('resources/js/coreui/popovers.js', 'public/js/admin');
mix.copy('resources/js/coreui/tooltips.js', 'public/js/admin');

// details scripts admin-panel
mix.js('resources/js/coreui/menu-create.js', 'public/js/admin');
mix.js('resources/js/coreui/menu-edit.js', 'public/js/admin');
mix.js('resources/js/coreui/media.js', 'public/js/admin');
mix.js('resources/js/coreui/media-cropp.js', 'public/js/admin');

//*************** OTHER ******************
//icons
mix.copy('node_modules/@coreui/icons/css', 'public/assets/admin/icons/css/');
mix.copy('node_modules/@coreui/icons/fonts', 'public/assets/admin/icons/fonts/');
mix.copy('node_modules/@coreui/icons/sprites', 'public/assets/admin/icons/sprites/');
mix.copy('node_modules/@coreui/icons/svg', 'public/assets/admin/icons/svg/');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/assets/admin/fontawesome/css/');
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts/', 'public/assets/admin/fontawesome/webfonts/');

//images
mix.copy('resources/assets/', 'public/assets/');

//React
mix.js('resources/react/products/src/index.js', 'public/js/products.js').react().version();
