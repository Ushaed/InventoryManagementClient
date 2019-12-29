<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'users', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('user.index', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'users', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'user_type' => $request->input('user_type'),
                    'password' => $request->input('password'),
                    'password_confirmation' => $request->input('password_confirmation'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('users.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }

    public function show($id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'users/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
//            dd($data);
            return view('user.show', compact('data'));
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }

    public function edit($id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'users/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('user.edit', compact('data'));
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }

    public function update(Request $request, $id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('PUT', 'users/' . $id, [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'user_type'=>$request->input('user_type'),
                    'password' => $request->input('password'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('users.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }

    public function delete($id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('DELETE', 'users/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('users.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
