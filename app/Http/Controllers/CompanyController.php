<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $base_uri = $request->base_uri;
        $headers = $request->CustomHeaders;
        $client = new Client(['base_uri'=>$base_uri]);
        try {
            $request = $client->request('GET', 'companies', [
                'headers' => $headers,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('company.create',compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function update(Request $request)
    {
        $base_uri = $request->base_uri;
        $headers = $request->CustomHeaders;
        $client = new Client(['base_uri'=>$base_uri]);
        try {
            $request = $client->request('PUT', 'companies', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'message' => $request->input('message'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('companies.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }
}
