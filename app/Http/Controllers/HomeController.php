<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Client;
use App\Order;
use App\Project;

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
        $client=Client::all()->count();
        $agreement=Agreement::all()->count();
        $order_req = Order::select('id')
            ->whereNotNull('hp_Invoice_number')->count();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
        $projects =  Project::all();
        $orders =  Order::all()->count();
        return view('home',compact('order','projects','order_req','agreement','client','orders'));


    }
}
