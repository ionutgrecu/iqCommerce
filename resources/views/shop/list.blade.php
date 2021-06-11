<?php if ($products) { ?>
    <div class="shop-products row grid-view">
        <?php foreach ($products as $key => $item) { ?>    
            @include('shop.list-item',['item'=>$item,'key'=>$key])
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="main-container error404">
        <div class="entry-header">
            <h1>Opps! Nu exista produse dupa criteriile selectate.</h1>
        </div>
        <div class="image-404"><img alt="" src="<?= asset('assets/img404.png') ?>"></div>
        <div class="form404-wrapper">
            <div class="container">
                <a title="Back to homepage" href="<?= route('home') ?>">Back to homepage</a>
            </div>
        </div>
    </div>
    <?php
}?>