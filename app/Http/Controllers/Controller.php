<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Route;
use function app;
use function class_basename;
use function config;
use function redirect;
use function request;
use function view;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $data = [];
    protected $lang;
    protected $localeArr;

    function __construct() {
        $this->data['error'] = request()->session()->pull('error');
        $this->data['success'] = request()->session()->pull('success');
        $this->data['info'] = request()->session()->pull('info');
        $this->data['request'] = request()->input();

        if (Route::current()->parameters['wildcard']) {
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
        if (!$this->params[0]) {
            list($controller, $action) = explode('@', Route::currentRouteAction());
            $controllerArr = explode('\\', $controller);
            $this->params['controller'] = array_pop($controllerArr);
            $this->params['action'] = $action;
            $this->params[0] = request()->route()->parameters['slug'] ?: ($action == 'page' ? 'index' : $this->action);
        }
        $this->params['controller'] = class_basename($this);
        $this->params['path'] = $this->path;
        $this->data['params'] = $this->params;

        $this->lang = app()->getLocale();
        $this->data['lang'] = $this->lang;

        $this->setCurrentPage($this->data['params']['controller']);
        $this->setCurrentSubpage($this->data['params']['action']);

        $this->setPageTitle(config('app.name'));
        $this->setPageDescription(config('app.description'));
    }

    protected function setCurrentPage(string $value) {
        $this->data['currentPage'] = strtolower(strtr($value, ['Controller' => '', 'Admin' => '']));
    }

    protected function setCurrentSubpage(string $value) {
        $this->data['currentSubpage'] = strtolower(strtr($value, ['Controller' => '']));
    }

    protected function setPageTitle(string $value) {
        $this->setPageMeta('title', $value);
    }
    
    protected function prependPageTitle(string $value){
        $value.=' | '.$this->data['meta']['title'];
        $this->setPageTitle($value);
    }

    protected function setPageDescription(string $value) {
        $this->setPageMeta('description', $value);
    }

    protected function setPageMeta(string $name, string $value) {
        $this->data['meta'][$name] = $value;
    }

    //Default action
    function index() {
        return view('index', $this->data);
    }

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
