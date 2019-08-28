<?php

namespace App\Http\Controllers;

use App\address;
use App\Client;
use App\Order;
use App\Product;
use App\Project_Type;
use App\State;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::select('hc_name');
        return view('order.index', compact('order'));
    }

    public function create()
    {
        $client = Client::all();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        return view('order.create', compact('address', 'state', 'project_type', 'product','client'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_project_name' => 'required',
            'hp_employer_name' => 'required',
            'hp_phone_number' => 'required',
            'hp_connector' => 'required',
            'hp_type_project' => 'required',
            'hp_owner_user' => 'required',
            'hp_project_area' => 'required',
            'hp_number_of_units' => 'required',
            'hp_address_state_id' => 'required',
            'hp_address_city_id' => 'required',
            'hp_address' => 'required',
            'hp_project_location' => 'required',
            'hp_contract_type' => 'required',
            'hp_registrant' => 'required',
            'hp_product_selection' => 'required',
        ]);
        $order = new Order();
        $order->hp_project_name = $request->hp_project_name;
        $order->hp_employer_name = $request->hp_employer_name;
        $order->hp_phone_number = $request->hp_phone_number;
        $order->hp_connector = $request->hp_connector;
        $order->hp_type_project = $request->hp_type_project;
        $order->hp_owner_user = $request->hp_owner_user;
        $order->hp_project_area = $request->hp_project_area;
        $order->hp_number_of_units = $request->hp_number_of_units;
        $order->hp_address_state_id = $request->hp_address_state_id;
        $order->hp_address_city_id = $request->hp_address_city_id;
        $order->hp_address = $request->hp_address;
        $order->hp_project_location = $request->hp_project_location;
        $order->hp_contract_type = $request->hp_contract_type;
        $order->hp_registrant = $request->hp_registrant;
        $order->ho_client = $request->ho_client;
        $order->ho_due_date = $request->ho_due_date;
        $order->ho_discount = $request->ho_discount;
        $order->hp_product_selection = $request->hp_product_selection;
        $order->save();
        return view('order.index');

    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, $id)

    {
        $this->validate($request, [
            'hp_project_name' => 'required',
            'hp_employer_name' => 'required',
            'hp_phone_number' => 'required',
            'hp_connector' => 'required',
            'hp_type_project' => 'required',
            'hp_owner_user' => 'required',
            'hp_project_area' => 'required',
            'hp_number_of_units' => 'required',
            'hp_address_id' => 'required',
            'hp_State' => 'required',
            'hp_city' => 'required',
            'hp_address' => 'required',
            'hp_project_location' => 'required',
            'hp_contract_type' => 'required',
            'hp_registrant' => 'required',
            'hp_product_selection' => 'required',
        ]);
        $order = Order::find($id);
        $order->hp_project_name = $request->hp_project_name;
        $order->hp_employer_name = $request->hp_employer_name;
        $order->hp_phone_number = $request->hp_phone_number;
        $order->hp_connector = $request->hp_connector;
        $order->hp_type_project = $request->hp_type_project;
        $order->hp_owner_user = $request->hp_owner_user;
        $order->hp_project_area = $request->hp_project_area;
        $order->hp_number_of_units = $request->hp_number_of_units;
        $order->hp_address_id = $request->hp_address_id;
        $order->hp_State = $request->hp_State;
        $order->hp_city = $request->hp_city;
        $order->hp_address = $request->hp_address;
        $order->hp_project_location = $request->hp_project_location;
        $order->hp_contract_type = $request->hp_contract_type;
        $order->hp_registrant = $request->hp_registrant;
        $order->hp_product_selection = $request->hp_product_selection;
        $order->save();
        return view('order.index');

    }

    public function destroy($id)
    {
        $dataUser = Order::find($id);
        $dataUser->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');

    }

    public function preview(Request $request)
    {
        $data = $request;
        return view('order.preview', compact('data'));
    }

//    public function verify()
//    {
//        $order = Order::select('hp_project_name', 'created_at')
//            ->where('hp_Invoice_number', 0)->get();
//        return view('admin.verify_level.index', compact('order'));
//    }

//    public function verify_pre($id)
//    {
////        dd('df');
//        $order = Order::find($id);
//        return view('admin.verify_level.preview', compact('order'));
//    }
//
//    public function store_verify()
//    {
////        $state=NEW StateLevel();
////        $state->
//    }
}
