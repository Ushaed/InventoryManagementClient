<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function exceptionResponse($exception){
        $response = $exception->getResponse();
        $responseBody = $response->getBody()->getContents();
        $errors = json_decode($responseBody, true);
//        dd($errors);
        return redirect()->back()->with(['type'=>'error','message'=>$errors['message']]);
    }
    protected function errorResponse($exception){
        $response = $exception->getResponse();
        $responseBody = $response->getBody()->getContents();
        $errors = json_decode($responseBody, true);
//        dd($errors);
        return redirect()->back()->withErrors($errors['message'])->withInput();
    }
    protected function ajaxResponse($exception){
        $response = $exception->getResponse();
        $responseBody = $response->getBody()->getContents();
        $errors = json_decode($responseBody, true);
//        dd($errors);
        return response()->json($errors);
    }

}
