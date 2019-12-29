<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'sales', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('sale.index', compact('data'));
        } catch (RequestException $exception) {
           return $this->exceptionResponse($exception);
        }
    }

    public function create()
    {
        return view('sale.create');
    }
    public function store(Request $request)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('POST', 'sales', [
                'headers' => $header,
                'form_params' => [
                    'customer_name' => $request->input('customer_name'),
                    'customer_phone' => $request->input('customer_phone'),
                    'product_id' => $request->input('sales_product_id'),
                    'price' => $request->input('sales_price'),
                    'quantity' => $request->input('sales_quantity'),
                    'subtotal' => $request->input('subtotal_value'),
                    'gross_total' => $request->input('gross_amount_value'),
                    'discount' => $request->input('discount'),
                    'net_total' => $request->input('net_amount_value'),
                    'remarks' => $request->input('remarks')
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('sales.edit',$data['sale_product']['id'])->with(['type' => 'success', 'message' => $data['message']]);
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
            $request = $client->request('GET', 'sales/'.$id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return view('sale.show', compact('data'));
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
            $request = $client->request('GET', 'sales/'.$id .'/edit', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            if ($data['sales']['status'] == 2){
                return redirect()->back()->with(['type'=>'error','message'=>'Sale already been updated']);
            }
            return view('sale.edit', compact('data'));
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
            $request = $client->request('PUT', 'sales/'.$id, [
                'headers' => $header,
                'form_params' => [
                    'customer_name' => $request->input('customer_name'),
                    'customer_phone' => $request->input('customer_phone'),
                    'product_id' => $request->input('sales_product_id'),
                    'price' => $request->input('sales_price'),
                    'quantity' => $request->input('sales_quantity'),
                    'subtotal' => $request->input('subtotal_value'),
                    'gross_total' => $request->input('gross_amount_value'),
                    'discount' => $request->input('discount'),
                    'net_total' => $request->input('net_amount_value'),
                    'remarks' => $request->input('remarks'),
                    'status' => $request->input('status'),
                ]
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('sales.index')->with(['type' => 'success', 'message' => $data['message']]);
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
            $request = $client->request('DELETE', 'sales/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect()->route('sales.index')->with(['type'=>'error','message'=>$data['message']]);
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
