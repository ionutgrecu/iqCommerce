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
                </div>
            </div>
        </div>
    </div>

    <div class="phm_row hasteck_row phm_row-fluid home-brands">
        <div class="row-container">
            <div class="parvez_column parvez_column_container parvez_col-sm-12">
                <div class="parvez_wrapper">
                    <div id="brands-carousel-1" class="brands-carousel">
                        <div>
                            <a href="" title="Logo1">
                                <img src="images/digital/brand/3.jpg" alt="Logo1">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo2">
                                <img src="images/digital/brand/4.jpg" alt="Logo2">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo3">
                                <img src="images/digital/brand/1.jpg" alt="Logo3">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo4">
                                <img src="images/digital/brand/2.jpg" alt="Logo4">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo5">
                                <img src="images/digital/brand/3.jpg" alt="Logo5">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo6">
                                <img src="images/digital/brand/4.jpg" alt="Logo6">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo7">
                                <img src="images/digital/brand/1.jpg" alt="Logo7">
                            </a>
                        </div>
                        <div>
                            <a href="" title="Logo8">
                                <img src="images/digital/brand/2.jpg" alt="Logo8">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection