<?php

namespace App\Http\Middleware\Role;

use Closure;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class superAdmin
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

        if ($roles != null && $roles->superAdmin) {
            return $next($request);
        } else {
            return redirect()->route('notAuthorized')->with('fail', 'Sorry, You do not have the right to access the page!');
        }
    }
}
