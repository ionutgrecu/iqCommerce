@extends('layout.main')

@section('content')
<div class="page-content">
    <div class="shop_content">
        <div class="container">
            @include('layout.breadcrumbs')

            <div class="row">
                <div id="secondary" class="col-xs-12 col-md-3 sidebar-category">
                    <?php if (count($category->childs)) { ?>
                        <aside class="widget">
                            <h3 class="widget-title"><span>Categories</span></h3>
                            @include('layout.side-menu',['categories'=>$category->childs])
                        </aside>
                    <?php } ?>

                    <?php
                    foreach ($category->filters as $filter) {
                        if ($filter->suggested_values) {
                            ?>
                            <aside class="widget">
                                <h3 class="widget-title"><span><?= $filter->name ?></span></h3>
                                <div class="widget_content">
                                    <ul>
                                        <?php
                                        foreach ($filter->suggested_values as $filterValue) {
                                            $filterRequestTmp = $filterRequest;
                                            $filterRequestTmp[$filter->id] = $filterValue['value'];
                                            ?>
                                            <li><a href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequestTmp]) ?>"><?= $filterValue['value'] ?></a>  <span class="count">(<?= $filterValue['product_count'] ?>)</span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </aside>
                            <?php
                        }
                    }
                    ?>
                    <aside class="widget widget_price_filter">
                        <h3 class="widget-title"><span>Filtrare dupa pret</span></h3>
                        <div class="widget_content">
                            <form method="get" action="#">
                                <div class="price_slider_wrapper">
                                    <div id="slider-range" class="price_slider" data-min="0" data-max="1000"></div>
                                    <div class="price_slider_amount">
                                        <div class="price_label">
                                            Pret: <input type="text" id="price_range" readonly="">
                                        </div>
                                        <button type="submit" class="button">Filtreaza</button>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
                <div id="archive-product" class="col-xs-12 col-md-9">
                    <div class="archive-border shop-sidebar left-sidebar">
                        <div class="toolbar">
                            <div class="bootexpert-ordering">
                                <div class="orderby-wrapper">
                                    <label>Sortare dupa:</label> <a href="">Pret</a> <a href="">Noutati</a> <a href="">Discount</a> <a href="">Recomandari</a>
                                </div>
                            </div>
                            <nav class="bootexpert-pagination">
                                <ul class='page-numbers'>
                                    <li><span class='page-numbers current'>1</span></li>
                                    <li><a class='page-numbers' href="">2</a></li>
                                    <li><a class='page-numbers' href="">3</a></li>
                                    <li><a class="next page-numbers" href="">&rarr;</a></li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                        </div>
                        <div class="shop-products row grid-view">
                            <div class="first item-col col-xs-12 col-sm-4 product">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-25-480x606.jpg " class="primary_image" alt="image4xxl (19)" />
                                                <img src="images/fashion/product/image1xxl-54-480x606.jpg" class="secondary_image" alt="image4xxl (16)"
                                                     />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width86"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 4.00 out of 5">
                                                    <span class="width86">
                                                        <strong class="rating">4.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="item-col col-xs-12 col-sm-4 product">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-15-480x606.jpg" class="primary_image" alt="image4xxl (19)" />
                                                <img src="images/fashion/product/image4xxl-16-480x606.jpg" class="secondary_image" alt="image4xxl (16)"
                                                     />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width86"><strong class="rating">4.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 4.00 out of 5">
                                                    <span class="width86">
                                                        <strong class="rating">4.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="last item-col col-xs-12 col-sm-4 product">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-24-480x606.jpg" class="primary_image" alt="image4xxl (24)" />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 5.00 out of 5">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="first item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-6-480x606.jpg" class="primary_image" alt="image4xxl (6)" />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width86"><strong class="rating">4.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 4.00 out of 5">
                                                    <span class="width80">
                                                        <strong class="rating">4.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-7-480x606.jpg" class="primary_image" alt="image4xxl (7)" />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 5.00 out of 5">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="last item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-54-480x606.jpg" class="primary_image" alt="image4xxl (19)" />
                                                <img src="images/fashion/product/image4xxl-16-480x606.jpg" class="secondary_image" alt="image4xxl (16)"
                                                     />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 5.00 out of 5">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="first item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image4xxl-19-480x606.jpg" class="primary_image" alt="image4xxl (19)" />
                                                <img src="images/fashion/product/image4xxl-16-480x606.jpg" class="secondary_image" alt="image4xxl (16)"
                                                     />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 5.00 out of 5">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image2xxl-7-480x606.jpg" class="primary_image" alt="image4xxl (19)" />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 4.00 out of 5">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="last item-col col-xs-12 col-sm-4">
                                <div class="product-wrapper">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="">
                                                <img src="images/fashion/product/image1xxl-35-480x606.jpg" class="primary_image" alt="image4xxl (19)" />
                                                <img src="images/fashion/product/image1xxl-7-480x606.jpg" class="secondary_image" alt="image4xxl (16)"
                                                     />
                                            </a>
                                            <div class="add-to-cart">
                                                <p class="product bootexpert add_to_cart_inline">
                                                    <span class="amount">&pound;90.00</span>
                                                    <a href="" class="button">Add to cart</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="gridview">
                                            <h2 class="product-name"><a href="">Vulputate justo</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width80"><strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                            </div>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listview">
                                            <h2 class="product-name"><a href="single-product.html">Aenean sagittis</a></h2>
                                            <div class="ratings">
                                                <div class="star-rating" title="Rated 4.00 out of 5">
                                                    <span class="width80">
                                                        <strong class="rating">4.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="price-box"><span class="amount">&pound;75.00</span>
                                            </div>
                                            <div class="product-desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="quickviewbtn">
                                                        <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                                                    </div>
                                                    <div class="add-to-links">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div>
                                                                <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="bootexpert product compare-button">
                                                            <a href="" class="compare button">Compare</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="toolbar tb-bottom">
                            <div class="view-mode">
                                <a href="#" class="grid  active" title="Grid">
                                    <i class="fa fa-th-large"></i><span>Grid</span>
                                </a>
                                <a href="#" class="list " title="List">
                                    <i class="fa fa-th-list"></i><span>List</span>
                                </a>
                            </div>
                            <p class="bootexpert-result-count">Showing 1&ndash;9 of 20 results</p>
                            <form class="bootexpert-ordering hidden-xs" method="get">
                                <div class="orderby-wrapper">
                                    <label>Sort By</label>
                                    <select name="orderby" class="orderby">
                                        <option value="menu_order" selected='selected'>Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                            </form>
                            <nav class="bootexpert-pagination">
                                <ul class='page-numbers'>
                                    <li><span class='page-numbers current'>1</span></li>
                                    <li><a class='page-numbers' href="">2</a></li>
                                    <li><a class='page-numbers' href="">3</a></li>
                                    <li><a class="next page-numbers" href="">&rarr;</a></li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection
