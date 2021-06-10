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
                        if ($filter->getSuggestedValues($filterRequest)) {
                            ?>
                            <aside class="widget widget-filter">
                                <h3 class="widget-title"><span><?= $filter->name ?></span></h3>
                                <div class="widget_content">
                                    <ul>
                                        <?php
                                        foreach ($filter->suggested_values as $filterValue) {
                                            $filterRequestTmp = $filterRequest;
                                            $filterRequestTmp[$filter->id] = $filterValue['value'];
                                            ?>
                                            <li><a class="<?= in_array($filterValue['value'], $filterRequest) ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequestTmp, 'sort_by' => $sortbyRequest, 'sort' => $sortRequest]) ?>"><?= $filterValue['value'] ?></a>  <span class="count">(<?= $filterValue['product_count'] ?>)</span></li>
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
                                    <label>Sortare dupa:</label> <a class="<?= 'price' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'price', 'sort' => 'ASC']) ?>">Pret</a> <a class="<?= 'id' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'id', 'sort' => 'DESC']) ?>">Noutati</a> <a class="<?= 'recommends' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'recommends', 'sort' => 'DESC']) ?>">Recomandari</a>
                                </div>
                            </div>

                            <?= $products->appends(\Arr::except(request()->input(), ['q']))->links() ?>

                            <div class="clearfix"></div>
                        </div>

                        @include('shop.list',['products'=>$products])

                        <div class="toolbar tb-bottom">
                            <div class="bootexpert-ordering">
                                <div class="orderby-wrapper">
                                    <label>Sortare dupa:</label> <a class="<?= 'price' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'price', 'sort' => 'ASC']) ?>">Pret</a> <a class="<?= 'id' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'id', 'sort' => 'DESC']) ?>">Noutati</a> <a class="<?= 'recommends' == $sortbyRequest ? 'selected' : '' ?>" href="<?= route('shop.category', ['cat_slug' => $categorySlug, 'filter' => $filterRequest, 'sort_by' => 'recommends', 'sort' => 'DESC']) ?>">Recomandari</a>
                                </div>
                            </div>

                            <?= $products->appends(\Arr::except(request()->input(), ['q']))->links() ?>

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
