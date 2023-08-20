<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
//        dd($user);
        $roleName = $user->role->first()->name;
    //    dd($roleName);
        if ($roleName === 'manager') {
            // Người dùng có role là "manager", cho phép truy cập
            return $next($request);
        } elseif ($roleName === 'employee') {
            $allowdRoutes = ['user-profile', 'update-user'];
            if(in_array($request->route()->getName(), $allowdRoutes))
            {
                return $next($request);
            } else {
                abort(403, 'Unauthorized');
            }
        }
        abort(403, 'Unauthorized');
    }
//    public function handle(Request $request, Closure $next)
//    {
//        $user = auth()->user();
//        $role = Role::find($user->role_id);
//        if ($role === 'manager') {
//            // Người dùng có role là "manager", cho phép truy cập
//            return $next($request);
//        }
////        return $next($request);
//        abort(403, 'Unauthorized');
//    }
}
