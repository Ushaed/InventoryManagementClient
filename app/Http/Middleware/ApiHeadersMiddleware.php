<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class ApiHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = [];
        $data['accessToken'] = request()->cookie('accessToken');
        $data['client'] = new Client(['base_uri' => 'http://localhost/laravelInventoryApi/public/api/v1/']);
        $data['CustomHeaders'] = [
            'Accept' => 'Application/json',
            'Authorization' => $data['accessToken'],
        ];
        $request->merge(array(
            "client" => $data['client'],
            "CustomHeaders" => $data['CustomHeaders']));
        return $next($request);
    }
}
