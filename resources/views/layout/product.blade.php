<div class="<?= ($key % 3 == 0) ? 'first' : '' ?> <?= ($key % 3 == 2) ? 'last' : '' ?>  item-col col-xs-12 col-sm-4 product">
    <div class="product-wrapper">
        <div class="list-col4">
            <div class="product-image">
                <a href="">
                    <div style="background-image:url(<?= $item->getImageUrl() ?>);" class="primary_image" alt="<?= $item->name ?>"></div>
                </a>
            </div>
        </div>
        <div class="list-col8">
            <div class="gridview">
                <h2 class="product-name">
                    <a href="<?= $item->getUrl() ?>"><?= $item->name ?></a>
                </h2>
                <!--                <div class="ratings">
                                    <div class="star-rating">
                                        <span class="width86">
                                            <strong class="rating">5.00</strong>
                                            out of 5
                                        </span>
                                    </div>
                                </div>-->
                <?php if ($item->isDiscountEligible()) { ?>
                    <del><span class="amount"><?= $item->price ?> LEI</span></del>
                    <div class="price-box">
                        <span class="amount"><?= $item->proposePrice() ?> LEI</span>
                    </div>
                <?php } else { ?>
                    <div class="price-box">
                        <span class="amount"><?= $item->price ?> LEI</span>
                    </div>
                <?php } ?>
                <div class="actions clearfix">
                    <div class="action-buttons">
<!--                        <div class="">
                            <a data-target="#productModal" data-toggle="modal" href="" class="detail-link quickview">Quick View</a>
                        </div>-->
                        <div class="add-to-links">
<!--                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-317">
                                <div>
                                    <a href="" class="add_to_wishlist">Add to Wishlist</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>-->
                            <div class="bootexpert product">
                                <a href="" class="button">Cumpără</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>