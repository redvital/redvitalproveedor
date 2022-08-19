<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
            
    
           if (in_array($currentRouteName, $this->userAccesRole()[$userRole])){
            return $next($request);
           }else{
               abort(403,'No tienes acceso a esta sección de la web');
           }

        } catch(\Throwable $th){
            abort(403,'No tienes acceso a esta sección de la web');

        }
       
        
    }


private function userAccesRole()
{
    return [
        'user' =>[
            'dashboard',
            '/',
            'logout',
            'crear',
            'productos',
        ], 
        'admin' =>[
            // 'dashboard',
            // 'crear',
            // 'productos',
            '/',
            'admin',
            'AdminListProduct',
            'registro',
            'admin/registro',
            'crea-txt',
            'adminProductos.show',
            
        ]
        ];
}
}
