<?php

namespace App\Http\Controllers;

use App\Models\invoices_archives;
use App\Models\invoices;
use Illuminate\Http\Request;

class InvoicesArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
       $archive=invoices::onlyTrashed()->get();
       return view('invoic.archives',compact('archive'));
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
     * @param  \App\Models\invoices_archives  $invoices_archives
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_archives $invoices_archives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_archives  $invoices_archives
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_archives $invoices_archives)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_archives  $invoices_archives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       $archiv= $request->invoice_id;
       invoices::withTrashed()->where('id',$archiv)->restore();
       session()->flash('delete','تم الارشفة بنجاح');
         return  redirect('/invoices'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_archives  $invoices_archives
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $archiv_id =$request->invoice_id;
        $archive=invoices::withTrashed()->where('id',$archiv_id)->first();
        $archive->forceDelete();
        session()->flash('delete','تم الارشفة بنجاح');
         return  redirect('/archives'); 
        

    }
}
