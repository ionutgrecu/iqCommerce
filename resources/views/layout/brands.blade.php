<?php $vendors = $productVendorsService->getAll(); ?>
<div id="brands-carousel-1" class="brands-carousel">
    <?php foreach ($vendors as $item) { ?>
        <div>
            <a href="javascript:void(0)" title="<?= $item->name ?>">
                <img src="<?= $item->getImageUrl() ?>" alt="Logo1">
            </a>
        </div>
    <?php } ?>
</div>