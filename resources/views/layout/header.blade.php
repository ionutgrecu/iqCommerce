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
            <div class="col-xs-12 col-md-2">
<!--                <div class="header-search">
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
                </div>-->
            </div>
            <div class="col-xs-12 col-md-2">
                <div class="widget bootexpert widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <div class="cart-toggler">
                            <a href="">
                                <span class="mini-cart-link">
                                    <i class="fas fa-user"></i>
                                    <span class="cart-title"><?= Auth::id()?auth()->user()->name:'Contul meu'?></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if(Auth::id()){?>
                <div class="col-xs-12 col-md-2">
                    <div class="widget bootexpert widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                            <div class="cart-toggler">
                                <form method="post" action="<?=route('logout')?>">
                                    <a href="#" onclick="$(this).closest('form').submit();">
                                        <span class="mini-cart-link">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span class="cart-title">Iesire cont</span>
                                        </span>
                                    </a>
                                    <?=csrf_field()?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            
            <div class="col-xs-12 col-md-3">
                <div class="widget bootexpert widget_shopping_cart" id="shopping_cart">
                    <h2 class="widgettitle">Cosul de cumparaturi</h2>
                    <div class="widget_shopping_cart_content">
                        <div class="cart-toggler">
                            <a href="">
                                <span class="mini-cart-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="cart-title">Cosul de cumparaturi: (<span class="cart-quantity"><?=$cartService->countItems()?></span>)</span>
                                </span>
                            </a>
                        </div>
                        <div class="mini_cart_content">
                            <div class="mini_cart_inner">
                                <div class="mini_cart_arrow"></div>
                                <ul class="cart_list">
                                    <?php foreach($cartService->getCart()->items as $item){?>
                                    <li>
                                        <a href="<?=$item->product->getUrl()?>" class="product-image">
                                            <img alt="<?=$item->product->name?>" class="attachment-shop_thumbnail" src="<?=$item->product->getImageUrl()?>">
                                            <span class="quantity"><?=$item->qty?></span>
                                        </a>
                                        <div class="product-details">
                                            <a title="Sterge din cos" class="remove" href="<?=route('shop.remove-cart',['item_id'=>$item->id])?>">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                            <a href="" class="product-name"><?=$item->product_name?>&nbsp;</a>
                                            <span class="quantity">
                                                <span class="amount"><?=$item->price?> LEI</span>
                                            </span>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                                <!-- end product list -->
                                <p class="total">Total:
                                    <span class="amount">
                                        <span class="amount"><?=$cartService->getTotal()?> LEI</span>
                                    </span>
                                </p>
                                <p class="buttons">
                                    <a class="button" href="<?=route('shop.cart-checkout')?>">Comanda</a>
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