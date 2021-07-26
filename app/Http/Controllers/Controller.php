<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use App\Services\CartService;
use App\Services\CategoryCharacteristicsService;
use App\Services\ProductCategoriesService;
use App\Services\ProductCharacteristicsService;
use App\Services\ProductsService;
use App\Services\ProductVendorsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Route;
use View;
use function ___;
use function app;
use function class_basename;
use function config;
use function redirect;
use function request;
use function route;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $lang;
    protected $localeArr;
    protected $params = [];
    protected $path = '';
    protected $action = '';

    function __construct(
            ProductCategoriesService $categoryService,
            CategoryCharacteristicsService $categoryCharacteristicsService,
            ProductVendorsService $productVendorsService,
            ProductsService $productsService,
            ProductCharacteristicsService $ProductCharacteristicsService,
            BreadcrumbsService $breadcrumbService,
            CartService $cartService) {

        $this->params['error'] = request()->session()->pull('error');
        $this->params['success'] = request()->session()->pull('success');
        $this->params['info'] = request()->session()->pull('info');
        $this->params['request'] = request()->input();
        $breadcrumbService->addBreadcrumb(__('Home'), __('Home'), route('home'), 'fas fa-home');

        View::share('categoryService', $categoryService);
        View::share('categoryCharacteristicsService', $categoryCharacteristicsService);
        View::share('productVendorsService', $productVendorsService);
        View::share('productsService', $productsService);
        View::share('ProductCharacteristicsService', $ProductCharacteristicsService);
        View::share('breadcrumbService', $breadcrumbService);
        View::share('cartService', $cartService);

        if (Route::current()->parameters['wildcard'] ?? null) {
            $wildcard = Route::current()->parameters['wildcard'];
            $get = explode('/', $wildcard);

            request()->route()->setAction(array_merge(request()->route()->getAction(), [
                'uses' => strtr(request()->route()->getAction()['uses'], ['@index' => '@' . $get[0]]),
                'controller' => strtr(request()->route()->getAction()['controller'], ['@index' => '@' . $get[0]]),
            ]));

            $pathArr = [];
            for ($i = 0; $i < count($get); $i++) {
                Route::current()->parameters['get'][] = $get[$i];
                $this->params[] = $get[$i];

                if (strpos('.', $get[$i]) === false)
                    $pathArr[] = $get[$i];
                else
                    $this->file = $get[$i];
            }
            $this->path = implode('/', $pathArr);
        }
        if (!($this->params[0] ?? null)) {
            list($controller, $action) = explode('@', Route::currentRouteAction());
            $controllerArr = explode('\\', $controller);
            $this->params['controller'] = array_pop($controllerArr);
            $this->params['action'] = $action;
            $this->params[0] = request()->route()->parameters['slug'] ?? ($action == 'page' ? 'index' : $this->action);
        }
        $this->params['controller'] = class_basename($this);
        $this->params['path'] = $this->path;
        $this->params['params'] = $this->params;

        $this->lang = app()->getLocale();
        $this->params['lang'] = $this->lang;

        $this->setCurrentPage($this->params['params']['controller']);
        $this->setCurrentSubpage($this->params['params']['action']);

        $this->setPageTitle(config('app.name'));
        $this->setPageDescription(config('app.description'));

        \View::share('lang', $this->params['lang']);
        \View::share('meta', $this->params['meta']);
    }

    protected function setCurrentPage(string $value) {
        $this->params['currentPage'] = strtolower(strtr($value, ['Controller' => '', 'Admin' => '']));
    }

    protected function setCurrentSubpage(string $value) {
        $this->params['currentSubpage'] = strtolower(strtr($value, ['Controller' => '']));
    }

    protected function setPageTitle(string $value) {
        $this->setPageMeta('title', $value);
    }

    protected function prependPageTitle(string $value) {
        $value .= ' | ' . $this->params['meta']['title'];
        $this->setPageTitle($value);
    }

    protected function setPageDescription(string $value) {
        $this->setPageMeta('description', $value);
    }

    protected function setPageMeta(string $name, string $value) {
        $this->params['meta'][$name] = $value;
    }

    //Default action
//    function index() {
//        return view('index', $this->params);
//    }

    protected function wildcard() {
        if ($this->params['controller']) {
            return (new $this->params['controller'])->{$this->params[0]}();
        } else {
            return $this->{$this->params[0]}();
        }
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array   $parameters
     * @return redirect
     */
    public function __call($method, $parameters) {
        return redirect('/');
    }

}
