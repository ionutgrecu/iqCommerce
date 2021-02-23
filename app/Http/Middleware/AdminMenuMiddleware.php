<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Menus\GetSidebarMenu;
use App\Models\Menulist;
use App\Models\RoleHierarchy;
use Spatie\Permission\Models\Role;

class AdminMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result=[];
        
$result['top_menu']=[
  [
    "slug" => "dropdown"
    "name" => "Pages"
    "hasIcon" => false
    "elements" => array:3 [
        [
        "id" => 57
        "slug" => "link"
        "name" => "Dashboard"
        "href" => "/"
        "hasIcon" => false
        "sequence" => 57
      ],
       [
        "id" => 58
        "slug" => "link"
        "name" => "Notes"
        "href" => "/notes"
        "hasIcon" => false
        "sequence" => 58
      ],
      2 => array:6 [
        "id" => 59
        "slug" => "link"
        "name" => "Users"
        "href" => "/users"
        "hasIcon" => false
        "sequence" => 59
      ]
    ]
    "sequence" => 56
  ]
  [
    "slug" => "dropdown"
    "name" => "Settings"
    "hasIcon" => false
    "elements" => array:5 [
         0 => array:6 [
        "id" => 61
        "slug" => "link"
        "name" => "Edit menu"
        "href" => "/menu/menu"
        "hasIcon" => false
        "sequence" => 61
      ]
      1 => array:6 [
        "id" => 62
        "slug" => "link"
        "name" => "Edit menu elements"
        "href" => "/menu/element"
        "hasIcon" => false
        "sequence" => 62
      ]
      2 => array:6 [
        "id" => 63
        "slug" => "link"
        "name" => "Edit roles"
        "href" => "/roles"
        "hasIcon" => false
        "sequence" => 63
      ]
      3 => array:6 [
        "id" => 64
        "slug" => "link"
        "name" => "Media"
        "href" => "/media"
        "hasIcon" => false
        "sequence" => 64
      ]
      4 => array:6 [
        "id" => 65
        "slug" => "link"
        "name" => "BREAD"
        "href" => "/bread"
        "hasIcon" => false
        "sequence" => 65
      ]
    ]
    "sequence" => 60
  ]
];
        
        //session(['prime_user_role' => $role]);
        $menus = new GetSidebarMenu();
        $menulists = Menulist::all();
        $result = array();
        foreach($menulists as $menulist){
            $result[ $menulist->name ] = $menus->get( $role, $menulist->id );
        }
        view()->share('appMenus', $result );
        return $next($request);
    }
}