<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $products = Product::all();
        return view('products.index',compact('products'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Product::find($id);
        $checkbox->hp_statuse=$request->checkbox;
        $checkbox->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_model' => 'required',
            'product_price' => 'required',
            'hp_description' => 'required',
        ]);
        $product = new Product();
        $product->hp_product_name = $request->product_name;
        $product->hp_product_model = $request->product_model;
        $product->hp_product_price = $request->product_price;
        $product->hp_description = $request->hp_description;
        $product->save();

        return json_encode(["response"=>"OK"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $product=Product::find($id);
        return view('products.edit',compact('product'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $products=Product::ALL();
        $this->validate($request, [
            'product_name' => 'required',
            'product_model' => 'required',
            'product_price' => 'required',
            'hp_description' => 'required',
        ]);
        $product =Product::find($id);
        $product->hp_product_name = $request->product_name;
        $product->hp_product_model = $request->product_model;
        $product->hp_product_price = $request->product_price;
        $product->hp_description = $request->hp_description;
        $product->save();
        return view('products.index',compact('products'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
