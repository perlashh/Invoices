<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total_invoice=number_format(invoices::sum('Total'),2);
        $total_count=invoices::count();


        $unpaid_invoice=number_format(invoices::where('Value_Status','=',2)->sum('Total'),2);
        $unpaid_count=invoices::where('Value_Status','=',2)->count();
          
     $paid_invoice=number_format(invoices::where('Value_Status','=',1)->sum('Total'),2);
     $paid_count=invoices::where('Value_Status','=',1)->count();
 
     $partlypaid_invoice=number_format(invoices::where('Value_Status','=',3)->sum('Total'),2);
     $partlypaid_count= invoices::where('Value_Status','=',3)->count();
 
        // ExampleController.php
      // $inv1 = $unpaid_count/$total_count*100;
      // $inv2=$paid_count/$total_count*100;
      // $inv3=$partlypaid_count/$total_count*100;

      if($unpaid_count==0)
      {
        $inv1 =0;
      }
      else
      {
        $inv1 = $unpaid_count/$total_count*100;
      }
      if($paid_count==0)
      {
        $inv2 =0;
      }
      else
      {
        $inv2 = $paid_count/$total_count*100;
      }
      if($partlypaid_count==0)
      {
        $inv3 =0;
      }
      else
      {
        $inv3 = $partlypaid_count/$total_count*100;
      }

$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 350, 'height' => 200])
         ->labels(['الفواتير المدفوعة جزئيا', 'الفواتير المدفوعة', 'الفواتير الغير مدفوعة'])
         ->datasets([
             [
                 "label" => "الفواتير الغير مدفوعة",
                 'backgroundColor' => ['#ec5858'],
                
                  'data' => [$inv1]
               
             ],
             [
                 "label" => "نسبة الفواتير المدفوعة",
                 'backgroundColor' => ['#81b214'],
                  'data' => [$inv2]
                //'data' => [80]
             ],

             [
                "label" => "الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['#ff9642'],
                'data' =>  [$inv3]
            ],
         ])
         ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => [
                    'fontColor' => '#000'
                ]
            ]
        ]);

        $chartjs1 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير المدفوعة جزئيا', 'الفواتير المدفوعة', 'الفواتير الغير مدفوعة'])
        ->datasets([
            [
                'backgroundColor' => ['#ff9642', '#81b214' ,'#ec5858'],
                //'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$inv3, $inv2,$inv1]
            ]
        ])
        ->options([]);


        return view('home' ,compact('total_invoice','total_count','unpaid_invoice','unpaid_count' ,'paid_invoice','paid_count',
    'partlypaid_invoice','partlypaid_count','inv1','inv2','inv3','chartjs','chartjs1'));
    }
}
