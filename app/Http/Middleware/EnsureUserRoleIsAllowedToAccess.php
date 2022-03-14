<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\UserPermission;

class EnsureUserRoleIsAllowedToAccess
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
        try{
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();

            if( UserPermission::isRoleHasRightToAccess($userRole, $currentRouteName)
                || in_array($currentRouteName, $this->defaultUserAccessRole()[$userRole])){
                return $next($request);
            }else{
                abort(403, "Anauthorized Action!");
            }
        }catch(Exception $e){
            abort(403, "You are not allowed to access this page.");
        }
    }

    private function defaultUserAccessRole(){
        return [
            'user' => [
                'dashboard'
            ],
            'admin' => [
                'user-permissions',
            ]
        ];
    }
}
