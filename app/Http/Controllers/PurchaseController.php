<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'purchases', [
                'headers' =>$header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('purchase.index', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'suppliers', [
                'headers' => $header,
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('purchase.create', compact('data'));
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
            $request = $client->request('POST', 'purchases', [
                'headers' => $header,
                'form_params' => [
                    'supplier_id' => $request->input('supplier_id'),
                    'product_id' => $request->input('purchase_product_id'),
                    'price' => $request->input('purchase_price'),
                    'quantity' => $request->input('purchase_quantity'),
                    'subtotal' => $request->input('subtotal_value'),
                    'gross_total' => $request->input('gross_amount_value'),
                    'discount' => $request->input('discount'),
                    'net_total' => $request->input('net_amount_value'),
                    'remarks' => $request->input('remarks')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('purchases.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function show($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'purchases/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('purchase.show', compact('data'));
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
            $request = $client->request('GET', 'purchases/' . $id .'/edit', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            if ($data['purchases']['status'] === 2){
                return redirect()->back()->with(['type'=>'error','message'=>'Purchase already been updated']);
            }
            return view('purchase.edit', compact('data'));
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
            $request = $client->request('PUT', 'purchases/'.$id, [
                'headers' => $header,
                'form_params' => [
                    'supplier_id' => $request->input('supplier_id'),
                    'product_id' => $request->input('purchase_product_id'),
                    'price' => $request->input('purchase_price'),
                    'quantity' => $request->input('purchase_quantity'),
                    'subtotal' => $request->input('subtotal_value'),
                    'gross_total' => $request->input('gross_amount_value'),
                    'discount' => $request->input('discount'),
                    'net_total' => $request->input('net_amount_value'),
                    'remarks' => $request->input('remarks'),
                    'status' => $request->input('status')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('purchases.index')->with(['type' => 'success', 'message' => $data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function delete($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('DELETE', 'purchases/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('purchases.index')->with(['type'=>'error','message'=>$data['message']]);
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }
}
