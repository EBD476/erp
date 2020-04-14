<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
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
        $properties = ProductProperty::all();
        return view('products.product_property.index', compact('properties', 'user', 'type', 'priority', 'help_desk', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = ProductPropertyItems::all();
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_property.create', compact('user', 'type', 'priority', 'help_desk', 'items'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = ProductPropertyItems::all();
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $properties = ProductProperty::find($id);
        return view('products.product_property.edit', compact('properties', 'user', 'type', 'priority', 'help_desk', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $properties = ProductProperty:: find($id);
        $properties->delete();
        return redirect()->back();

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
}
