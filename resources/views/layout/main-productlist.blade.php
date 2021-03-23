<?php $products = $productsService->getItemsNew(9); ?>
<div class="shop-products row grid-view">
    <?php foreach ($products as $key => $item) { ?>    
        @include('layout.product',['item'=>$item,'key'=>$key])
    <?php } ?>
</div>