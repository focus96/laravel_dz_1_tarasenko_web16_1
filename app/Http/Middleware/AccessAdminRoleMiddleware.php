<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AccessAdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::user()->roles()->value('slug');
        if ($role !== 'admin') {
            abort(403, 'Unauthorized action.');

            return redirect('news');
        }

        return $next($request);
    }
}
