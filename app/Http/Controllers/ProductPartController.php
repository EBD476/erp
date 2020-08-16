<?php

namespace App\Http\Controllers;

use App\Part;
use App\Product;
use App\ProductPart;
use App\ProductZone;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class ProductPartController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('product_part.index', compact('type', 'priority', 'help_desk', 'user'));
    }


    public function checkbox(Request $request, $id)
    {
        $checkbox = ProductPart::find($id);
        $checkbox->hp_statuse = $request->checkbox;
        $checkbox->save();
    }


    public function store(Request $request)
    {
//        dd(count(collect($request)->get('hpp_product_zone')));
        $this->validate($request, [
            'hpp_part_id' => 'required',
            'hpp_product_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = new ProductPart();
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        if(count(collect($request)->get('hpp_product_zone')) == 1){
            $zone_name = ProductZone::select('hpz_name')->where('id', $request->hpp_product_zone)->get()->last();
            $product_part->hpp_product_zone = $zone_name->hpz_name;
        }
        $product_part->save();

        return json_encode(["response" => "OK"]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpp_part_id' => 'required',
            'hpp_product_id' => 'required',
            'hpp_part_count' => 'required',
        ]);

        $product_part = ProductPart::find($id);
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_product_id = $request->hpp_product_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        if($request->hpp_product_zone != ""){
            $zone_name = ProductZone::select('hpz_name')->where('id', $request->hpp_product_zone)->get()->last();
            $product_part->hpp_product_zone = $zone_name->hpz_name;
        }
        $product_part->save();
        return json_encode(["response" => "OK"]);


    }


    public function destroy($id)
    {
        $product_part = ProductPart::find($id);
        $product_part->delete();
        return json_encode(["response" => "OK"]);
    }

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $product_part = DB::table('hnt_product_part')
                ->join('hnt_parts', 'hnt_product_part.hpp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_products', 'hnt_product_part.hpp_product_id', '=', 'hnt_products.id')
                ->select('hnt_product_part.id', 'hnt_product_part.hpp_product_id', 'hnt_product_part.hpp_part_id', 'hnt_products.hp_product_name', 'hnt_product_part.hpp_product_zone', 'hnt_product_part.hpp_part_count', 'hnt_parts.hp_name')
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $product_part = DB::table('hnt_product_part')
                ->join('hnt_parts', 'hnt_product_part.hpp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_products', 'hnt_product_part.hpp_product_id', '=', 'hnt_products.id')
                ->select('hnt_product_part.id', 'hnt_product_part.hpp_product_id', 'hnt_product_part.hpp_part_id', 'hnt_product_part.hpp_part_count', 'hnt_product_part.hpp_product_zone', 'hnt_products.hp_product_name', 'hnt_parts.hp_name')
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product_part as $product_parts) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $product_parts->hp_product_name . '",' . '"' . $product_parts->hp_name . '",' . '"' . $product_parts->hpp_product_zone . '",' . '"' . $product_parts->hpp_part_count . '",' . '"' . $product_parts->hpp_product_id . '",' . '"' . $product_parts->hpp_part_id . '",' . '"' . $product_parts->id . '"],';
        }
        $data = substr($data, 0, -1);
        $product_parts_count = ProductPart::all()->count();
        return response('{ "recordsTotal":' . $product_parts_count . ',"recordsFiltered":' . $product_parts_count . ',"data": [' . $data . ']}');
    }

    public function computing_product_part(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];

        if ($search == '') {

            $product_part = DB::Table('hnt_product_part')
                ->Join('hnt_repository_part', 'hnt_product_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_products', 'hnt_product_part.hpp_product_id', 'hnt_products.id')
//                ->select('hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_middle_part.hmp_name')
                ->selectRaw('*,MIN(hnt_repository_part.hrp_part_count/hnt_product_part.hpp_part_count)as total')
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->groupBy('hnt_product_part.hpp_product_id')
                ->orderBY('total', 'DESC')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $product_part = DB::Table('hnt_product_part')
                ->Join('hnt_repository_part', 'hnt_product_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_products', 'hnt_product_part.hpp_product_id', 'hnt_products.id')
//                ->select('hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_middle_part.hmp_name')
                ->selectRaw('*,MIN(hnt_repository_part.hrp_part_count/hnt_product_part.hpp_part_count)as total')
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->groupBy('hnt_product_part.hpp_product_id')
                ->orderBY('total', 'DESC')
                ->get();
        }
        $computing = '';
        $key = 0;
        foreach ($product_part as $m) {
            $number = ($m->total);
            $round = number_format((floor($number)), 0, '.', '');
            $key++;
            $computing .= '["' . $key . '","' . $m->hp_product_name . '",' . '"' . $round . '",' . '"' . $m->hpp_product_id . '"],';
        }
        $computing = substr($computing, 0, -1);
        $product_part_count = ProductPart::ALL()->count();
        return response('{ "recordsTotal":' . $product_part_count . ',"recordsFiltered":' . $product_part_count . ',"data": [' . $computing . ']}');

    }

    public function computing_product_part_detail(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $product_id = $request->columns[4];

        if ($search == '') {

            $product_part = DB::Table('hnt_product_part')
                ->Join('hnt_repository_part', 'hnt_product_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_parts', 'hnt_product_part.hpp_part_id', 'hnt_parts.id')
                ->selectRaw('*,hnt_repository_part.hrp_part_count/hnt_product_part.hpp_part_count as total')
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->where('hnt_product_part.hpp_product_id', '=', $product_id)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $product_part = DB::Table('hnt_product_part')
                ->Join('hnt_repository_part', 'hnt_product_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_parts', 'hnt_product_part.hpp_part_id', 'hnt_parts.id')
                ->selectRaw('*,hnt_repository_part.hrp_part_count/hnt_product_part.hpp_part_count as total')
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->where('hnt_product_part.deleted_at', '=', Null)
                ->where('hnt_product_part.hpp_product_id', '=', $product_id)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }
        $computing = '';
        $key = 0;
        foreach ($product_part as $m) {
            $number = ($m->total);
            $round = number_format((floor($number)), 0, '.', '');
            $key++;
            $computing .= '["' . $key . '","' . $m->hp_name . '",' . '"' . $round . '",' . '"' . $m->hrp_part_count . '",' . '"' . $m->hpp_product_id . '"],';
        }
        $computing = substr($computing, 0, -1);
        $product_part_count = ProductPart::ALL()->count();
        return response('{ "recordsTotal":' . $product_part_count . ',"recordsFiltered":' . $product_part_count . ',"data": [' . $computing . ']}');

    }
}
