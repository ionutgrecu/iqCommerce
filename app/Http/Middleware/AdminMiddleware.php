<?php

namespace App\Http\Middleware;

use Closure;
use Gate;
use Illuminate\Http\Request;
use function ___;
use function redirect;
use function response;
use function route;
use function session;

class AdminMiddleware {

    public function handle(Request $request, Closure $next) {
        if (Gate::denies('isAuthor'))
            if (\Request::isJson())
                return response()->json(['status' => 'invalid_session', 'message' => __('Can\' access that page right now.')]);
            else {
                session()->put('after_login', $request->url());
                return redirect(route('login'))->with('error', __('Can\' access that page right now.'));
            }

        return $next($request);
    }

}
