<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BrandController extends Controller
{
    public function index()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'brands', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('brand.index', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'brands', [
                'headers' => $header,
                'form_params' => [
                    'name' => $request->input('name'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('brands.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }

    public function show($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'brands/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('brand.show', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function edit($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'brands/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('brand.edit', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function update(Request $request, $id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('PUT', 'brands/' . $id, [
                'headers' => $header,
                'form_params' => [
                    'name' => $request->input('name'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('brands.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->errorResponse($exception);
        }

    }

    public function delete($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('DELETE', 'brands/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('brands.index')->with(['type' => 'error', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);

        }
    }
}
