<div class="visible-large">
    <div id="saharan_mega_main_menu" class="dropdowns_trigger-hover dropdowns_animation-anim_5">
        <div class="menu_holder">
            <div class="mmm_fullwidth_container"></div>
            <!-- class="fullwidth_container" -->
            <nav class="menu_inner">
                <!-- /class="nav_logo" -->
                <ul>
                    <li class="active-menu-item first drop_to_right children-menu">
                        <a href="<?= route('home') ?>" class="item_link">
                            <span class="link_content">
                                <span class="link_text">Home</span>
                            </span>
                        </a>
                    </li>
                    <li class="default_dropdown drop_to_right children-menu">
                        <a href="#" class="item_link ">
                            <span class="link_content">
                                <span class="link_text">Produse</span>
                            </span>
                        </a>
                        <ul class="mega_dropdown">
                            <?php foreach ($categories as $item) { ?>
                                <li class="default_dropdown drop_to_right children-menu">
                                    <a href="<?= $item->getUrl() ?>" class="item_link ">
                                        <span class="link_content">
                                            <span class="link_text"><?= $item->name ?></span>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="default_dropdown drop_to_right children-menu">
                        <a href="<?= route('home.about') ?>" class="item_link ">
                            <span class="link_content">
                                <span class="link_text">Despre Proiect</span>
                            </span>
                        </a>
                    </li>
                    <li class="default_dropdown drop_to_right children-menu">
                        <a href="<?= route('home.contact') ?>" class="item_link ">
                            <span class="link_content">
                                <span class="link_text">Contact</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /class="menu_inner" -->
        </div>
        <!-- /class="menu_holder" -->
    </div>
</div>

<!-- Mobile Menu -->
<div class="visible-small mobile-menu">
    <div class="nav-container">
        <div class="mbmenu-toggler">Menu
            <span class="mbmenu-icon"></span>
        </div>
        <nav class="mobile-menu-container">
            <ul id="menu-horizontal-menu" class="nav-menu">
                <li class="first">
                    <a href="<?= route('home') ?>">Home</a>
                </li>
                <li class="children-menu">
                    <a href="#">Produse</a>
                    <ul class="sub-menu">
                        <?php foreach ($categories as $item) { ?>
                            <li>
                                <a href="<?= $item->getUrl() ?>"><?= $item->name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="<?= route('home.about') ?>">Despre proiect</a>
                </li>
                <li>
                    <a href="<?= route('home.contact') ?>">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- Mobile Menu -->