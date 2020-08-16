<?php

namespace App\Http\Controllers;

use App\ProductStatus;
use Illuminate\Http\Request;
use App\User;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class ProductStatusController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_status.index', compact('type', 'help_desk', 'priority', 'type', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hps_name' => 'required',
            'hps_level' => 'required'
        ]);
        $status = New ProductStatus();
        $status->hps_name = $request->hps_name;
        $status->hps_level = $request->hps_level;
        $status->save();
        return json_encode(["response" => "Done"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hps_name' => 'required',
            'hps_level' => 'required'
        ]);
        $status = ProductStatus:: find($id);
        $status->hps_name = $request->hps_name;
        $status->hps_level = $request->hps_level;
        $status->save();
        return json_encode(["response" => "Done"]);
    }

    public function destroy(Request $request, $id)
    {
        $status = ProductStatus::find($id);
        $status->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $status = ProductStatus::select('id', 'hps_name','hps_level','hps_zone_name')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $status = ProductStatus::select('id', 'hps_name','hps_level','hps_zone_name')
                ->where('id', 'LIKE', "%$search%")
                ->orwhere('hps_name', 'LIKE', "%$search%")
                ->orwhere('hps_zone_id', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($status as $st) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $st->hps_level . '",' . '"' . $st->hps_name . '",' . '"' . $st->hps_zone_name . '",' . '"' . $st->id . '"],';
        }
        $data = substr($data, 0, -1);
        $st_count = HDtype::all()->count();
        return response('{ "recordsTotal":' . $st_count . ',"recordsFiltered":' . $st_count . ',"data": [' . $data . ']}');
    }
}
