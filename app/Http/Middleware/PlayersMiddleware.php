<?php

namespace App\Http\Middleware;

use Closure;

class PlayersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('role') != "player") {
            
               abort(403, 'Vous n\'êtes pas autoriser à accéder. Connectez-vous !'); 
               
        } else {
            
              return $next($request);
              
        }  
    }
}
