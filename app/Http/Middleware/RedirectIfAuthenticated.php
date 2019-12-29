<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $data = [];
        $data['accessToken'] = request()->cookie('accessToken');
        $data['userId'] = request()->cookie('userId');
        if (!empty($data['userId']) && !empty($data['accessToken'])){
            return redirect()->back();
        }
        return $next($request);
    }
}
