<?php $categories = $categoryService->getTree(); ?>

<div class="parvez_wrapper">
    <div class="phm_row hasteck_row parvez_inner phm_row-fluid digital-categories">
        <div class="parvez_column parvez_column_container parvez_col-sm-12">
            <div class="parvez_wrapper">
                <div class="parvez_wp_custommenu parvez_content_element">
                    <div class="widget widget_nav_menu">
                        @include('layout.side-menu',['categories'=>$categories])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="phm_row hasteck_row parvez_inner phm_row-fluid best-seller layout7">
        <div class="parvez_column parvez_column_container parvez_col-sm-12">
            <div class="parvez_wrapper">
                <div class="parvez_text_column parvez_content_element ">
                    <div class="parvez_wrapper">
                        <h3>Produse la reducere</h3>
                    </div>
                </div>
                <div class="bootexpert columns-1">
                    @include('layout.discounts')
                </div>
            </div>
        </div>
    </div>
</div>