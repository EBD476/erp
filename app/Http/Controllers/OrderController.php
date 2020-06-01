<?php

namespace App\Http\Controllers;

use App\address;
use App\Client;
use App\InvoiceStatuses;
use App\MiddlePart;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\Project_State;
use App\Project_Type;
use App\RepositoryMiddlePart;
use App\RepositoryProduct;
use App\State;
use App\Task;
use App\Tax;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;
use App\Part;
use App\RepositoryCreate;
use App\RepositoryPart;

class OrderController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('order.index', compact( 'type', 'help_desk', 'priority', 'user'));
    }

    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $project_type = Project_Type::all();
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
        $client = Client::select('id', 'hc_name')->where('id', $project->ho_client)->get()->last();

        return view('order.edit', compact('invoice_city', 'invoice_state', 'invoices_items', 'color', 'properties', 'items_all', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user', 'tax'));
    }

    public function edit_pre(Request $request, $id)
    {
        $invoice_statuses = InvoiceStatuses::ALL();
        $project_type = Project_Type::select('id', 'hp_name')->get();
        $product = Product::select('id', 'hp_product_name', 'hp_product_price')->get();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $project = Order::find($id);
        $invoices_item = $request;
        $color = ProductColor::all();
        $items = ProductPropertyItems::all();
        $properties = ProductProperty::all();
        $address = address:: where('id', $invoices_item->hp_address_city_id)->get()->last();
        $state = Project_State:: where('id', $invoices_item->hp_address_state_id)->get()->last();
        $invoice_state = State::Select('id', 'hp_project_state')->where('id', $project->hp_address_state_id)->get()->last();
        $invoice_city = Address::Select('id', 'hp_city')->where('id', $project->hp_address_city_id)->get()->last();
        $client = Client::select('id', 'hc_name')->where('id', $project->ho_client)->get()->last();
        return view('order.editpre', ['invoices_item' => $invoices_item], compact('invoice_city', 'invoice_state', 'color', 'properties', 'invoice_statuses', 'client', 'project_type', 'address', 'state', 'product', 'project', 'items', 'type', 'help_desk', 'priority', 'user'));

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
        $items = OrderProduct::where('hpo_order_id', $id)->delete();
        return json_encode(["response" => "OK"]);

    }

    public function preview(Request $request)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $data = $request;
        $date = Verta::now();
//        deu date time for exit from product level
        $create_due_date_all = $date->addMonth(2);
        $create_due_date = $create_due_date_all->formatJalaliDate();
        $items = ProductPropertyItems::select('id', 'hppi_items_name')->get();
        $properties = ProductProperty::select('id', 'hpp_property_name', 'hpp_property_items')->get();
        $color = ProductColor::select('id', 'hn_color_name')->get();
        $order = Order:: where('id', $request->hpo_order_id)->get()->last();
        $order_registrant = User::select('name')->where('id', $order->hp_registrant)->get()->last();
        $city = address:: where('id', $order->hp_address_city_id)->get()->last();
        $state = Project_State:: where('id', $order->hp_address_state_id)->get()->last();
        $client = Client::select('id', 'hc_name')->where('id', $order->ho_client)->get()->last();
        $collect = count(collect($data->name));
        $product = Product::select('id', 'hp_product_model', 'hp_product_color_id', 'hp_product_size', 'hp_product_property', 'hp_product_code_number', 'hp_product_name', 'hp_product_price')->get();
        return view('order.preview', ['data' => $data], compact('order_registrant', 'create_due_date', 'properties', 'items', 'color', 'collect', 'client', 'order_product', 'type', 'help_desk', 'priority', 'user', 'product', 'order', 'city', 'state'));
    }

    public function invoices_list_product()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('order.invoices_list_product.index',compact( 'user','help_desk', 'priority', 'type'));
    }

//  fill data table order
    public function fill(Request $request)
    {
        $current_user = auth()->user()->id;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::select('id', 'hp_project_name', 'hp_employer_name', 'hp_connector', 'hp_type_project')->where('hp_registrant', $current_user)->skip($start)->take($length)->get();
        } else {
            $order = Order::select('id', 'hp_project_name', 'hp_employer_name', 'hp_connector', 'hp_type_project')->where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }
        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $progress = OrderState::select('ho_process_id')->where('order_id',$orders->id)->get()->last();
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '",' . '"' . $orders->id . '",' . '"' . $progress->ho_process_id . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

