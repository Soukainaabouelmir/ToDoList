<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthorizeAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
