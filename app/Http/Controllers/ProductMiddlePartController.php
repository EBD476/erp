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
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('product_middle_part.index', compact('middle_part', 'product_part', 'product', 'type', 'priority', 'help_desk', 'user'));
    }

    public function checkbox(Request $request, $id)
    {
        $checkbox = ProductPart::find($id);
        $checkbox->hp_statuse = $request->checkbox;
        $checkbox->save();
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
        $product_part->hpp_middle_part_zone = $request->hpp_middle_part_zone;
        $product_part->save();

        return json_encode(["response" => "OK"]);
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
        $product_part->hpp_middle_part_zone = $request->hpp_middle_part_zone;
        $product_part->save();
        return json_encode(["response" => "OK"]);


    }

    public function destroy($id)
    {
        $product_part = ProductMiddlePart::find($id);
        $product_part->delete();
        return json_encode(["response" => "OK"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $middle_part = DB::table('hnt_product_middle_part')
                ->join('hnt_middle_part', 'hnt_product_middle_part.hpp_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_products', 'hnt_product_middle_part.hpp_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_zone', 'hnt_product_middle_part.hpp_middle_part_zone', '=', 'hnt_product_zone.id')
                ->select('hnt_product_middle_part.id', 'hnt_product_middle_part.hpp_part_count', 'hnt_product_zone.hpz_name', 'hnt_product_middle_part.hpp_middle_part_id', 'hnt_product_middle_part.hpp_product_id', 'hnt_product_middle_part.hpp_middle_part_zone', 'hnt_products.hp_product_name', 'hnt_middle_part.hmp_name')
                ->where('hnt_product_middle_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $middle_part = DB::table('hnt_product_middle_part')
                ->join('hnt_middle_part', 'hnt_product_middle_part.hpp_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_products', 'hnt_product_middle_part.hpp_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_zone', 'hnt_product_middle_part.hpp_middle_part_zone', '=', 'hnt_product_zone.id')
                ->select('hnt_product_middle_part.id', 'hnt_product_middle_part.hpp_part_count', 'hnt_product_zone.hpz_name', 'hnt_product_middle_part.hpp_middle_part_id', 'hnt_product_middle_part.hpp_product_id', 'hnt_product_middle_part.hpp_middle_part_zone', 'hnt_products.hp_product_name', 'hnt_middle_part.hmp_name')
                ->where('hnt_product_middle_part.deleted_at', '=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($middle_part as $middle_parts) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $middle_parts->hp_product_name . '",' . '"' . $middle_parts->hmp_name . '",' . '"' . $middle_parts->hpz_name . '",' . '"' . $middle_parts->hpp_part_count . '",' . '"' . $middle_parts->hpp_middle_part_id . '",' . '"' . $middle_parts->hpp_product_id . '",' . '"' . $middle_parts->hpp_middle_part_zone . '",' . '"' . $middle_parts->id . '"],';
        }
        $data = substr($data, 0, -1);
        $middle_parts = ProductMiddlePart::all()->count();
        return response('{ "recordsTotal":' . $middle_parts . ',"recordsFiltered":' . $middle_parts . ',"data": [' . $data . ']}');
    }

}
