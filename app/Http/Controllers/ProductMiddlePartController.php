<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\Part;
use App\Product;
use App\ProductMiddlePart;
use App\ProductPart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class ProductMiddlePartController extends Controller
{
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $product_part = ProductMiddlePart::select('id','hpp_product_id','hpp_middle_part_id')->get();
//        foreach ($product_part as $counter) {
//            $product = Product::select('hp_product_name','id')->where('id', $counter->hpp_product_id)->get();
//        }
        $product=Product::all();
        foreach ($product_part as $counter) {
            $middle_part = MiddlePart::select('hmp_name','id')->where('id', $counter->hpp_middle_part_id)->get();
        }
        return view('product_middle_part.index', compact('middle_part', 'product_part', 'product','type', 'priority', 'help_desk', 'user'));
    }


    public function checkbox(Request $request, $id)
    {
        $checkbox = ProductPart::find($id);
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
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('product_middle_part.create', compact( 'type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpp_product_id' => 'required',
            'hpp_middle_part_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = new ProductMiddlePart();
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_middle_part_id = $request->hpp_middle_part_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();

        return json_encode(["response" => "OK"]);
    }

    public function edit($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $product_part = ProductMiddlePart::find($id);
        return view('product_middle_part.edit', compact( 'product_part', 'type', 'priority', 'help_desk', 'user'));


    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpp_product_id' => 'required',
            'hpp_middle_part_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = ProductMiddlePart::find($id);
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_middle_part_id = $request->hpp_middle_part_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();
        return json_encode(["response" => "OK"]);


    }


    public function destroy($id)
    {
        $product_part = ProductMiddlePart::find($id);
        $product_part->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }

    public function fill_data_middle_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $middle_part = MiddlePart::select('hmp_name as text', 'id', 'hmp_middle_part_model', 'hmp_serial_number', 'hmp_image')->where('hmp_name', 'LIKE', "%$search%")->orwhere('hmp_serial_number', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $middle_part]);
    }

    public function fill_data_product(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_property_items', 'hnt_product_property.hpp_property_items', 'hnt_product_property_items.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_image', 'hnt_products.hp_product_name as text', 'hnt_products.hp_product_price', 'hnt_product_color.hn_color_name', 'hnt_product_property.hpp_property_name', 'hnt_product_property_items.hppi_items_name')
                ->where('hnt_products.id', 'LIKE', "%$search%")
                ->orwhere('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $product]);
    }


}
