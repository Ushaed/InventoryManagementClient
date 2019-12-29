<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printPurchase($id)
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
            $Companyrequest = $client->request('GET', 'companies', [
                'headers' => $header,
            ]);
            $Companyresponse = $Companyrequest->getBody()->getContents();
            $company = json_decode($Companyresponse, true);
            return view('print.purchase', compact('data','company'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
    public function printSale($id)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $request = $client->request('GET', 'sales/' . $id, [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            $Companyrequest = $client->request('GET', 'companies', [
                'headers' => $header,
            ]);
            $Companyresponse = $Companyrequest->getBody()->getContents();
            $company = json_decode($Companyresponse, true);
            return view('print.sale', compact('data','company'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
