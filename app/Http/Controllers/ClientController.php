<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Resource_;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $client = Client::where('hc_dealership_number', $current_user)->get();
        $admin_client = Client::all();
        return view('client.index', compact('admin_client', 'client', 'help_desk', 'priority', 'type', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('client.create', compact('priority', 'help_desk', 'type', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
////            'hc_user_id' => 'required' ,
//            'hc_account_id' => 'required' ,
//            'hc_currency_id' => 'required' ,
//            'hc_name' => 'required' ,
//            'hc_address' => 'required' ,
//            'hc_city' => 'required' ,
//            'hc_state' => 'required' ,
//            'hc_postal_code' => 'required' ,
//            'hc_country_id' => 'required' ,
//            'hc_private_notes' => 'required' ,
//            'hc_balance' => 'required' ,
//            'hc_paid_to_date' => 'required' ,
//            'hc_last_login' => 'required' ,
//            'hc_website' => 'required' ,
//            'shipping_city' => 'required' ,
//            'hc_work_phone' => 'required' ,
//            'shipping_state' => 'required' ,
//            'shipping_postal_code' => 'required' ,
//            'shipping_country_id' => 'required' ,
//            'shipping_address1' => 'required' ,
//            'shipping_address2' => 'required' ,
//            'language_id' => 'required' ,
//            'payment_terms' => 'required' ,
//            'task_rate' => 'required' ,
//            'show_tasks_in_portal' => 'required' ,
//            'public_notes' => 'required' ,
//            'invoice_number_counter' => 'required' ,
//            'size_id' => 'required' ,
//            'custom_value1' => 'required' ,
//            'custom_messages' => 'required' ,
//            'quote_number_counter' => 'required' ,
//            'credit_number_counter' => 'required' ,
//            'industry_id' => 'required' ,
////            'hc_phone' => 'required' ,
//
//        ]);
        $client = new Client();
        $client->hc_dealership_number = auth()->user()->id;
        $client->vat_number = $request->vat_number;
        $client->hc_name = $request->hc_name;
        $client->hc_address = $request->hc_address;
        $client->hc_city = $request->hc_city;
        $client->hc_state = $request->hc_state;
        $client->hc_postal_code = $request->hc_postal_code;
        $client->hc_country_id = $request->hc_country_id;
        $client->hc_private_notes = $request->hc_private_notes;
        $client->hc_balance = $request->hc_balance;
        $client->hc_paid_to_date = $request->hc_paid_to_date;
        $client->hc_email = $request->hc_email;
        $client->hc_website = $request->hc_website;
        $client->hc_work_phone = $request->hc_work_phone;
        $client->shipping_city = $request->shipping_city;
        $client->shipping_state = $request->shipping_state;
        $client->shipping_postal_code = $request->shipping_postal_code;
        $client->shipping_country_id = $request->shipping_country_id;
        $client->shipping_address1 = $request->shipping_address1;
        $client->shipping_address2 = $request->shipping_address2;
        $client->hc_currency_id = $request->hc_currency_id;
        $client->language_id = $request->language_id;
        $client->payment_terms = $request->payment_terms;
        $client->task_rate = $request->task_rate;
        $client->show_tasks_in_portal = $request->show_tasks_in_portal;
        $client->public_notes = $request->public_notes;
        $client->invoice_number_counter = $request->invoice_number_counter;
        $client->size_id = $request->size_id;
        $client->hc_account_id = $request->hc_account_id;
        $client->custom_value1 = $request->custom_value1;
        $client->custom_messages = $request->custom_messages;
        $client->quote_number_counter = $request->quote_number_counter;
        $client->credit_number_counter = $request->credit_number_counter;
        $client->industry_id = $request->industry_id;
        $client->hc_phone = $request->hc_phone;
        $client->save();
        return json_encode(["response" => "OK", "id" => $client->id, "client_name" => $client->hc_name]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         *
         */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $client = Client::find($id);
        return view('client.edit', compact('client', 'priority', 'help_desk', 'type', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
//           'hc_user_id' => 'required' ,
//            'hc_account_id' => 'required' ,
//            'hc_currency_id' => 'required' ,
//            'hc_name' => 'required' ,
//            'hc_address' => 'required' ,
//            'hc_city' => 'required' ,
//            'hc_state' => 'required' ,
//            'hc_postal_code' => 'required' ,
//            'hc_country_id' => 'required' ,
//            'hc_private_notes' => 'required' ,
//            'hc_balance' => 'required' ,
//            'hc_paid_to_date' => 'required' ,
//            'hc_last_login' => 'required' ,
//            'hc_website' => 'required' ,
//            'shipping_city' => 'required' ,
//            'hc_work_phone' => 'required' ,
//            'shipping_state' => 'required' ,
//            'shipping_postal_code' => 'required' ,
//            'shipping_country_id' => 'required' ,
//            'shipping_address1' => 'required' ,
//            'shipping_address2' => 'required' ,
//            'language_id' => 'required' ,
//            'payment_terms' => 'required' ,
//            'task_rate' => 'required' ,
//            'show_tasks_in_portal' => 'required' ,
//            'public_notes' => 'required' ,
//            'invoice_number_counter' => 'required' ,
//            'size_id' => 'required' ,
//            'custom_value1' => 'required' ,
//            'custom_messages' => 'required' ,
//            'quote_number_counter' => 'required' ,
//            'credit_number_counter' => 'required' ,
//            'industry_id' => 'required' ,
        ]);
//        $id=$request->client_id;
        $client = Client::find($id);
        if ($request->hc_name != "") {
            $client->vat_number = $request->vat_number;
        }
        if ($request->hc_name != "") {
            $client->hc_name = $request->hc_name;
        }
        if ($request->hc_phone != "") {
            $client->hc_phone = $request->hc_phone;
        }
        $client->hc_address = $request->hc_address;
        $client->hc_city = $request->hc_city;
        $client->hc_state = $request->hc_state;
        $client->hc_postal_code = $request->hc_postal_code;
        $client->hc_country_id = $request->hc_country_id;
        $client->hc_private_notes = $request->hc_private_notes;
        $client->hc_balance = $request->hc_balance;
        $client->hc_paid_to_date = $request->hc_paid_to_date;
        if ($request->hc_name != "") {
            $client->hc_email = $request->hc_email;
        }
        if ($request->hc_website != "") {
            $client->hc_website = $request->hc_website;
        }
        $client->hc_work_phone = $request->hc_work_phone;
        $client->shipping_city = $request->shipping_city;
        $client->shipping_state = $request->shipping_state;
        $client->shipping_postal_code = $request->shipping_postal_code;
        $client->shipping_country_id = $request->shipping_country_id;
        $client->shipping_address1 = $request->shipping_address1;
        $client->shipping_address2 = $request->shipping_address2;
        $client->hc_currency_id = $request->hc_currency_id;
        $client->language_id = $request->language_id;
        $client->payment_terms = $request->payment_terms;
        $client->task_rate = $request->task_rate;
        $client->show_tasks_in_portal = $request->show_tasks_in_portal;
        $client->public_notes = $request->public_notes;
        $client->invoice_number_counter = $request->invoice_number_counter;
        $client->size_id = $request->size_id;
        if ($request->hc_account_id != "") {
            $client->hc_account_id = $request->hc_account_id;
        }
        $client->custom_value1 = $request->custom_value1;
        $client->custom_messages = $request->custom_messages;
        $client->quote_number_counter = $request->quote_number_counter;
        $client->credit_number_counter = $request->credit_number_counter;
        $client->industry_id = $request->industry_id;
        $client->save();
        return json_encode(["response" => "OK"]);
//        return redirect()->route('client.index')->with('successMSG','عملیات ویرایش اطلاعات با موفقیت انجام شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
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
