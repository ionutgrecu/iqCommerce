<div class="first last item-col col-xs-12 col-sm-12">
    <div class="product-wrapper">
        <div class="list-col4">
            <div class="product-image">
                <a href="<?=$item->getUrl()?>">
                    <img src="<?=$item->getImageUrl()?>" class="primary_image" alt="<?=$item->name?>" />
                </a>
            </div>
        </div>
        <div class="list-col8">
            <div class="gridview">
                <h2 class="product-name"><a href="<?=$item->getUrl()?>"><?=$item->name?></a></h2>
                <div class="price-box">
                    @include('components.product-price',['item'=>$item])
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>