<?php

namespace App\Http\Controllers;

use App\address;
use App\Client;
use App\InvoiceStatuses;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\Project_Type;
use App\State;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class OrderController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $order = Order::ALL();
        $progress=OrderState::all();
        return view('order.index', compact('order','progress','type','help_desk','priority','user'));
    }

    public function create()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $invoice_statuses=InvoiceStatuses::ALL();
        $client = Client::all();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        return view('order.create', compact('address', 'state', 'project_type', 'product','client','invoice_statuses','type','help_desk','priority','product','user'));
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
        $current_user= auth()->user()->username;
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
        $order->hp_registrant =$current_user;
        $order->ho_client = $request->ho_client;
        $order->save();
        return json_encode(["response"=>"OK" ,"client_id"=>$order->ho_client,"order_id"=>$order->id]);

    }

    public function edit($id)
    {
        $user=User::all();
        $invoice_statuses=InvoiceStatuses::ALL();
        $client = Client::all();
        $project_type = Project_Type::all();
        $address = address::all();
        $state = State::all();
        $product = Product::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $project = Order::find($id);
        $items = OrderProduct::where('hpo_order_id',$id)->get();
        $items_all = OrderProduct::select('hpo_discount','hpo_total','hpo_status','hpo_total_discount','hop_due_date','hpo_order_id')->where('hpo_order_id',$id)->get()->last();
        return view('order.edit', compact('items_all','invoice_statuses','client','project_type','address','state','product','project','items','type','help_desk','priority','user'));
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
        ]);
        $current_user= auth()->user()->username;
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
        $order->hp_registrant =$current_user;
        $order->ho_client = $request->ho_client;
        $order->save();
        return json_encode(["response"=>"OK" ,"client_id"=>$order->ho_client,"order_id"=>$order->id]);

    }

    public function destroy($id)
    {
        $dataUser = Order::find($id);
        $dataUser->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');

    }

    public function preview(Request $request)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $data = $request;
        return view('order.preview', compact('data','type','help_desk','priority'));
    }
}
