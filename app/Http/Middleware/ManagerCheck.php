<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Exception\RequestException;

class ManagerCheck
{
    public function handle($request, Closure $next)
    {
        $user_type = request()->cookie('userType');
            if ($user_type !== "manager"){
                return redirect()->back()->with(['type'=>'error','message'=>"Aceess Denied"]);
            }
        return $next($request);
    }
}
