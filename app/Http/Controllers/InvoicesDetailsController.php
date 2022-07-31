<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use Illuminate\Http\Request;
use  App\Models\invoices;
use  App\Models\invoices_attachments;
use Illuminate\Support\Facades\Storage;
class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $invoices1= invoices::where('id',$id)->first();
        $invoice2= invoices_details::where('id_Invoice',$id)->get();
        $invoice3= invoices_attachments::where('invoice_id',$id)->get();
             return view('invoic.invoice_details',compact('invoices1','invoice2','invoice3'));
    }


    public function  editarch($id)
    {
          //echo "hhhhh";
        $invoices1=invoices::onlyTrashed()->where('id',$id)->first();
        $invoice2= invoices_details::where('id_Invoice',$id)->get();
        $invoice3= invoices_attachments::where('invoice_id',$id)->get();
        return view('invoic.invoice_details',compact('invoices1','invoice2','invoice3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
       $attach = invoices_attachments::findorfail($request->id);
       $attach ->delete();
       storage::disk('public_uploads')->delete($request->invoice_number .'/'. $request->file_name);
       session()->flash('delete','تم حذف المرفق بنجاح');
          // return "hihhhhhhhhhhhhhhh";
          return back();
    }

    public function  openfile($invoice_number,$file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
    public function  getfile($invoice_number,$file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($files);
    }
}
