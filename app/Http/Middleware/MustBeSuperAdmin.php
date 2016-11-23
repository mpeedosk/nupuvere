<?php

namespace App\Http\Middleware;

use Closure;

class MustBeSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->isSuperAdmin()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response('Forbbiden.', 403);
        } else {
            return redirect('/admin/home');
        }
    }
}
