<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuList;
use Illuminate\Database\Seeder;

class Menus extends Seeder {

    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $subFolder = '';

    public function insertLink(MenuList $menuList, string $role, string $name, string $href, string $icon = null) {
        $href = $this->subFolder . $href;

        $menu = Menu::firstOrNew([
                    'href' => $href,
                    'menu_id' => $menuList->id,
        ]);

        if ($this->dropdown === false)
            $menu->fill([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'sequence' => $this->sequence,
                'role' => $role
            ]);
        else
            $menu->fill([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence,
                'role' => $role
            ]);

        $menu->save();

        $this->sequence++;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topMenu = MenuList::firstOrCreate([
                    'name' => 'top menu'
        ]);
        $this->insertLink($topMenu, 'author', 'Dashboards', '/', 'cil-speedometer');

        $sidebarMenu = MenuList::firstOrCreate([
                    'name' => 'sidebar menu'
        ]);
    }

}
