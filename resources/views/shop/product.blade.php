@extends('layout.main')

@section('content')
<div class="page-content">
    <div class="product-page">
        <div class="container">
            @include('layout.breadcrumbs')
        </div>
        <div class="product-view">
            <div class="product">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="single-product-image">
                                <div class="images single-images gallery">
                                    <?php foreach ($product->images as $item) { ?>
                                        <img src="<?= $item->getUrl() ?>" class="attachment-shop_single" alt="<?= $product->name ?>" />
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="summary entry-summary single-product-info">
                                <h1 class="product_title entry-title"><?= $product->name ?></h1>
                                <!--                                <div class="bootexpert-product-rating">
                                                                    <div class="star-rating" title="Rated 4.00 out of 5">
                                                                        <span class="width80"><strong class="rating">4.00</strong> out of <span>5</span>	based on <span class="rating">1</span> customer rating</span>
                                                                    </div>
                                                                </div>-->
                                <div class="short-description">
                                    <?= $product->description ?>
                                </div>
                                <div class="price-box">
                                    <p class="price">
                                        @include('components.product-price',['item'=>$product])
                                    </p>
                                </div>
                                <form class="cart" method="post" enctype='multipart/form-data'>
                                    <?= csrf_field()?>
                                    <div class="quantity">
                                        <input type="number" name="qty" value="1" title="Qty" class="input-text qty text" size="4" />
                                    </div>
                                    <button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>
                                </form>
                            </div>
                            <!-- .summary -->
                        </div>

                        <?php if (!empty($related)) { ?>
                            <div id="secondary" class="col-xs-12 col-md-3">
                                <div class="widget related_products_widget">
                                    <h3 class="widget-title"><span>Din aceeasi categorie</span></h3>
                                    <div class="related products">
                                        <div class="shop-products row grid-view">
                                            <?php foreach ($related as $key => $item) { ?>
                                                @include('shop.list-item2',['key'=>$key,'item'=>$item])
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="bootexpert-tabs wc-tabs-wrapper">
                            <ul class="tabs parveztabs">
                                <li rel="tab-description" class="tab active"><a>Descriere</a></li>
                                <li rel="tab-addi-info" class="tab"><a>Informatii</a></li>
                            </ul>
                            <div class="panel active" id="tab-description">
                                <?= $product->description ?>
                            </div>
                            <div class="panel" id="tab-addi-info">
                                <table class="shop_attributes">
                                    <tbody>
                                        <?php foreach ($product->characteristics as $item) { ?>
                                            <tr class="">
                                                <th><?= $item->category_characteristic->name ?></th>
                                                <td class="product_weight"><?= $item->getValue() ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #product-2249 -->
        </div>
    </div>
</div>
@endsection