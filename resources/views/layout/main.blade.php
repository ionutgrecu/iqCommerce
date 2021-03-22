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
                        <div class="container">
                            <div class="header-inner">
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="logo">
                                            <a href="<?= route('home') ?>" title="<?= config('app.name') ?>: <?= config('app.description') ?>" rel="home">
                                                <img src="<?= asset('assets/logo.png') ?>?>" alt="<?= config('app.name') ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-5">
                                        <div class="header-search">
                                            <div class="widget bootexpert widget_product_search">
                                                <form method="get" id="searchform" action="#">
                                                    <div>
                                                        <input type="text" value="" name="s" id="ws" placeholder="Search product...">
                                                        <button class="btn btn-primary" type="submit" id="wsearchsubmit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <div class="widget bootexpert widget_shopping_cart">
                                            <h2 class="widgettitle">Contul meu</h2>
                                            <div class="widget_shopping_cart_content">
                                                <div class="cart-toggler">
                                                    <a href="">
                                                        <span class="mini-cart-link">
                                                            <i class="fas fa-user"></i>
                                                            <span class="cart-title">Contul meu</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <div class="widget bootexpert widget_shopping_cart" id="shopping_cart">
                                            <h2 class="widgettitle">Cart</h2>
                                            <div class="widget_shopping_cart_content">
                                                <div class="cart-toggler">
                                                    <a href="">
                                                        <span class="mini-cart-link">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            <span class="cart-title">My cart: (
                                                                <span class="cart-quantity">2</span>)</span>
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="mini_cart_content">
                                                    <div class="mini_cart_inner">
                                                        <div class="mini_cart_arrow"></div>
                                                        <ul class="cart_list">
                                                            <li>
                                                                <a href="" class="product-image">
                                                                    <img alt="image1xxl (6)" class="attachment-shop_thumbnail" src="images/digital/product/13-200x200.jpg">
                                                                    <span class="quantity">1</span>
                                                                </a>
                                                                <div class="product-details">
                                                                    <a title="Remove this item" class="remove" href="">
                                                                        <i class="fa fa-times-circle"></i>
                                                                    </a>
                                                                    <a href="" class="product-name">Buscipit at magna → Vestibulum suscipit&nbsp;</a>
                                                                    <span class="quantity">
                                                                        <span class="amount">&pound;65.00</span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <a href="" class="product-image">
                                                                    <img alt="image4xxl (2)" class="attachment-shop_thumbnail" src="images/digital/product/1-200x200.jpg">
                                                                    <span class="quantity">1</span>
                                                                </a>
                                                                <div class="product-details">
                                                                    <a title="Remove this item" class="remove">
                                                                        <i class="fa fa-times-circle"></i>
                                                                    </a>
                                                                    <a href="" class="product-name">Pellentesque posuere&nbsp;</a>
                                                                    <span class="quantity">
                                                                        <span class="amount">&pound;45.00</span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- end product list -->
                                                        <p class="total">Subtotal:
                                                            <span class="amount">
                                                                <span class="amount">&pound;110.00</span>
                                                            </span>
                                                        </p>
                                                        <p class="buttons">
                                                            <a class="button" href="">Checkout</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-cart">
                            <div class="container">
                                <div class="nav-container">
                                    <div class="horizontal-menu">
                                        @include('components.topmenu')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .header -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>

        <!-- QUICKVIEW PRODUCT -->
        <div class="quickview-wrapper" id="quickview-wrapper">
            <!-- Modal -->
            <div
                class="modal fade"
                id="productModal"
                tabindex="-1"
                role="dialog"
                >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-product">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                    >
                                    <span aria-hidden="true" class="closeqv">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </button>
                                <div id="quickview-content">
                                    <div class="bootexpert product">
                                        <div class="product-images">
                                            <div class="main-image images">
                                                <img alt="image1xxl" src="images/digital/product/6.jpg">
                                            </div>
                                            <div class="quick-thumbnails">
                                                <div class="slick-slide">
                                                    <a href="images/product/6.jpg">
                                                        <img alt="image1xxl" class="attachment-shop_thumbnail" src="images/digital/product/6-200x200.jpg">
                                                    </a>
                                                </div>
                                                <div class="slick-slide">
                                                    <a class="zoom first" href="images/product/17.jpg">
                                                        <img alt="image1xxl" class="attachment-shop_thumbnail" src="images/digital/product/17-200x200.jpg">
                                                    </a>
                                                </div>
                                                <div class="slick-slide">
                                                    <a class="zoom" href="images/product/7.jpg">
                                                        <img alt="image4xxl" class="attachment-shop_thumbnail" src="images/digital/product/7-200x200.jpg">
                                                    </a>
                                                </div>
                                                <div class="slick-slide">
                                                    <a class="zoom" href="images/product/1.jpg">
                                                        <img alt="image1xxl" class="attachment-shop_thumbnail" src="images/digital/product/1-200x200.jpg">
                                                    </a>
                                                </div>
                                                <div class="slick-slide">
                                                    <a class="zoom" href="images/product/8.jpg">
                                                        <img alt="image1xxl" class="attachment-shop_thumbnail" src="images/digital/product/8-200x200.jpg">
                                                    </a>
                                                </div>
                                                <div class="slick-slide">
                                                    <a class="zoom" href="images/product/2.jpg">
                                                        <img alt="image1xxl" class="attachment-shop_thumbnail" src="images/digital/product/2-200x200.jpg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h2>Condimentum posuere</h2>
                                            <div class="price-box">
                                                <p class="price">
                                                    <span class="special-price">
                                                        <span class="amount">$100.00</span>
                                                    </span>
                                                    <span class="old-price">
                                                        <span class="amount">$105.00</span>
                                                    </span>
                                                </p>
                                            </div>
                                            <a href="" class="see-all">See all features</a>
                                            <div class="quick-add-to-cart">
                                                <form method="post" class="cart">
                                                    <div class="single_variation_wrap">
                                                        <div class="variations_button">
                                                            <div class="quantity">
                                                                <input
                                                                    type="number"
                                                                    size="4"
                                                                    class="input-text qty text"
                                                                    title="Qty"
                                                                    value="1"
                                                                    name="quantity"
                                                                    >
                                                            </div>
                                                            <button class="single_add_to_cart_button button alt" type="submit">Add to cart</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="quick-desc">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus
                                            </div>
                                            <div class="social-sharing">
                                                <div class="widget widget_socialsharing_widget">
                                                    <h3 class="widget-title">Share this product</h3>
                                                    <ul class="social-icons">
                                                        <li>
                                                            <a
                                                                class="facebook social-icon"
                                                                href="https://www.facebook.com/"
                                                                title="Facebook"
                                                                target="_blank"
                                                                >
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="twitter social-icon"
                                                                href="https://twitter.com/"
                                                                title="Twitter"
                                                                target="_blank"
                                                                >
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="pinterest social-icon"
                                                                target="_blank"
                                                                title="Pinterest"
                                                                href="#"
                                                                >
                                                                <i class="fa fa-pinterest"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="gplus social-icon"
                                                                href="https://plus.google.com/"
                                                                title="Google-plus"
                                                                target="_blank"
                                                                >
                                                                <i class="fa fa-google-plus"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="linkedin social-icon"
                                                                href="https://linkedin.com/"
                                                                title="Dribbble"
                                                                target="_blank"
                                                                >
                                                                <i class="fa fa-linkedin"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .product-images -->
                            </div>
                            <!-- .modal-product -->
                        </div>
                        <!-- .modal-body -->
                    </div>
                    <!-- .modal-content -->
                </div>
                <!-- .modal-dialog -->
            </div>
            <!-- END Modal -->
        </div>
        <!-- END QUICKVIEW PRODUCT -->

        <script src="<?= mix('js/script.js') ?>"></script>
        <script src="<?= asset('assets/lib/rotatingtweets/jquery.cycle.all.min.js') ?>"></script>
        <script src="<?= asset('assets/lib/rotatingtweets/rotating_tweet.js') ?>"></script>

        <!--DEV-->
        <!--<script src="<?= asset('js/main.js') ?>"></script>-->

        @yield('js-footer')
    </body>
</html>