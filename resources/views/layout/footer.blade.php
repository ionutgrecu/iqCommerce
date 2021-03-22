<div class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="widget widget_about_us">
                        <h3 class="widget-title">Despre</h3>
                        Acest proiect este construit în scop didactic pentru lucrarea de licență din cadrul Academiei de Studii Economice București.
                        <ul>
                            <li>
                                <i class="fa fa-phone"></i> +4 0723.535.689
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i> <a href="mailto:ionut@grecu.eu">ionut@grecu.eu</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget static-footer">
                        <a href="<?= route('home') ?>">
                            <img src="<?= mix('assets/block_footer.png'); ?>" alt="block_footer">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="widget widget_menu">
                        <h3 class="widget-title">
                            <span>Contul meu</span>
                        </h3>
                        <div class="menu-my-account-container">
                            <ul class="nav_menu">
                                <li>
                                    <a href="<?= route('login') ?>">Login</a>
                                </li>
                                <li>
                                    <a href="#">Cos cumparaturi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="widget widget_menu">
                        <h3 class="widget-title">Meniu</h3>
                        <div class="menu-our-support-container">
                            <ul id="menu-our-support" class="nav_menu">
                                <li class="first">
                                    <a href="<?= route('home') ?>">Home</a>
                                </li>
                                <?php foreach ($categories as $item) { ?>
                                    <li>
                                        <a href="<?= $item->getUrl() ?>"><?= $item->name ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <div class="copyright-info">Copyright &copy; <?= date('Y') ?>
                    <a href="https://grecu.eu/" target="_blank">Ionut Grecu.</a> All Rights Reserved
                </div>
                <div class="bottom-right">

                </div>
            </div>
        </div>
    </div>
</div>