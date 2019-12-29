<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily(Request $request)
    {

        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        $daily_total = 0;
        try {
            $date = '';
            if($request->date){
                $date = date('Y-m-d', strtotime($request->date));
                $request = $client->request('GET', 'reports/daily/'. $date,  [
                    'headers' => $header,
                    'form-params'=>[
                        'date'=>$date
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
                foreach ($data['daily_sales_reports'] as $key => $value){
                    $daily_total += $value['net_total'];
                }
                $data['total_daily_sale'] = $daily_total;
                return view('report.daily', compact('data'));
            }
            $request = $client->request('GET', 'reports/daily', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            foreach ($data['daily_sales_reports'] as $key => $value){
                $daily_total += $value['net_total'];
            }
            $data['total_daily_sale'] = $daily_total;
            return view('report.daily', compact('data'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
    public function monthly(Request $request)
    {

        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $month = '';
            $year = '';
            if ($request->month && $request->year){
                $request = $client->request('GET', 'reports/monthly/'. $request->month.'/'.$request->year, [
                    'headers' => $header,
                    'form-params'=>[
                        'month'=>$request->month,
                        'year'=>$request->year
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
                $first_day = date("Y-m-01",strtotime($data['date']));
                $first_day_of_next_date = date('Y-m-d', strtotime('+1 month', strtotime($first_day)));
                $current_date = date("Y-m-d",strtotime($data['date']));
                $monthly_total = 0;
                $datediff = strtotime($first_day_of_next_date) - strtotime($first_day);
                $datediff = floor($datediff/(60*60*24));
                $monthly_report = [];
                for($i = 0; $i < $datediff ; $i++) {
                    $count = 0;
                    $daily_total = 0;
                    $sell_details = [];
                    $date = date("Y-m-d", strtotime($first_day . ' + ' . $i . 'day'));
                    foreach ($data['daily_sales_reports'] as $key => $value) {
                        if ($date == date("Y-m-d", strtotime($value['updated_at']))) {
                            $count++;
                            $daily_total += $value['net_total'];
                            $sell_details[] = $value;
                        }

                    }
                    $monthly_report['daily'][$i] = array(
                        'date'=>$date,
                        'count'=>$count,
                        'daily_total'=>$daily_total,
                        'details'=>$sell_details
                    );
                }
                foreach($monthly_report['daily'] as $key => $value){
                    $monthly_total += $value['daily_total'];
                }
                $monthly_report['monthly_total'] = $monthly_total;
                $monthly_report['date'] = $data['date'];
                $monthly_report['success'] = true;
                $monthly_report['message'] = $data['message'];
//            dd($monthly_report);
//            dd($monthly_report['daily']['details']);
                return view('report.monthly', compact('monthly_report'));
            }
            $request = $client->request('GET', 'reports/monthly', [
                'headers' => $header
            ]);
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            $first_day = date("Y-m-01",strtotime($data['date']));
            $first_day_of_next_date = date('Y-m-d', strtotime('+1 month', strtotime($first_day)));
            $current_date = date("Y-m-d",strtotime($data['date']));
            $monthly_total = 0;
            $datediff = strtotime($current_date) - strtotime($first_day);
            $datediff = floor($datediff/(60*60*24));
            $monthly_report = [];
            for($i = 0; $i < $datediff +1 ; $i++) {
                $count = 0;
                $daily_total = 0;
                $sell_details = [];
                $date = date("Y-m-d", strtotime($first_day . ' + ' . $i . 'day'));
                foreach ($data['daily_sales_reports'] as $key => $value) {
                    if ($date == date("Y-m-d", strtotime($value['updated_at']))) {
                        $count++;
                        $daily_total += $value['net_total'];
                        $sell_details[] = $value;
                    }

                }
                $monthly_report['daily'][$i] = array(
                    'date'=>$date,
                    'count'=>$count,
                    'daily_total'=>$daily_total,
                    'details'=>$sell_details
                );
            }
            foreach($monthly_report['daily'] as $key => $value){
                $monthly_total += $value['daily_total'];
            }
            $monthly_report['monthly_total'] = $monthly_total;
            $monthly_report['date'] = $data['date'];
            $monthly_report['success'] = true;
            $monthly_report['message'] = $data['message'];
//            dd($monthly_report);
//            dd($monthly_report['daily']['details']);
            return view('report.monthly', compact('monthly_report'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
    public function yearly(Request $request)
    {
        $header = request()->CustomHeaders;
        $base_uri = request()->base_uri;
        $client = new Client(['base_uri' => $base_uri]);
        try {
            $year = '';
            if ($request->year) {
                $request = $client->request('GET', 'reports/yearly/' . $request->year, [
                    'headers' => $header,
                    'form-params' => [
                        'year' => $request->year
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
                $current_month = date('m',strtotime($data['date']));
                $yearly_report = [];
                for ($i = 1; $i <=12;$i++){
                    $count = 0;
                    $total_month = 0;
                    $sell_details = [];
                    foreach ($data['yearly_sales_reports'] as $key => $value) {
                        if ($i == date("m", strtotime($value['updated_at']))) {
                            $count++;
                            $total_month += $value['net_total'];
                            $sell_details[] = $value;
                        }
                    }
                    $yearly_report['monthly'][$i] = array(
                        'month' => $i,
                        'count' => $count,
                        'total_month'=>$total_month,
                        'details' => $sell_details
                    );


                }
                $yearly_report['date'] = $data['date'];
                $yearly_report['success'] = true;
                $yearly_report['message'] = $data['message'];
//                dd($yearly_report);
                return view('report.yearly', compact('yearly_report'));
            }else{
                $request = $client->request('GET', 'reports/yearly', [
                    'headers' => $header
                ]);
            }

            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            $current_month = date('m',strtotime($data['date']));
            $yearly_report = [];
            for ($i = 1; $i <=$current_month;$i++){
                $count = 0;
                $total_month = 0;
                $sell_details = [];
                    foreach ($data['yearly_sales_reports'] as $key => $value) {
                        if ($i == date("m", strtotime($value['updated_at']))) {
                            $count++;
                            $total_month += $value['net_total'];
                            $sell_details[] = $value;
                        }
                    }
                $yearly_report['monthly'][$i] = array(
                    'month' => $i,
                    'count' => $count,
                    'total_month'=>$total_month,
                    'details' => $sell_details
                );


            }
            $yearly_report['date'] = $data['date'];
            $yearly_report['success'] = true;
            $yearly_report['message'] = $data['message'];
//            dd($yearly_report);
            return view('report.yearly', compact('yearly_report'));
        } catch (RequestException $exception) {
            return $this->exceptionResponse($exception);
        }
    }

}
//Start Date
//$date = '2009-12-06';
//End date
//$end_date = '2020-12-31';
//while (strtotime($first_day_of_year) <= strtotime($lastDateOfMonth)) {
//    echo "$first_day_of_year\n";
//    $first_day_of_year = date ("Y-m-d", strtotime("+1 day", strtotime($first_day_of_year)));
//}
