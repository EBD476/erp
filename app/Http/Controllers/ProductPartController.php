<?php

namespace App\Http\Controllers;

use App\Part;
use App\Product;
use App\ProductPart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
class ProductPartController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $product=Product::ALL();
        $part=Part::ALL();
        $product_part = ProductPart::all();
        return view('product_part.index',compact('product_part','product','part','type','priority','help_desk','user'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=ProductPart::find($id);
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
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $part_id=Part::all();
        $product_id=Product::all();
        return view('product_part.create',compact('part_id','product_id','type','priority','help_desk','user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpp_part_id' => 'required',
            'hpp_product_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = new ProductPart();
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();

        return json_encode(["response" => "OK"]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $part_id=Part::all();
        $product_id=Product::all();
        $product_part=ProductPart::find($id);
        return view('product_part.edit',compact('product_part','part_id','product_id','type','priority','help_desk','user'));


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
            'hpp_part_id' => 'required',
            'hpp_product_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part =ProductPart::find($id);
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();
        return view('product_part.index',compact('product_part'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_part = ProductPart::find($id);
        $product_part->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
