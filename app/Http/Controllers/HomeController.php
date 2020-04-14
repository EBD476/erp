<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Client;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Order;
use App\Project;
use App\Support;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
//        User::create(array(
//            'name'     => 'admin',
//            'username' => 'admin',
//            'password' => Hash::make('admin'),
//        ));
        $current_user = Auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_status', '2')->get();
        $client = Client::all()->count();
        $client_order = Client::where('hc_dealership_number', $current_user)->count();
        $agreement = Agreement::all()->count();
        $agreement_order = Agreement::where('ha_dealership_number', $current_user)->count();
        $order_order = Order::select('id')
            ->whereNotNull('hp_Invoice_number')->where('hp_residential', $current_user)->count();
        $order_req = Order::select('id')
            ->whereNotNull('hp_Invoice_number')->count();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
//        $order_agent = Order::select('id', 'hp_project_name', 'created_at', 'hp_status')
        $order_agent = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_registrant', auth()->user()->name)->get();
        $status_order = DB::select("select hp_process_name,hp_process_id from hnt_process");
        $projects = Project::all();
        $orders = Order::all()->count();
        $Repositories_Requirement = DB::select("SELECT sum(Product_Count) as sum_hpo FROM hnt_repository__requirements");
        return view('home', ['Repositories_Requirement' => $Repositories_Requirement], compact('status_order', 'order_agent', 'order_order', 'agreement_order', 'client_order', 'user', 'order', 'projects', 'order_req', 'agreement', 'client', 'orders', 'support_response', 'help_desk', 'priority', 'type'));


    }
}
