<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthorizeAdmin
{
    public function handle(Request $request, Closure $next, $ability)
    {
        if (!Gate::allows($ability, Auth::guard('admin')->user())) {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
}

