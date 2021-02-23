const mix = require('laravel-mix');
let { CleanWebpackPlugin } = require("clean-webpack-plugin");

new CleanWebpackPlugin({
        verbose: true,
        dry: true,
        cleanStaleWebpackAssets: false,
        protectWebpackAssets: false,
        cleanOnceBeforeBuildPatterns: ["public/css/*", "public/js/*", "public/assets/*"]
      });


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
        .sass('resources/sass/login.scss', 'public/css');

//Admin area
mix.copy('node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css', 'public/css/admin');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css/admin');
//main css
mix.sass('resources/sass/admin/style.scss', 'public/css/admin/style.css');

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
//fonts
mix.copy('node_modules/@coreui/icons/fonts', 'public/assets/admin/fonts');
//icons
mix.copy('node_modules/@coreui/icons/css/free.min.css', 'public/css/admin');
mix.copy('node_modules/@coreui/icons/css/brand.min.css', 'public/css/admin');
mix.copy('node_modules/@coreui/icons/css/flag.min.css', 'public/css/admin');
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/assets/svg/flag');

mix.copy('node_modules/@coreui/icons/sprites/', 'public/assets/admin/icons/sprites');
//images
mix.copy('resources/assets/admin', 'public/assets/admin');
