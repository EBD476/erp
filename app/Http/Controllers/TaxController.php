<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Tax;
use App\User;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $tax=Tax::all();
        return view('order.product_tax.index',compact('tax','help_desk','user','type','priority'));
    }

    public function update(Request $request, $id)
    {
        $tax = Tax::find($id);
        $tax->hpx_tax = $request->hpx_tax;
        $tax->save();
        return json_encode(["response" => "OK"]);
    }


}
