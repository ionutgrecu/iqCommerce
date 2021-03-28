<nav class="breadcrumb">
    <?php foreach ($breadcrumbService->getBreadcrumbs() as $k => $item) { ?>
        <?php if (0 != $k) { ?><span class="separator">/</span> <?php } ?><a href="<?= $item['url'] ?>" title="<?= $item['title'] ?>"><?php if ($item['icon']) { ?><i class="<?= $item['icon'] ?>"></i> <?php } ?><?= $item['text'] ?></a>
    <?php } ?>
</nav>