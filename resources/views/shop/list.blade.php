<div class="shop-products row grid-view">
    <?php foreach ($products as $key => $item) { ?>    
        @include('shop.list-item',['item'=>$item,'key'=>$key])
    <?php } ?>
</div>