<?php

namespace App\Http\Controllers;

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


        $projects =  Project::all();
        return view('home',['projects' => $projects]);
    }
}
