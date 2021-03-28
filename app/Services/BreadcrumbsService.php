<?php

namespace App\Services;

class BreadcrumbsService {

    private $breadCrumbs = [];

    public function getBreadcrumbs() {
        return $this->breadCrumbs;
    }

    public function addBreadcrumb($text, $title, $url, $fontIcon = null) {
        $this->breadCrumbs[] = [
            'text' => $text,
            'title' => $title,
            'url' => $url,
            'icon' => $fontIcon,
        ];
    }

}
