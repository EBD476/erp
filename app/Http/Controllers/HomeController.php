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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $support_response = Support::where('hs_status','2')->get();
        $client=Client::all()->count();
        $agreement=Agreement::all()->count();
        $order_req = Order::select('id')
            ->whereNotNull('hp_Invoice_number')->count();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
        $projects =  Project::all();
        $orders =  Order::all()->count();
        return view('home',compact('order','projects','order_req','agreement','client','orders','support_response','help_desk','priority','type'));


    }
}
