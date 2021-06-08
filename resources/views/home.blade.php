@extends('layout.main')

@section('js-footer')
<script type="text/javascript" src="<?= asset('assets/lib/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>   
<script type="text/javascript" src="<?= asset('assets/lib/rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('assets/lib/rs-plugin/rs.home.js') ?>"></script>
@endsection

@section('content')
<div class="page-content front-page">
    <div class="phm_row hasteck_row phm_row-fluid main-layout6">
        <div class="row-container">
            <div class="left-column parvez_column parvez_column_container parvez_col-sm-3">
                @include('layout.sidebar')
            </div>

            <div class="right-column parvez_column parvez_column_container parvez_col-sm-9">
                <div class="parvez_wrapper">
                    @include('layout.main-slider')

                    <?php $products = $productsService->getItemsNew(9); ?>
                    @include('shop.list',['products'=>$products])
                </div>
            </div>
        </div>
    </div>

    <div class="phm_row hasteck_row phm_row-fluid home-brands">
        <div class="row-container">
            <div class="parvez_column parvez_column_container parvez_col-sm-12">
                <div class="parvez_wrapper">
                    @include('layout.brands')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection