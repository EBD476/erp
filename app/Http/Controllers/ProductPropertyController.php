<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPropertyController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_property.index', compact('properties', 'user', 'type', 'priority', 'help_desk', 'items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpp_property_name' => 'required',
        ]);
        $properties = New ProductProperty();
        $properties->hpp_property_name = $request->hpp_property_name;
        $properties->hpp_property_items = $request->hpp_property_items;
        $properties->save();
        $property_item = ProductPropertyItems::select('id', 'hppi_items_name')->where('id', $properties->hpp_property_items)->get()->first();
        dd($property_item->hppi_items_name);
        return json_encode(["response" => "Done", "item" => $property_item->hppi_items_name, "name" => $properties->hpp_property_name, "id" => $properties->id]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpp_property_name' => 'required',
        ]);
        $properties = ProductProperty::find($id);
        $properties->hpp_property_name = $request->hpp_property_name;
        $properties->hpp_property_items = $request->hpp_property_items;
        $properties->save();
        return json_encode(["response" => "Done"]);

    }

    public function destroy($id)
    {
        $properties = ProductProperty:: find($id);
        $properties->delete();
        return json_encode(["response" => "OK"]);

    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $properties = DB::table('hnt_product_property')
                ->join('hnt_product_property_items', 'hnt_product_property.hpp_property_items', '=', 'hnt_product_property_items.id')
                ->select('hnt_product_property.id', 'hnt_product_property.hpp_property_name', 'hnt_product_property.hpp_property_items', 'hnt_product_property_items.hppi_items_name')
                ->where('hnt_product_property.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $properties = DB::table('hnt_product_property')
                ->join('hnt_product_property_items', 'hnt_product_property.hpp_property_items', '=', 'hnt_product_property_items.id')
                ->select('hnt_product_property.id', 'hnt_product_property.hpp_property_name', 'hnt_product_property.hpp_property_items', 'hnt_product_property_items.hppi_items_name')
                ->where('hnt_product_property.deleted_at', '=', Null)
                ->where('hnt_product_property.hpp_property_name', 'LIKE', "%$search%")
                ->orwhere('hnt_product_property_items.hppi_items_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($properties as $property) {
            $data .= '["' . $property->id . '",' . '"' . $property->hpp_property_name . '",' . '"' . $property->hppi_items_name . '"],';
        }
        $data = substr($data, 0, -1);
        $property_count = ProductProperty::all()->count();
        return response('{ "recordsTotal":' . $property_count . ',"recordsFiltered":' . $property_count . ',"data": [' . $data . ']}');
    }
}
