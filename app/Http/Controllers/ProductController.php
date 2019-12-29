<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'products', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('product.index', compact('data'));
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'products/create', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('product.create', compact('data'));
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }

    public function store(Request $request)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'products', [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'brand_id' => $request->input('brand_id'),
                    'buy_price' => $request->input('buy_price'),
                    'sell_price' => $request->input('sell_price'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
//            dd($data);
            return redirect()->route('products.index')->with(['message' => $data['message'], 'type' => 'success']);
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
            $request = $client->request('GET', 'products/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('product.show', compact('data'));
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
            $request = $client->request('GET', 'products/' . $id . '/edit', [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('product.edit', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($headers);
        }
    }

    public function update(Request $request, $id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('PUT', 'products/' . $id, [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'brand_id' => $request->input('brand_id'),
                    'status' => $request->input('status'),
                    'buy_price' => $request->input('buy_price'),
                    'sell_price' => $request->input('sell_price'),
                    'description' => $request->input('description')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('products.index')->with(['message' => $data['message'], 'type' => 'success']);
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
            $request = $client->request('DELETE', 'products/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('products.index')->with(['message' => $data['message'], 'type' => 'error']);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }



    public function restore($id)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'products/restore/' . $id, [
                'headers' => $headers
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('products.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function search($query)
    {
        $headers = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'products/search/' . $query, [
                'headers' => $headers,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return response()->json($data);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $errors = json_decode($responseBody, true);
            return response()->json($errors);
        }
    }
}
