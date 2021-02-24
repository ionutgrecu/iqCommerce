<!DOCTYPE html>
<html lang="<?= app()->getLocale() ?>">
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="iqCommerce Admin Area">
            <meta name="author" content="Ionut Grecu <ionut@grecu.eu>">
            <meta name="keyword" content="iqCommerce, Bootstrap, React">
            <link rel="shortcut icon" href="/<?= $theme_path ?>favicon.ico">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            @yield('head')

            @if (array_key_exists('meta', View::getSections()))
            @yield('meta')
            @else
            <title>iqCommerce - Admin Area</title>
            @endif

            <link rel="apple-touch-icon" sizes="57x57" href="<?= asset('assets/admin/favicon/apple-icon-57x57.png') ?>">
            <link rel="apple-touch-icon" sizes="60x60" href="<?= asset('assets/admin/favicon/apple-icon-60x60.png') ?>">
            <link rel="apple-touch-icon" sizes="72x72" href="<?= asset('assets/admin/favicon/apple-icon-72x72.png') ?>">
            <link rel="apple-touch-icon" sizes="76x76" href="<?= asset('assets/admin/favicon/apple-icon-76x76.png') ?>">
            <link rel="apple-touch-icon" sizes="114x114" href="<?= asset('assets/admin/favicon/apple-icon-114x114.png') ?>">
            <link rel="apple-touch-icon" sizes="120x120" href="<?= asset('assets/admin/favicon/apple-icon-120x120.png') ?>">
            <link rel="apple-touch-icon" sizes="144x144" href="<?= asset('assets/admin/favicon/apple-icon-144x144.png') ?>">
            <link rel="apple-touch-icon" sizes="152x152" href="<?= asset('assets/admin/favicon/apple-icon-152x152.png') ?>">
            <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('assets/admin/favicon/apple-icon-180x180.png') ?>">
            <link rel="icon" type="image/png" sizes="192x192" href="<?= asset('assets/admin/favicon/android-icon-192x192.png') ?>">
            <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('assets/admin/favicon/favicon-32x32.png') ?>">
            <link rel="icon" type="image/png" sizes="96x96" href="<?= asset('assets/admin/favicon/favicon-96x96.png') ?>">
            <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('assets/admin/favicon/favicon-16x16.png') ?>">
            <link rel="manifest" href="<?= asset('assets/admin/favicon/manifest.json') ?>">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="<?= asset('assets/admin/favicon/ms-icon-144x144.png') ?>">
            <meta name="theme-color" content="#ffffff">

            <!-- Icons-->
            <link href="<?= asset('assets/admin/icons/css/all.min.css') ?>" rel="stylesheet">
            <link href="<?= asset('assets/admin/fontawesome/css/all.min.css') ?>" rel="stylesheet">
            <!-- Main styles for this application-->
            <link href="<?= asset('css/admin/style.css') ?>" rel="stylesheet">
            @yield('css')
            <link href="<?= asset('css/admin/coreui-chartjs.css') ?>" rel="stylesheet">

            @yield('js-head')
        </head>

        <body class="c-app">
            <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
                @include('admin._partials.nav')

                @include('admin._partials.header')

                <div class="c-body">
                    <main class="c-main">
                        @yield('content')
                    </main>

                    @include('admin._partials.footer')
                </div>
            </div>

            <!-- CoreUI and necessary plugins-->
            <script src="<?= asset('js/admin/coreui.bundle.min.js') ?>"></script>
            <script src="<?= asset('js/admin/coreui-utils.js') ?>"></script>
            @yield('js')
        </body>
    </html>