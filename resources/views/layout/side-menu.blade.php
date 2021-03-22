<div class="menu-categories-container">
    <ul id="menu-categories" class="menu">
        <?php foreach ($categories as $parentCategory) { ?>
            <li class="first">
                <a href=""><?= $parentCategory->name ?></a>
                <ul class="sub-menu">
                    <?php foreach ($parentCategory->childs as $child) { ?>
                        <li>
                            <a href="<?= $child->getUrl() ?>"><?= $child->name ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>