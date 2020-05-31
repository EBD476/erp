<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPropertyItemsController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_items.index', compact('items', 'user', 'type', 'priority', 'help_desk'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hppi_items_name' => 'required',
        ]);
        $items = New ProductPropertyItems();
        $items->hppi_items_name = $request->hppi_items_name;
        $items->hppi_serial_number = $request->hppi_serial_number;
//        $items->hppi_color = $request->hppi_color;
        $items->save();
        return json_encode(["response" => "Done"]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hppi_items_name' => 'required',
        ]);
        $items = ProductPropertyItems:: find($id);
        $items->hppi_items_name = $request->hppi_items_name;
        $items->hppi_serial_number = $request->hppi_serial_number;
//        $items->hppi_color = $request->hppi_color;
        $items->save();
        return json_encode(["response" => "Done"]);

    }


    public function destroy($id)
    {
        $items = ProductPropertyItems:: find($id);
        $items->delete();
        return json_encode(["response" => "OK"]);

    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $items = DB::table('hnt_product_property_items')
//                ->join('hnt_product_color', 'hnt_product_property_items.hppi_color', '=', 'hnt_product_color.id')
                ->select('hnt_product_property_items.id', 'hnt_product_property_items.hppi_items_name', 'hnt_product_property_items.hppi_serial_number')
                ->where('hnt_product_property_items.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $items = DB::table('hnt_product_property_items')
//                ->join('hnt_product_color', 'hnt_product_property_items.hppi_color', '=', 'hnt_product_color.id')
                ->select('hnt_product_property_items.id', 'hnt_product_property_items.hppi_items_name', 'hnt_product_property_items.hppi_serial_number')
                ->where('hnt_product_property_items.deleted_at', '=', Null)
                ->where('hppi_items_name', 'LIKE', "%$search%")
                ->orwhere('hppi_serial_number', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($items as $itemss) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $itemss->hppi_items_name . '",' . '"' . $itemss->hppi_serial_number . '",' . '"' . $itemss->id . '"],';
        }
        $data = substr($data, 0, -1);
        $items_count = ProductPropertyItems::all()->count();
        return response('{ "recordsTotal":' . $items_count . ',"recordsFiltered":' . $items_count . ',"data": [' . $data . ']}');
    }
}
