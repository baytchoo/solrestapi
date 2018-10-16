<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Closure;
use JWTAuth;

class Admin
{   
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!JWTAuth::user()->isAdmin()){
            return $this->errorResponse("Admin VIP!." , 403);
        }
        return $next($request);
    }
}
