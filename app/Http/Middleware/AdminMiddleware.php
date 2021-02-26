<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {

    public function handle(Request $request, Closure $next) {
        if (\Gate::denies('isAuthor'))
            if (\Request::isJson()) {
                return response()->json(['status' => 'invalid_session', 'message' => __('Can\' access that page right now.')]);
            } else {
                return redirect(route('login'))->with('error', __('Can\' access that page right now.'));
            }

        return $next($request);
    }

}
