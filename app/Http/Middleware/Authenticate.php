<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware {

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(\Illuminate\Http\Request $request) {
        if (\Request::isJson()) {
            return json_encode(['status' => 'not authenticated', 'message' => __('Can\' access that page right now.')]);
        } else {
            return route('login');
        }
    }

}
