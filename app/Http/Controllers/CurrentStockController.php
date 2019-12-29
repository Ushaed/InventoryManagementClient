<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CurrentStockController extends Controller
{
    public function index()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'stock', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('stock.index', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function check($product_id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'stock/check/'. $product_id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return response()->json($data);
        } catch (RequestException $exception) {
            return $this->ajaxResponse($exception);
        }
    }
}
