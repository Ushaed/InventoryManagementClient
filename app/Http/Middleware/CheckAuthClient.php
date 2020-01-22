<?php

namespace App\Http\Middleware;

use Closure;
class CheckAuthClient
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
        $data = [];
        $data['accessToken'] = $request->cookie('accessToken');
        $data['userId'] = $request->cookie('userId');
        $data['base_uri'] = 'http://ushaed.inventoryapi.rmwebdev.com/api/v1/';
        $data['CustomHeaders'] = [
            'Accept' => 'Application/json',
            'Authorization' => $data['accessToken'],
        ];
        if (empty($data['userId']) || empty($data['accessToken'])){
            return redirect()->route('login');
        }
        $request->merge(array(
            "base_uri" => $data['base_uri'],
            "CustomHeaders" => $data['CustomHeaders']
            ));
        return $next($request);
    }
}
