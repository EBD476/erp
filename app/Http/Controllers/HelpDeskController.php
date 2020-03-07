<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\TicketStatus;
use App\User;
use Illuminate\Http\Request;
use carbon\carbon;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $ticket_status = TicketStatus::all();
        $help_desks = HelpDesk::all();
        $help_desks_user = HelpDesk::where('hhd_receiver_user_id',auth()->user()->id)->orwhere('hhd_request_user_id',auth()->user()->id)->get();
        return view('help_desk.index', compact('help_desks_user','help_desk', 'ticket_status','help_desks','type','priority','help_desks','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user = User::all();
        $ticket = TicketStatus::ALL();
        return view('help_desk.create', compact('priority', 'type', 'ticket', 'user','priorities','types','help_desk','user'));
    }


//Tokenize
//---------------------------
//
//$current_date = carbon::now();
//$current = $current_date->day
//$id = 0;
//if($current_date->day == $current->day && $current_date->month == $current->month && $current_date->year == $current->year){
//$id = $id+1
//}
//else
//    $id = 0 ;


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'hhd_type' => 'required',
            'hhd_problem' => 'required',
            'hhd_priority' => 'required',
//            'hhd_ticket_status' => 'required',
            'hhd_title' => 'required',
            'hhd_receiver_user_id' => 'required',
//            'hhd_verify' => 'required' ,
//            'hhd_file_atach' => 'required' ,
        ]);


        $help_desk = new HelpDesk();
//        $id = HelpDesk::select('id')->get()->last()->id + 1;


//        Tokenize
//---------------------------
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $last_date = HelpDesk::select('hhd_ticket_id')->get()->last()->hhd_ticket_id;
        $last_date = (explode("_", $last_date));
        $last_date = $last_date[2];
        $id = 0;
        if ($current_date == $last_date) {
            $id = $id + 1;
        } else {
            $id = 1;
        }
        $sub_total = "TK_" . sprintf("%04d", $id) . "_" . $current_date . "_" . $request->hhd_priority;
//        dd($sub_total);
        $help_desk->hhd_ticket_id = $sub_total;
        $help_desk->hhd_title = $request->hhd_title;
        $help_desk->hhd_type = $request->hhd_type;
        $help_desk->hhd_problem = $request->hhd_problem;
        $help_desk->hhd_priority = $request->hhd_priority;
        if ($request->hhd_ticket_status != null) {
            $help_desk->hhd_ticket_status = $request->hhd_ticket_status;
        } else {
            $help_desk->hhd_ticket_status = 1;
        }
        $help_desk->hhd_request_user_id = auth()->user()->id;
        $help_desk->hhd_receiver_user_id = $request->hhd_receiver_user_id;
        $help_desk->hhd_file_atach = $request->hhd_file_atach;
        $help_desk->save();
        return json_encode(["response" => "OK"]);

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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user = User::all();
        $ticket = TicketStatus::ALL();
        $help_desks = HelpDesk::find($id);
        return view('help_desk.edit', compact('help_desk','priority', 'type', 'ticket', 'user','help_desks','priority'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hhd_problem' => 'required',
            'hhd_priority' => 'required',
            'hhd_title' => 'required',
        ]);
        $help_desk = HelpDesk::find($id);
        $help_desk->hhd_title = $request->hhd_title;
        if ($request->hhd_type != null) {
            $help_desk->hhd_type = $request->hhd_type;
        }
        $help_desk->hhd_problem = $request->hhd_problem;
        if ($request->hhd_type != null) {
            $help_desk->hhd_priority = $request->hhd_priority;
        }
        $help_desk->hhd_ticket_status = $request->hhd_ticket_status;
//        $help_desk->hhd_file_atach = $request->hhd_file_atach;
        $help_desk->save();
        return redirect()->route('help_desk.index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد.');

    }


    public function receive_show($id)
    {
        $ticket = TicketStatus::ALL();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_verify','0')->get();
        $user = User::all();
        $help_desks = HelpDesk::find($id);
        $help_desks->hhd_ticket_status =2;
        $help_desks->save();
        return view('help_desk.receiver', compact('help_desk','priority','user','type','priority','help_desks','ticket'));
    }



    public function receive_verify(Request $request,$id)
    {
        $help_desk = HelpDesk::find($id);
        if($request->state == 3)
        {
            $help_desk->hhd_verify = 1;
        }
        $help_desk->hhd_ticket_status =$request->state;
        $help_desk->save();
        return json_encode(["response" => "OK"]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $help_desk = HelpDesk::find($id);
        $help_desk->delete();
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
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
