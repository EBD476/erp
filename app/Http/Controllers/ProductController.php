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
use phpDocumentor\Reflection\Types\Null_;

class ProductController extends Controller
{

    public function index()
    {
        $status =DB::table('hnt_product_status_create_serial_number')->select('hpscsn_activation')->get()->last();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.index', compact('type','status', 'priority', 'help_desk', 'user'));
    }

    public function product_price_index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('finance.product_price.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function checkbox(Request $request, $id)
    {
        $checkbox = Product::find($id);
        $checkbox->hp_status = $request->hp_status;
        $checkbox->save();
        return json_encode(["response" => "OK"]);
    }

    public function product_price(Request $request, $id)
    {
        $product_price = Product::find($id);
        $product_price->hp_product_price = $request->hp_product_price;
        $product_price->save();
        return json_encode(["response" => "OK"]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_product_name' => 'required',
            'hp_product_model' => 'required',
            'hp_description' => 'required',
        ]);
        $product = new Product();
        $product->hp_product_name = $request->hp_product_name;
        $product->hp_product_model = $request->hp_product_model;
        $product->hp_product_property = $request->hp_product_property;
        $product->hp_product_color_id = $request->hp_product_color_id;
        $product->hp_description = $request->hp_description;
        $product->hp_product_size = $request->hp_product_size;
        $product->hp_product_image = $request->product_image;
        $product->hp_voltage = $request->hp_voltage;
        if($request->hp_part_number != ""){
            $product->hp_part_number = $request->hp_part_number;
        }else{

        }
        if($request->hp_serial_number != ""){
            $product->hp_serial_number = $request->hp_serial_number;
        }else{

        }
        $product->hp_status = 1;
        $product->save();

        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hp_product_name' => 'required',
            'hp_product_model' => 'required',
            'hp_description' => 'required',
        ]);
        $product = Product::find($id);
        $product->hp_product_name = $request->hp_product_name;
        $product->hp_product_model = $request->hp_product_model;
        $product->hp_description = $request->hp_description;
        $product->hp_product_property = $request->hp_product_property;
        $product->hp_product_color_id = $request->hp_product_color_id;
        $product->hp_product_size = $request->hp_product_size;
        if ($request->product_image1 != "") {
            $product->hp_product_image = $request->product_image1;
        }
        $product->hp_voltage = $request->hp_voltage;
        $product->hp_status = 1;
        $product->save();
        return json_encode(["response" => "OK"]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $filename = "img/products/" . $product->hp_product_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }

    }

    public function destroy_image($id)
    {
        $product = Product::find($id);
        $filename = "img/products/" . $product->hp_product_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }

    }

    public function upload(Request $request)
    {
        $image = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($image)) {

            $current_date = Carbon::now();
            $image_name = $current_date . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('img/products')) {
                mkdir('img/products', 0777, true);
            }
            $image->move('img/products', $filename);
        } else {
            $image_name = 'default.png';
        }

        return response()->json(['link' => '/img/products/' . $filename]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_description', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_products.hp_status', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number')
                ->where('hnt_products.deleted_at', '=', Null)
                ->skip($start)->take($length)->get();
//            $product = Product::onlyTrashed()->get();
//            $product = Product::withTrashed()->get();

        } else {
            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_description', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_products.hp_status', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number')
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_products.hp_product_model', 'LIKE', "%$search%")
                ->orwhere('hnt_product_color.hn_color_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product as $products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $products->hp_serial_number . '",' . '"' . $products->hp_product_name . '",' . '"' . $products->hp_product_model . '",' . '"' . $products->hpp_property_name . '",' . '"' . $products->hn_color_name . '",' . '"' . $products->hp_voltage . '",' . '"' . $products->hp_product_size . '",' . '"' . $products->hp_product_property . '",' . '"' . $products->hp_product_color_id . '",' . '"' . $products->hp_description . '",' . '"' . $products->hp_product_image . '",' . '"' . $products->hp_status . '",' . '"' . $products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $products_count = Product::all()->count();
        return response('{ "recordsTotal":' . $products_count . ',"recordsFiltered":' . $products_count . ',"data": [' . $data . ']}');
    }

    public function fill_product_price(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_description', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_products.hp_status', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_products.hp_product_price')
                ->where('hnt_products.deleted_at', '=', Null)
                ->skip($start)->take($length)->get();

        } else {
            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_description', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_products.hp_status', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_products.hp_product_price')
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_products.hp_product_model', 'LIKE', "%$search%")
                ->orwhere('hnt_product_color.hn_color_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product as $products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $products->hp_serial_number . '",' . '"' . $products->hp_product_name . '",' . '"' . $products->hp_product_model . '",' . '"' . $products->hpp_property_name . '",' . '"' . $products->hn_color_name . '",' . '"' . $products->hp_voltage . '",' . '"' . $products->hp_product_size . '",' . '"' . $products->hp_product_price . '",' . '"' . $products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $products_count = Product::all()->count();
        return response('{ "recordsTotal":' . $products_count . ',"recordsFiltered":' . $products_count . ',"data": [' . $data . ']}');
    }

//    fill select to
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
                ->select('hnt_product_property.id', 'hnt_product_property.hpp_property_name as text', 'hnt_product_property_items.hppi_items_name')
                ->where('hnt_product_property.deleted_at', '=', Null)
                ->where('hnt_product_property.hpp_property_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $product_property]);
    }

//    end filling

    public function activation_create_serial_number_index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $status =DB::table('hnt_product_status_create_serial_number')->select('id','hpscsn_status','hpscsn_activation')->get();
        return view('activation_create_serial_number.index', compact('status','type', 'priority', 'help_desk', 'user'));
    }
    public function activation_create_serial_number_status(Request $request)
    {
        DB::table('hnt_product_status_create_serial_number')->where('hpscsn_status',$request->hp_status)->update(['hpscsn_activation'=>$request->hp_status_activation]);
        return json_encode(["response" => "OK"]);
    }
}
