<div class="phm_row hasteck_row parvez_inner phm_row-fluid home-tabs digital3">
    <div class="parvez_wrapper">
        <div class="bootexpert columns-5">
            <div class="shop-products row grid-view">
                <?php $products = $productsService->getItemsNew(9); ?>
                <div class="group">
                    <?php foreach ($products as $k => $item) { ?>
                        <div class="<?php if ($k % 2 == 0) { ?>first<?php } ?> item-col col-xs-12 col-sm-2">
                            <div class="product-wrapper">
                                <div class="list-col4 ">
                                    <div class="product-image">
                                        <a href="" title="Vulputate justo">
                                            <img src="<?=$item->getImageUrl()?>" class="primary_image " alt="6">
                                            <!--<img src="images/digital/product/11.jpg" class="secondary_image" alt="11">-->
                                        </a>
                                        <a
                                            data-target="#productModal"
                                            data-toggle="modal"
                                            class="detail-link quickview"
                                            href=""
                                            >
                                            <i class="fa fa-eye"></i>Quick View
                                        </a>
                                    </div>
                                </div>
                                <div class="list-col8 ">
                                    <div class="gridview">
                                        <div class="gridview-inner">
                                            <h2 class="product-name">
                                                <a href=""><?=$item->name?></a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="amount">&pound;90.00</span>
                                            </div>
                                            <div class="ratings">
                                                <div class="star-rating">
                                                    <span class="width100">
                                                        <strong class="rating">5.00</strong> out of 5
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="actions clearfix">
                                                <div class="action-buttons">
                                                    <div class="add-to-cart">
                                                        <p class="product bootexpert add_to_cart_inline">
                                                            <a href="" class="button ">Add to cart</a>
                                                        </p>
                                                    </div>
                                                    <ul class="add-to-links">
                                                        <li class="btn-wishlist">
                                                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2309">
                                                                <div>
                                                                    <a href="" class="add_to_wishlist">Wishlist</a>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </li>
                                                        <li class="btn-compare">
                                                            <div class="bootexpert product compare-button">
                                                                <a href="" class="compare button">Compare</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <?php if ($k % 2 == 1) { ?></div><div class="group"><?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>