<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductStatus;
use App\ProductZone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductZoneController extends Controller
{
    public function index()
    {
        $status = ProductStatus::select('hps_name','hps_level','id')->get();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_zone.index', compact('status','type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpz_name' => 'required',
            'hpz_user_id' => 'required',
            'hpz_priority' => 'required'
        ]);
        $size_name = count(collect($request)->get('hpz_user_id'));
        if ($size_name == 1) {
            $product_zone = new ProductZone();
            $product_zone->hpz_name = $request->hpz_name;
            $product_zone->hpz_user_id = $request->hpz_user_id[0];
            $product_zone->hpz_priority = $request->hpz_priority;
            $product_zone->save();
        } else {
            $item = $request->hpz_user_id;
            $index = 0;
            foreach ($item as $items) {
                $product_zone = new ProductZone();
                $product_zone->hpz_name = $request->hpz_name;
                $product_zone->hpz_user_id = $request->hpz_user_id[$index];
                $product_zone->hpz_priority = $request->hpz_priority;
                $product_zone->save();
                $index++;
            }
        }

        //            set sataus zone
        $product_status = ProductStatus::find($request->hpz_priority);
        $product_status->hps_zone_name = $product_zone->hpz_name;
        $product_status->save();
        return json_encode(["response" => "OK",]);

    }

    public
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpz_name' => 'required',
            'hpz_user_id' => 'required',
            'hpz_priority' => 'required',
        ]);
        $product_zone = ProductZone::find($id);
        $product_zone->hpz_name = $request->hpz_name;
        $product_zone->hpz_user_id = $request->hpz_user_id;
        $product_zone->hpz_priority = $request->hpz_priority;
        $product_zone->save();
        return json_encode(["response" => "Done"]);


    }

    public
    function destroy($id)
    {
        $product_zone = ProductZone::find($id);
        $product_zone->delete();
        return json_encode(["response" => "Done"]);
    }

    public
    function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $product_zone = DB::Table('hnt_product_zone')
                ->join('users', 'hnt_product_zone.hpz_user_id', 'users.id')
                ->join('hnt_product_status', 'hnt_product_zone.hpz_priority', 'hnt_product_status.id')
                ->select('hnt_product_zone.id', 'hnt_product_zone.hpz_user_id', 'hnt_product_zone.hpz_name', 'hnt_product_zone.hpz_priority', 'users.name','hnt_product_status.hps_name')
                ->where('hnt_product_zone.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $product_zone =DB::Table('hnt_product_zone')
                ->join('users', 'hnt_product_zone.hpz_user_id', 'users.id')
                ->join('hnt_product_status', 'hnt_product_zone.hpz_priority', 'hnt_product_status.id')
                ->select('hnt_product_zone.id', 'hnt_product_zone.hpz_user_id', 'hnt_product_zone.hpz_name', 'hnt_product_zone.hpz_priority', 'users.name','hnt_product_status.hps_name')
                ->where('hnt_product_zone.deleted_at', '=', Null)
                ->where('hnt_product_zone.hpz_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product_zone as $product_zones) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $product_zones->hpz_name . '",' . '"' . $product_zones->name . '",' . '"' . $product_zones->hps_name . '",' . '"' . $product_zones->hpz_user_id . '",' . '"' . $product_zones->id . '",' . '"' . $product_zones->hpz_priority . '"],';
        }
        $data = substr($data, 0, -1);
        $product_zones_count = ProductZone::all()->count();
        return response('{ "recordsTotal":' . $product_zones_count . ',"recordsFiltered":' . $product_zones_count . ',"data": [' . $data . ']}');
    }

//fill select to
    public
    function fill_data_receiver(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $receiver = User::select('name as text', 'id')->where('name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $receiver]);
    }

    //fill select to
    public function fill_data_zone(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $zone = ProductZone::select('hpz_name as text', 'id')->where('hpz_name', 'LIKE', "%$search%")->groupby('hpz_name')->get();
        }
        return json_encode(["results" => $zone]);
    }
}
