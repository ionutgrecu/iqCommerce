<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request as Request2;
use Request;
use function ___;
use function GuzzleHttp\json_encode;
use function route;
use function session;

class Authenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request2  $request
     * @return string|null
     */
    protected function redirectTo($request) {
        if (Request::isJson())
            return json_encode(['status' => 'not authenticated', 'message' => __('Can\' access that page right now.')]);
        else {
            session()->put('after_login', $request->url());
            return route('login');
        }
    }

}
