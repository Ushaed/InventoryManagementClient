<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $client = new Client(['base_uri' => 'http://ushaed.inventoryapi.rmwebdev.com/api/v1/']);
        try {
            $request = $client->request('POST', 'login', [
                'form_params' => [
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            $params = array(
                'accessToken' =>'Bearer ' . $data['access-token'],
                'user_information' => $data['user'],

            );
            $userInfo = $data['user']['id'];
            $userType = $data['user']['user_type'];
            $accessToken = 'Bearer ' . $data['access-token'];
            return response()->redirectToRoute('dashboard')
                ->cookie('accessToken',$accessToken)
                ->cookie('userId',$userInfo)
                ->cookie('userType',$userType)
                ->with('params',$params)
                ->with(['type'=>'success','message'=>'Login Successful']);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $errors = json_decode($responseBody, true);
            return redirect()->back()->withErrors($errors['message'])->withInput($request->only(['email','remember']));
        }
    }

    public function dashboard()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'dashboard', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('admin.dashboard', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }

    }

    public function logout()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'logout', [
                'headers' =>$headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('login')
                ->withCookie(Cookie::forget('accessToken'))
                ->withCookie(Cookie::forget('userId'))
                ->withCookie(Cookie::forget('userType'))
                ->with(['message'=> $data['message'],'type'=>'success']);
        }catch (RequestException $exception){
            return $this->exceptionResponse($exception);
        }

    }

    public function profile()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'profile', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('admin.profile', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }

    }

    public function setting()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'profile', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('admin.setting', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updateSetting(Request $request)
    {
        $accessToken = request()->cookie('accessToken');
        $client = new Client(['base_uri' => 'http://localhost/laravelInventoryApi/public/api/v1/']);
        try {
            $request = $client->request('PUT', 'setting', [
                'headers' => [
                    'Accept' => 'Application/json',
                    'Authorization' => $accessToken,
                ],
                'form_params' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'password' => $request->input('password'),
                    'password_confirmation' => $request->input('password_confirmation'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
//            dd($data);
            return redirect()->route('profile')->with(['type'=>'success','message'=> $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }
}