//  fill data table invoice product list
    public function invoices_list_product_fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_repository_product', 'hnt_products.id', '=', 'hnt_repository_product.hr_product_id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_product_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_repository_product.hr_product_stock')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 3)
                ->orderBy('hnt_invoices.hp_Invoice_number')
                ->skip($start)
                ->take($length)
                ->get();

        } else {
            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_repository_product', 'hnt_products.id', '=', 'hnt_repository_product.hr_product_id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_product_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_repository_product.hr_product_stock')
                ->where('hnt_invoice_items.hpo_status', '=', 3)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_Invoice_number', 'LIKE', "%$search%")
                ->get();
        }


        $data = '';
        $key = 0;
        $status_check = Task::ALL();
        foreach ($product as $products) {
            if ($status_check->isEmpty()) {
                $result = $products->hr_product_stock - $products->hpo_count;
                $key++;
                $data .= '["' . $key . '","' . $products->hp_Invoice_number . '",' . '"' . $products->hp_product_name . " " . $products->hp_product_model . " " . $products->hn_color_name . " " . $products->hpp_property_name . '",' . '"' . $products->hpo_count . '",' . '"' . $result . '",' . '"' . $products->hop_due_date . '",' . '"' . $products->hpo_product_id . '",' . '"' . $products->id . '",' . '"' . $products->hpo_order_id . '",' . '"' . $products->hpo_serial_number . '",' . '"' . 0 . '"],';
            } else {
                $status = DB::table('hnt_product_task')->join('hnt_product_status','hnt_product_task.hpt_status','hnt_product_status.id')->select('hnt_product_status.hps_level')->where('hpt_invoice_number', $products->hp_Invoice_number)->where('hpt_product_id', $products->hpo_product_id)->get()->last();
                $result = $products->hr_product_stock - $products->hpo_count;
                $key++;
                $data .= '["' . $key . '","' . $products->hp_Invoice_number . '",' . '"' . $products->hp_product_name . " " . $products->hp_product_model . " " . $products->hn_color_name . " " . $products->hpp_property_name . '",' . '"' . $products->hpo_count . '",' . '"' . $result . '",' . '"' . $products->hop_due_date . '",' . '"' . $products->hpo_product_id . '",' . '"' . $products->id . '",' . '"' . $products->hpo_order_id . '",' . '"' . $products->hpo_serial_number . '",' . '"' . $status->hps_level . '"],';

            }

           }
        $data = substr($data, 0, -1);
        $products_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $products_count . ',"recordsFiltered":' . $products_count . ',"data": [' . $data . ']}');
    }

//  fill data table invoice product invoices_list_product_inventory list
    public function invoices_list_product_inventory(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_repository_product', 'hnt_products.id', '=', 'hnt_repository_product.hr_product_id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_product_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_repository_product.hr_product_stock', DB::raw('SUM(hnt_invoice_items.hpo_count) as total_items'))
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 3)
                ->groupBy('hnt_invoice_items.hpo_product_id')
                ->orderBy('hnt_invoice_items.hpo_product_id')
                ->skip($start)
                ->take($length)
                ->get();

        } else {
            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_repository_product', 'hnt_products.id', '=', 'hnt_repository_product.hr_product_id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_product_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_repository_product.hr_product_stock')
                ->where('hnt_invoice_items.hpo_status', '=', 3)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_Invoice_number', 'LIKE', "%$search%")
                ->groupBy('hnt_invoice_items.hpo_product_id')
                ->orderBy('hnt_invoice_items.hpo_product_id')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product as $products) {
            $result_tot = $products->hr_product_stock - $products->total_items;
            if ($result_tot < 0) {
                $key++;
                $data .= '["' . $key . '",' . '"' . $products->hp_product_name . " " . $products->hp_product_model . " " . $products->hn_color_name . " " . $products->hpp_property_name . '",' . '"' . $products->total_items . '",' . '"' . $result_tot . '",' . '"' . $products->hpo_product_id . '"],';
            }
        }
        $data = substr($data, 0, -1);
        $products_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $products_count . ',"recordsFiltered":' . $products_count . ',"data": [' . $data . ']}');
    }

//  fill select to
    public function fill_data_client(Request $request)
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
                ->where('hnt_products.hp_status', '=', '1')
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $product]);
    }
//  end fill select to
}
