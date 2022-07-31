<?php

namespace App\Http\Controllers;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use App\Models\invoices;
class CustomerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $section= sections::all();
        return view ('reports.customer_rep',compact('section'));
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

                  if ( $request->start_at=='' && $request->end_at=='')
                 {
                    $invoices=invoices::select('*')->where('section_id','=',$request->Section)->where('product' ,'=',$request->product)->get();
                    $section= sections::all();
                    return view('reports.customer_rep' ,compact('section'))->withdetails($invoices);
                   

                 }
                 else{
                 //// $st_date = date($request->start_at);
                   /////////$en_date= date($request->end_at);
                  
                   $invoices=invoices::wherebetween('invoice_Date',[  date($request->start_at) ,date($request->end_at)])->where('section_id','=',$request->Section)
                   ->where('product' ,'=',$request->product)->get();

                   $section= sections::all();
                   return view('reports.customer_rep' ,compact('st_date','en_date','section'))->withdetails($invoices);
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
