<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class GateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode('|', $roles);

        $rolesUsers = Auth::user()->roles()->select('slug')->get();

        foreach ($rolesUsers as $roleUser) {
            if (array_search($roleUser->slug, $roles) !== false) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');

        return redirect('news');
    }
}
