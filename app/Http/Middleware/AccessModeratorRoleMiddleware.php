<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AccessModeratorRoleMiddleware
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
        //dd($role);
        if ($role !== 'moderator') {
            //abort(403, 'Unauthorized action.');
            return redirect('news');
        }

        return $next($request);
    }
}
