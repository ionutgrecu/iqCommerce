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
                @include('layout.topmenu')
            </div>
        </div>
    </div>
</div>