<?php

namespace App\Http\Controllers;

use App\Order;
use App\Project;
use Illuminate\Http\Request;

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
        $order_req = Order::select('id')
            ->whereNotNull('hp_Invoice_number')->count();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
        $projects =  Project::all();
        return view('home',compact('order','projects','order_req'));


    }
}
