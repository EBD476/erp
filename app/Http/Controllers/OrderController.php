<?php

namespace App\Http\Controllers;

use App\address;
use App\Client;
use App\InvoiceStatuses;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\Project_State;
use App\Project_Type;
use App\State;
use App\Tax;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $order = Order::select('id', 'hp_project_name', 'hp_employer_name', 'hp_connector', 'hp_type_project')->where('hp_registrant', $current_user)->get();
        $progress = OrderState::all();
        return view('order.index', compact('order', 'progress', 'type', 'help_desk', 'priority', 'user'));
    }

    public function create()
    {
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $invoice_statuses = InvoiceStatuses::ALL();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        return view('order.create', compact('address', 'state', 'project_type', 'product', 'invoice_statuses', 'type', 'help_desk', 'priority', 'product', 'user', 'items', 'properties', 'color'));
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
        ]);
        $current_user = auth()->user()->id;
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
        $order->hp_registrant = $current_user;
        $order->hp_status = 1;
        $order->ho_client = $request->ho_client;
        $order->save();
        return json_encode(["response" => "OK", "client_id" => $order->ho_client, "order_id" => $order->id]);

    }

    public function edit($id)
    {
        $tax = Tax::select('hpx_tax')->get()->last();
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $invoice_statuses = InvoiceStatuses::ALL();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $project = Order::find($id);
        $invoices_items = OrderProduct::where('hpo_order_id', $id)->get();
        $invoice_state = State::Select('id', 'hp_project_state')->where('id', $project->hp_address_state_id)->get()->last();
        $invoice_city = Address::Select('id', 'hp_city')->where('id', $project->hp_address_city_id)->get()->last();
        $items_all = OrderProduct::select('hpo_total', 'hpo_status', 'hop_due_date', 'hpo_order_id')->where('hpo_order_id', $id)->get()->last();
        $client =Client::select('id','hc_name')->where('id',$project->ho_client)->get()->last();

        return view('order.edit', compact('invoice_city', 'invoice_state', 'invoices_items', 'color', 'properties', 'items_all', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user', 'tax'));
    }

    public function edit_pre(Request $request, $id)
    {
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $invoice_statuses = InvoiceStatuses::ALL();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $project = Order::find($id);
        $invoices_item = $request;
        $invoice_state = State::Select('id', 'hp_project_state')->where('id', $project->hp_address_state_id)->get()->last();
        $invoice_city = Address::Select('id', 'hp_city')->where('id', $project->hp_address_city_id)->get()->last();
        $client =Client::select('id','hc_name')->where('id',$project->ho_client)->get()->last();



//        $returnHTML = view('order.editpre', compact('color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'))->with('invoices_items', $invoices_items)->renderSections()['content'];
        return view('order.editpre', ['invoices_item' => $invoices_item], compact('invoice_city', 'invoice_state', 'color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'));

//        $view = view("order.editpre",['invoices_items' => $invoices_items],compact('color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'))->render();
//        return response($returnHTML);

//        return json_encode(["response" =>  $returnHTML]);
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
            'hp_address_state_id' => 'required',
            'hp_address_city_id' => 'required',
            'hp_address' => 'required',
            'hp_contract_type' => 'required',
        ]);
        $current_user = auth()->user()->id;
        $order = Order::find($id);
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
        $order->hp_registrant = $current_user;
        $order->ho_client = $request->ho_client;
        $order->hp_status = 1;
        $order->save();
        return json_encode(["response" => "OK", "client_id" => $order->ho_client, "order_id" => $order->id]);

    }

    public function destroy($id)
    {
        $dataUser = Order::find($id);
        $dataUser->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');

    }

    public function preview(Request $request)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $data = $request;
        $order = Order:: where('id', $request->hpo_order_id)->get()->last();
        $city = address:: where('id', $order->hp_address_city_id)->get()->last();
        $state = Project_State:: where('id', $order->hp_address_state_id)->get()->last();
        $client = Client::select('id', 'hc_name')->where('id', $order->ho_client)->get()->last();
        $product = Product::select('id', 'hp_product_model', 'hp_product_color_id', 'hp_product_size', 'hp_product_property', 'hp_product_code_number', 'hp_product_name', 'hp_product_price')->get();
        return view('order.preview', ['data' => $data], compact('client', 'order_product', 'type', 'help_desk', 'priority', 'user', 'product', 'order', 'city', 'state'));
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

    public function fill_data(Request $request)
    {
        $search = $request->search;
        $current_user = auth()->user()->id;
        if ($search != "") {
            $client = Client::select('id', 'hc_name as text')->where('hc_dealership_number', $current_user)
                ->where('hc_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $client]);
    }

    public function fill_data_city(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $city = address::select('id', 'hp_city as text')->where('id', 'LIKE', "%$search%")
                ->orwhere('hp_city', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $city]);
    }

    public function fill_data_state(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $state = State::select('id', 'hp_project_state as text')->where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_state', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $state]);
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
