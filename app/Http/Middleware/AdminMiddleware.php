<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {

    public function handle(Request $request, Closure $next) {
        if (\Gate::denies('isAuthor'))
            return redirect('/')->with('error', __('Can\' access that page right now.'));
        return $next($request);
    }

}
