<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ProductPropertyItems::all();
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $products = Product::all();
        return view('products.index', compact('products', 'type', 'priority', 'help_desk', 'user','items'));
    }


    public function checkbox(Request $request, $id)
    {
        $checkbox = Product::find($id);
        $checkbox->hp_statuse = $request->checkbox;
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
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.create', compact('type', 'help_desk', 'priority', 'color', 'items', 'properties', 'user'));
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
        $product->hp_product_image = $request->product_image;
        $product->save();

        return json_encode(["response" => "OK"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $items = ProductPropertyItems::all();
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $product = Product::find($id);
        return view('products.edit', compact('product', 'type', 'priority', 'help_desk', 'user', 'items', 'color', 'properties'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_model' => 'required',
            'product_price' => 'required',
            'hp_description' => 'required',
        ]);
        $product = Product::find($id);
        $product->hp_product_name = $request->product_name;
        $product->hp_product_model = $request->product_model;
        $product->hp_product_price = $request->product_price;
        $product->hp_description = $request->hp_description;
        $product->hp_product_property = $request->hp_product_property;
        $product->hp_product_color_id = $request->hp_product_color_id;
        $product->hp_product_size = $request->hp_product_size;
        $product->hp_product_image = $request->product_image;
        $product->save();
        return json_encode(["response" => "OK"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
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
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

    public function upload(Request $request)
    {
        $image = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($image)) {
//            $current_date = Carbon::now()->todatestring();
//          $image_name = $current_date . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('img/products')) {
                mkdir('img/products', 0777, true);
            }
            $image->move('img/products', $filename);
        } else {
            $image_name = 'default.png';
        }

        return response()->json([
            'link' => '/img/products/' . $filename
        ]);
    }

    public function fill_data_product_color(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $product_color = ProductColor::select('hn_color_name as text', 'id')->where('hn_color_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $product_color]);
    }

    public function fill_data_product_item(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $product_item = ProductPropertyItems::select('hppi_items_name as text', 'id')->where('hppi_items_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $product_item]);
    }

    public function fill_data_product_property(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $product_property = DB::table('hnt_product_property')
                ->join('hnt_product_property_items', 'hnt_product_property.hpp_property_items', 'hnt_product_property_items.id')
                ->select('hnt_product_property.id','hnt_product_property.hpp_property_name as text','hnt_product_property_items.hppi_items_name')
                ->where('hnt_product_property.hpp_property_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $product_property]);
    }
}
