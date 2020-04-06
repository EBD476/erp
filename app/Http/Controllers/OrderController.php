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
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Gd\Color;
use PhpParser\Builder\Property;

class OrderController extends Controller
{
    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $order = Order::ALL();
        $progress = OrderState::all();
        return view('order.index', compact('order', 'progress', 'type', 'help_desk', 'priority', 'user'));
    }

    public function create()
    {
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $invoice_statuses = InvoiceStatuses::ALL();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        return view('order.create', compact('address', 'state', 'project_type', 'product', 'invoice_statuses', 'type', 'help_desk', 'priority', 'product', 'user', 'items', 'properties', 'color'));
    }

    public function store(Request $request)
    {

//        dd($request);
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
        $current_user = auth()->user()->username;
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
        $order->ho_client = $request->ho_client;
        $order->save();
        return json_encode(["response" => "OK", "client_id" => $order->ho_client, "order_id" => $order->id]);

    }

    public function edit($id)
    {
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $user = User::all();
        $invoice_statuses = InvoiceStatuses::ALL();
        $client = Client::all();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $project = Order::find($id);
        $invoices_items = OrderProduct::where('hpo_order_id', $id)->get();
        $items_all = OrderProduct::select('hpo_total_all', 'hpo_discount', 'hpo_total', 'hpo_status', 'hpo_total_discount', 'hop_due_date', 'hpo_order_id')->where('hpo_order_id', $id)->get()->last();
        return view('order.edit', compact('invoices_items', 'color', 'properties', 'items_all', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'));
    }

    public function edit_pre(Request $request, $id)
    {
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $color = ProductColor::all();
        $user = User::all();
        $invoice_statuses = InvoiceStatuses::ALL();
        $client = Client::all();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $project = Order::find($id);
        $invoices_item = $request;


//        $returnHTML = view('order.editpre', compact('color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'))->with('invoices_items', $invoices_items)->renderSections()['content'];
        return view('order.editpre', ['invoices_item' => $invoices_item], compact('color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'));

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
        $client = Client::all();
        $product = Product::all();
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $data = $request;
        $order = Order:: where('id', $request->hpo_order_id)->get()->last();
        $city = address:: where('id', $order->hp_address_city_id)->get()->last();
        $state = Project_State:: where('id', $order->hp_address_state_id)->get()->last();
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
        if ($search != "") {
            $client = Client::select('id', 'hc_name as text')->where('id', 'LIKE', "%$search%")
                ->orwhere('hc_name', 'LIKE', "%$search%")
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
