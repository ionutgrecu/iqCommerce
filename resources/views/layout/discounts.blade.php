<div class="shop-products row grid-view">
    <?php
    $reducedProducts = $productsService->getItemsReduced();
    foreach ($reducedProducts as $item) {
        ?>
        <div class="first last item-col col-xs-12 col-sm-12">
            <div class="product-wrapper">
                <span class="onsale">
                    <span class="sale-text">Sale</span>
                </span>
                <div class="list-col4 ">
                    <div class="product-image">
                        <a href="<?= $item->getUrl() ?>" title="<?= $item->name ?>">
                            <img src="<?= $item->getImageUrl() ?>" class="primary_image wp-post-image" alt="5">
                            <!--<img src="images/digital/product/4-600x600.jpg" class="secondary_image" alt="4">-->
                        </a>
                    </div>
                </div>
                <div class="list-col8 ">
                    <div class="gridview">
                        <div class="gridview-inner">
                            <h2 class="product-name">
                                <a href=""><?= $item->name ?></a>
                            </h2>
                            <div class="price-box">
                                <del>
                                    <span class="amount"><?= formatPrice($item->price) ?> LEI</span>
                                </del>
                                <ins>
                                    <span class="amount"><?= formatPrice($item->proposePrice()) ?> LEI</span>
                                </ins>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } ?>
</div>