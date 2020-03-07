<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $products = Product::all();
        return view('products.index',compact('products','type','priority','help_desk','user'));
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
        $items = ProductPropertyItems::all();
        $user=User::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('products.create',compact('type','help_desk','priority','color','items','properties','user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_model' => 'required',
            'product_price' => 'required',
            'hp_description' => 'required',
            'hp_product_size' => 'required',
            'hp_product_color_id' => 'required',
        ]);
        $product = new Product();
        $product->hp_product_name = $request->product_name;
        $product->hp_product_model = $request->product_model;
        $product->hp_product_price = $request->product_price;
        $product->hp_product_property = $request->hp_product_property;
        $product->hp_product_color_id = $request->hp_product_color_id;
        $product->hp_description = $request->hp_description;
        $product->hp_product_size = $request->hp_product_size;
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
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $items = ProductPropertyItems::all();
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $product=Product::find($id);
        return view('products.edit',compact('product','type','priority','help_desk','user','items','color','properties'));


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
        $product->hp_product_property = $request->hp_product_property;
        $product->hp_product_color_id = $request->hp_product_color_id;
        $product->hp_product_size = $request->hp_product_size;
        $product->save();
        return redirect()->back();

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

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
