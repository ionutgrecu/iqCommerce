<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ url('/assets/admin/brand/coreui-base-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
    <img class="c-sidebar-brand-minimized" src="{{ url('assets/admin/brand/coreui-signet-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
</div>
<ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin">
            <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= url('/assets/admin/icons/sprites/free.svg#cil-speedometer') ?>"></use>
            </svg> <?= __('Dashboard') ?></a></li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= url('/assets/admin/icons/sprites/brand.svg#cib-product-hunt') ?>"></use>
            </svg> <?= __('Products') ?></a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><i class="fas fa-user-secret"></i> <?=__('Vendors')?></a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><i class="fas fa-sitemap"></i> <?=__('Categories')?></a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><i class="fas fa-asterisk"></i> <?=__('Characteristics')?></a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><i class="fas fa-cubes"></i> <?=__('Products')?></a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><i class="fas fa-dollar-sign"></i> <?=__('Orders')?></a></li>
        </ul>
    </li>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 576px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 453px;"></div></div></ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>