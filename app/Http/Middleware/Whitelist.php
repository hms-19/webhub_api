<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Whitelist
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
        
        //Check that referring domain is whitelisted or itself?
        if($request->data == 'dddskaskfdjdiewqrnknsadifjfkerroieqjwqmrnfdsdijfewqjofejfojodjsaoifsdjeq'){
            return $next($request)->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Credentials','true')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        }else{
            header('HTTP/1.0 403 Forbidden');
            die('You are not allowed to access this file.');
        }
        
    }
}
