<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
//use App\Http\Controllers\sections;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use App\Models\sections;
use App\Models\User;
use App\Notifications\AddInvoice;
use App\Notifications\add_invoice_new;
use App\Exports\InvoicesExport;


use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $invoices= invoices::all();
        return view('invoic.invoice' ,compact('invoices'));
     /// return 123;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sections = sections::all();
        return view('invoic.add_invoice' , compact('sections'));
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
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }


            // $user = User::first();
            // Notification::send($user, new AddInvoice( $invoice_id));

        // $user = User::get();
        // $invoices = invoices::latest()->first();
        // Notification::send($user, new \App\Notifications\Add_invoice_new($invoices));

        // event(new MyEventClass('hello world'));
       // $user = User::get();   
       $user = User::find(Auth::user()->id); 
        $invoice_id = invoices::latest()->first();
         //$user = User::first();
        Notification::send($user, new Add_invoice_new( $invoice_id));
        //$user->notify(new \App\Notifications\add_invoice_new($invoice_id));
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
       // return back();
       return redirect('/invoices');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo "hhhhhhhhhhhhhhhhhh";
        $invoices= invoices::where('id',$id)->first();
        $sections= sections::all();
        return view('invoic.edit_invoce',compact('invoices' ,'sections'));
    }
    

    public function updat($id)
    {
        //echo "hhhhhhhhhhhhhhhhhh";
         $invoices= invoices::where('id',$id)->first();
         $invoices_details= invoices_details::all();
         return view('invoic.updat_invoce',compact('invoices' ,'invoices_details'));
    }


    public function up_status($id ,Request  $request)
    {

       // echo "hhhhhhhhhhhhhhhh";
       $invoices = invoices::findOrFail($id);
       if($request->Status ==='مدفوعة')
       {
        $invoices->update([
          
            'Status' => $request->Status,
            'Value_Status' => 1,
            'Payment_Date' => $request->Payment_Date,
        ]);
        
        invoices_Details::create([
            'id_Invoice' => $request->id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => $request->Status,
            'Value_Status' => 1,
            'note' => $request->note,
            'Payment_Date' => $request->Payment_Date,
            'user' => (Auth::user()->name),
        ]);
         }

         else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoices_Details::create([
                
                'invoice_number' => $request->invoice_number,
                'id_Invoice' => $request->id_Invoice,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('edit', 'تم تحديث حالة الدفع  بنجاح');
        return back();
         
       }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 
        $invoices = invoices::findOrFail($request->id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //echo "hiikkkkkkkkkkk2";

        $invoice_id = $request->invoice_id;
       // invoices::findorfail($invoice_id)->delete();
      $invoices= invoices::where('id',$invoice_id)->first();

      $attachm=invoices_attachments::where('invoice_id',$invoice_id)->first();

       
      //$invoices->forceDelete(); // delete in database

      $pageid=$request->page_id;
      if($pageid==2)
      {

     
         $invoices->Delete(); 
         session()->flash('delete','تم الارشفة بنجاح');
         return  redirect('/archives'); 
        }
        else
        {
        if(!empty($attachm->invoice_number))
        {
         //storage::disk('public_uploads')->delete($attachm->invoice_number .'/'.  $attachm->file_name);
         storage::disk('public_uploads')->deleteDirectory($attachm->invoice_number);
        }
        $invoices->forceDelete(); 
         session()->flash('delete','تم حذف الفاتورة بنجاح');
         return redirect('/invoices');
     
    }

    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    public function paid()
    {
       $invoices=invoices::where('Value_Status',1)->get();
       return view('invoic.paided_inv', compact('invoices'));
    }

    public function unpaid()
    {
       $invoices=invoices::where('Value_Status',2)->get();
       return view('invoic.unpaided_inv', compact('invoices'));
    }

    public function partlypaid()
    {
       $invoices=invoices::where('Value_Status',3)->get();
       return view('invoic.partly_paid', compact('invoices'));
    }


    public function printinvoice($id)
    {

        //echo "hiiiiiiiiiiiiiiiiihhhhhhh";
        $invoices1= invoices::where('id',$id)->first();
        $invoices2= invoices_details::where('id_Invoice',$id)->get();
        return view('invoic.invoiceprint',compact('invoices1','invoices2'));
    }


    public function export() 
    {
       // echo "ggggggggg";
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
        //return \Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }
}
