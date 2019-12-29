<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SupplierController extends Controller
{
    public function index()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'suppliers', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('supplier.index', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'suppliers', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('suppliers.index')->with(['type' => 'success', 'message' => $data['message']]);
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
            $request = $client->request('GET', 'suppliers/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('supplier.show', compact('data'));
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
            $request = $client->request('GET', 'suppliers/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('supplier.edit', compact('data'));
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
            $request = $client->request('PUT', 'suppliers/' . $id, [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('suppliers.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
           return $this->errorResponse($exception);
        }

    }

    public function storeAjax(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'suppliers', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            $request2 = $client->request('GET', 'suppliers', [
                'headers' => $headers
            ]);
            $allSupplier = $request2->getBody()->getContents();
            $alldata = json_decode($allSupplier, true);
            return response()->json(['data' => $data, 'alldata' => $alldata]);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $errors = json_decode($responseBody, true);
            return response()->json($errors);
        }
    }

    public function emailexist(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'suppliers/emailexist/'.$request->email, [
                'headers' => $headers,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return response()->json($data);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $errors = json_decode($responseBody, true);
            return redirect()->json($errors);
        }

    }
    public function phoneexist(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'suppliers/phoneexist/'.$request->phone, [
                'headers' => $headers,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return response()->json($data);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $errors = json_decode($responseBody, true);
            return redirect()->json($errors);
        }

    }
}
