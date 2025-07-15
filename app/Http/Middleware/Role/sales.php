<?php

namespace App\Http\Middleware\Role;

use Closure;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = Roles::where('rolesId',Auth::user()->role)->first();

        if ($roles != null && in_array(Auth::user()->role, [1, 5, 6, 7])) {
            return $next($request);
        } else {
            return redirect()->route('notAuthorized')->with('fail', 'Sorry, You do not have the right to access the page!');
        }
    }
}
