<?php

namespace App\Http\Controllers;

use App\Part;
use App\Product;
use App\ProductPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    public function index()
    {
        $product=Product::all();
        $product_part=ProductPart::all();
        $part = Part::all();
        return view('part.index',compact('part','product','product_part'));
//        $select_product_part = DB::select('select count')
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Part::find($id);
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
        return view('part.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_code' => 'required',
            'hp_part_model' => 'required',
            'hp_provider' => 'required',
            'hp_category_id' => 'required',
//            'hp_produce_date' => 'required',
        ]);
        $part = new Part();
        $part->hp_name = $request->hp_name;
        $part->hp_code = $request->hp_code;
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_provider = $request->hp_provider;
        $part->hp_category_id = $request->hp_category_id;
//        $part->hp_produce_date = new Date();
        $part->save();

        return json_encode(["response"=>"OK"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $part=Part::find($id);
        return view('part.edit',compact('part'));


    }


    public function show(){

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
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_code' => 'required',
            'hp_part_model' => 'required',
            'hp_provider' => 'required',
            'hp_category_id' => 'required',
            'hp_produce_date' => 'required',
        ]);
        $part =Part::find($id);
        $part->hp_name = $request->hp_name;
        $part->hp_code = $request->hp_code;
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_provider = $request->hp_provider;
        $part->hp_category_id = $request->hp_category_id;
        $part->hp_produce_date = $request->hp_produce_date;
        $part->save();
        return view('part.index',compact('part'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = Part::find($id);
        $part->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
