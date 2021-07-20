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
                                    <?php foreach($product->images as $item){ ?>
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
                            </div>
                            <!-- .summary -->
                        </div>

                        <?php if(!empty($related)) {?>
                        <div id="secondary" class="col-xs-12 col-md-3">
                            <div class="widget related_products_widget">
                                <h3 class="widget-title"><span>Din aceeasi categorie</span></h3>
                                <div class="related products">
                                    <div class="shop-products row grid-view">
                                        <?php foreach($related as $key => $item){ ?>
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
                                <?=$product->description?>
                            </div>
                            <div class="panel" id="tab-addi-info">
                                <table class="shop_attributes">
                                    <tbody>
                                        <tr class="">
                                            <th>Color</th>
                                            <td class="product_weight">Rad, Black</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>Dimensions</th>
                                            <td class="product_dimensions">10 x 20 x 30 cm</td>
                                        </tr>
                                        <tr class="">
                                            <th>Size</th>
                                            <td><p>L, M, S, XL</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel" id="tab-reviews">
                                <div id="reviews">
                                    <div id="comments">
                                        <h2>1 review for Nulla sed libero</h2>
                                        <ol class="commentlist">
                                            <li class="comment byuser comment-author-admin bypostauthor even thread-even">
                                                <div class="comment_container">
                                                    <img alt="" src="images/digital/blog/avatar.png" class="avatar avatar-60 photo" />
                                                    <div class="comment-text">
                                                        <div class="star-rating" title="Rated 5 out of 5"> 
                                                            <span class="width100"><strong>5</strong> out of 5</span>
                                                        </div>
                                                        <p class="meta"> 
                                                            <strong>admin</strong> &ndash; 
                                                            <span>October 12, 2014</span>:
                                                        </p>
                                                        <div class="description">
                                                            <p>Very nice shoes! I will buy it.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <h3 id="reply-title" class="comment-reply-title">Add a review</h3>
                                                <form action="#" method="post" id="commentform" class="comment-form">
                                                    <div class="comment-input">
                                                        <p class="comment-form-author">
                                                            <label for="author">Name <span class="required">*</span></label>
                                                            <input id="author" name="author" type="text" value="" size="30" />
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label for="email">Email <span class="required">*</span></label>
                                                            <input id="email" name="email" type="text" value="" size="30" />
                                                        </p>
                                                    </div>
                                                    <div class="comment-form-rating">
                                                        <label>Your Rating</label>
                                                        <p class="stars">
                                                            <span>
                                                                <a href="#" class="star-1">1</a>
                                                                <a href="#" class="star-2">2</a>
                                                                <a href="#" class="star-3">3</a>
                                                                <a href="#" class="star-4">4</a>
                                                                <a href="#" class="star-5">5</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="comment-form-comment">
                                                        <label>Your Review</label>
                                                        <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                                    </p>
                                                    <p class="form-submit">
                                                        <input name="submit" type="submit" id="submit" class="submit" value="Submit" />
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="home-brands other-page">
                            <div id="brands-carousel-1" class="brands-carousel">
                                <div>
                                    <a href="" title="Logo1">
                                        <img src="images/digital/brand/brand061.png" alt="Logo1" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo2">
                                        <img src="images/digital/brand/brand051.png" alt="Logo2" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo3">
                                        <img src="images/digital/brand/brand041.png" alt="Logo3" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo4">
                                        <img src="images/digital/brand/brand031.png" alt="Logo4" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo5">
                                        <img src="images/digital/brand/brand021.png" alt="Logo5" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo6">
                                        <img src="images/digital/brand/brand041.png" alt="Logo6" />
                                    </a>
                                </div>
                                <div>
                                    <a href="" title="Logo7">
                                        <img src="images/digital/brand/brand051.png" alt="Logo7" />
                                    </a>
                                </div>
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