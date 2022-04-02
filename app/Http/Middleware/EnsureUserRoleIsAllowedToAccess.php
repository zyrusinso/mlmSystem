<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\UserPermission;
use App\Models\UserRole;
use App\Models\User;

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
            $userRoleRedirect = UserRole::where('role', $userRole)->first();

            if( UserPermission::isRoleHasRightToAccess($userRole, $currentRouteName)
                || $this->checkUserRoleIfExistInDefault()){
                return $next($request);
            }else{
                if(User::userRoleList()[$userRole]){
                    if(UserPermission::isRoleHasRightToAccess($userRole, $userRoleRedirect->redirect_url)){
                        return redirect(route(User::userRoleRedirect($userRole)));
                    }else{
                        return redirect(route('home'));
                    }
                }else{
                    abort(403, "Anauthorized Action!");
                }
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
                'dashboard',
                'user-permissions',
            ]
        ];
    }

    private function checkUserRoleIfExistInDefault(){
        $data = [];
        $currentRouteName = Route::currentRouteName();
        $userRole = auth()->user()->role;

        if(!array_key_exists($userRole, defaultUserAccessRole())){
            return false;
        }

        return in_array($currentRouteName, defaultUserAccessRole()[$userRole]) ? true : false;
    }
}
