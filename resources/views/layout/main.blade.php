<?php
$categories = $categoryService->getTree(); 
?>

<!doctype html>
<html lang="<?= $lang ?>">
    <head>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $meta['title'] ?></title>
        <meta name="description" content="<?= $meta['description'] ?>">
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= asset('assets/favicon/apple-icon-60x60.png') ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= asset('assets/favicon/apple-icon-72x72.png') ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= asset('assets/favicon/apple-icon-76x76.png') ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= asset('assets/favicon/apple-icon-114x114.png') ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= asset('assets/favicon/apple-icon-120x120.png') ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= asset('assets/favicon/apple-icon-144x144.png') ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= asset('assets/favicon/apple-icon-152x152.png') ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('assets/favicon/apple-icon-180x180.png') ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= asset('assets/favicon/android-icon-192x192.png') ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('assets/favicon/favicon-32x32.png') ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= asset('assets/favicon/favicon-96x96.png') ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('assets/favicon/favicon-16x16.png') ?>">
        <link rel="manifest" href="<?= asset('assets/favicon/manifest.json') ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= asset('assets//ms-icon-144x144.png') ?>">
        <meta name="theme-color" content="#ffffff">

        <!-- Custom Google Web Font -->
        <link href="http://fonts.googleapis.com/css?family=Carrois+Gothic " rel="stylesheet" type="text/css" media="all" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300,800" rel="stylesheet" type="text/css" media="all" />
        <link href="http://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet" type="text/css" media="all" />
        <link href="http://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css" media="all" />
        <link href="http://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet" type="text/css" media="all" />

        <link rel="stylesheet" href="<?= mix('css/style.css') ?>" />

        <!--DEV-->
        <!--<link rel="stylesheet" href="<?= asset('css/style-dev.css') ?>" />-->

        <script src="<?= asset('assets/lib/modernizr-2.8.3.min.js') ?>"></script>
        @yield('js-header')
    </head>

    <body>
        <div class="wrapper">
            <div class="page-wrapper">
                <div class="header-container layout7">
                    <div class="header">
                        @include('layout.header')
                    </div>
                    <!-- .header -->
                    <div class="clearfix"></div>
                </div>
                <!-- End Header Container -->

                <!-- Main Container -->
                <div class="main-container">
                    @yield('content')
                </div>
                <!-- Main Container -->

                <!-- Footer -->
                @include('layout.footer')
                <!-- End Footer -->
            </div>
        </div>

        <div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>

        <!-- QUICKVIEW PRODUCT -->
        @include('layout.quickview')
        <!-- END QUICKVIEW PRODUCT -->

        <script src="<?= mix('js/script.js') ?>"></script>
        <script src="<?= asset('assets/lib/rotatingtweets/jquery.cycle.all.min.js') ?>"></script>
        <script src="<?= asset('assets/lib/rotatingtweets/rotating_tweet.js') ?>"></script>

        <!--DEV-->
        <!--<script src="<?= asset('js/main.js') ?>"></script>-->

        @yield('js-footer')
    </body>
</html>