<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\sections;
use Illuminate\Support\Facades\Auth;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=sections::all();
        $products = products::all();

        return view('products.products',compact('sections','products'));
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
          $validated = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'description' => 'required',
            'section_id' => 'required',
        ],[
          'product_name.required' => 'يرجى ادخال اسم المنتج',
           'product_name.unique' => 'اسم المنتج مسجل مسبقا',
           'description.required' => 'يرجى ادخال البيان',
           'section_id'.'required' =>  'يرجى ادخال اسم القسم' ,
           
         ]);

       
        products::create([
                'product_name'=> $request->product_name,
                'section_id' => $request->section_id,
            'description'=> $request->description,
            
            'created_by'=> (Auth::user()->name),
           
            
        ]);
       
        session()->flash('Add' ,'تم اضافة المنتج بنجاح');
        return redirect('/productss');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) ///, products $products)
    {
        //
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $products = products::findOrFail($request->product_id);
 
        $products->update([
        'product_name' => $request->product_name,
        'section_id' => $id,
        'description' => $request->description,
       
        ]);
 
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        //return back();
        return redirect('/productss');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $product_id = $request->product_id;
         products::findorfail($product_id)->delete();
         session()->flash('delete','تم حذف المنتج بنجاح');
         return redirect('/productss');
       // echo "lllll";

     }
}
