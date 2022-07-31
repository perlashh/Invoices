<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
class InvoiceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
     return view('reports.invoice_rep');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
             if($request->flexRadioDefault=1)
             {
                 if($request->type && $request->start_at=='' && $request->end_at=='')
                 {
                    $invoices=invoices::select('*')->where('Status','=',$request->type)->get();
                    $type=$request->type;
                    return view('reports.invoice_rep' ,compact('type'))->withdetails($invoices);
                   

                 }
                 else{
                  $st_date = date($request->start_at);
                   $en_date= date($request->end_at);
                   $type=$request->type;
                   $invoices=invoices::wherebetween('invoice_Date',[  $st_date , $en_date])->where('Status','=',$request->type)->get();
                   return view('reports.invoice_rep' ,compact('type','st_date','en_date'))->withdetails($invoices);
                 }
             }
             else
             {
                 
                $invoices=invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
               
                return view('reports.invoice_rep')->withdetails($invoices);
             }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
