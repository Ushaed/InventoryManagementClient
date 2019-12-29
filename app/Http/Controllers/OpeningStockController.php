<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class OpeningStockController extends Controller
{
    public function index()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'opening-stock', [
                'headers' => $header,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
//            dd($data);
            return view('openingStock.create',compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function store(Request $request)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'opening-stock', [
                'headers' => $header,
                'form_params' => [
                    'product_id' => $request->input('opening_product_id'),
                    'quantity' => $request->input('opening_quantity'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
//            dd($data);
            return redirect()->route('opening.stock.index')->with('message',$data['message']);
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }
}
