<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\TicketStatus;
use App\User;
use Illuminate\Http\Request;
use carbon\carbon;
use Illuminate\Support\Facades\DB;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $ticket_status = TicketStatus::all();
        $ticket = TicketStatus::ALL();
        return view('help_desk.index', compact('ticket','help_desks_user', 'help_desk', 'ticket_status', 'help_desks', 'type', 'priority', 'help_desks', 'user'));
    }


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


//        Tokenize
//---------------------------
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $help_desk_check=HelpDesk::all();
        if ($help_desk_check->isEmpty()) {
            $sub_total = "TK_" . $current_date . "_" . $current_date . "_" . $request->hhd_priority;

        } else {
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
        }

        $help_desk = new HelpDesk();
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
//        $help_desk->hhd_file_atach = $request->hhd_file_atach;
        $help_desk->save();
        return json_encode(["response" => "OK"]);

    }


    public function edit($id)
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $user = User::all();
        $ticket = TicketStatus::ALL();
        $help_desks = HelpDesk::find($id);
        return view('help_desk.edit', compact('help_desk', 'priority', 'type', 'ticket', 'user', 'help_desks', 'priority'));
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
        $help_desks = HelpDesk::find($id);
        $help_desks->hhd_ticket_status = 2;
        $help_desks->save();
        return json_encode(["response" => "OK"]);

    }


    public function receive_verify(Request $request, $id)
    {
        $help_desk = HelpDesk::find($id);
        if ($request->state == 3) {
            $help_desk->hhd_verify = 1;
        }
        $help_desk->hhd_ticket_status = $request->state;
        $help_desk->save();

        return json_encode(["response" => "OK"]);
    }


    public function destroy(Request $request,$id)
    {
        $help_desk = HelpDesk::find($id);
        $help_desk->delete();
        return json_encode(["response" => "OK"]);
    }

    public function fill_sender(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $help_desk =DB::table('hnt_help_desk')
                ->join('hnt_ticket_status','hnt_help_desk.hhd_ticket_status','=','hnt_ticket_status.id')
                ->join('hnt_th_type','hnt_help_desk.hhd_type','=','hnt_th_type.id')
                ->join('hnt_hd_priority','hnt_help_desk.hhd_priority','=','hnt_hd_priority.id')
                ->join('users','hnt_help_desk.hhd_receiver_user_id','=','users.id')
                ->where('hnt_help_desk.hhd_request_user_id', '=', auth()->user()->id)
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->select('hnt_help_desk.id','hnt_help_desk.hhd_ticket_id','hnt_help_desk.hhd_title','hnt_help_desk.hhd_type','hnt_hd_priority.hdp_name','hnt_th_type.th_name','hnt_help_desk.hhd_problem','hnt_help_desk.hhd_ticket_status','hnt_help_desk.hhd_priority','hnt_ticket_status.ts_name','hnt_help_desk.hhd_request_user_id','hnt_help_desk.hhd_receiver_user_id','hnt_help_desk.hhd_file_atach','hnt_help_desk.created_at','users.name as username')->skip($start)
                ->take($length)
                ->get();
        } else {
            $help_desk =DB::table('hnt_help_desk')
                ->join('hnt_ticket_status','hnt_help_desk.hhd_ticket_status','=','hnt_ticket_status.id')
                ->join('hnt_th_type','hnt_help_desk.hhd_type','=','hnt_th_type.id')
                ->join('hnt_hd_priority','hnt_help_desk.hhd_priority','=','hnt_hd_priority.id')
                ->join('users','hnt_help_desk.hhd_receiver_user_id','=','users.id')
                ->where('hnt_help_desk.hhd_request_user_id', '=', auth()->user()->id)
                ->select('hnt_help_desk.id','hnt_help_desk.hhd_ticket_id','hnt_help_desk.hhd_title','hnt_help_desk.hhd_type','hnt_hd_priority.hdp_name','hnt_th_type.th_name','hnt_help_desk.hhd_problem','hnt_help_desk.hhd_ticket_status','hnt_help_desk.hhd_priority','hnt_ticket_status.ts_name','hnt_help_desk.hhd_request_user_id','hnt_help_desk.hhd_receiver_user_id','hnt_help_desk.hhd_file_atach','hnt_help_desk.created_at','users.name as username')->skip($start)
                ->where('users.name', 'LIKE', "%$search%")
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->orwhere('hnt_help_desk.hhd_title', 'LIKE', "%$search%")
                ->orwhere('hnt_hd_priority.hdp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_ticket_status.ts_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($help_desk as $help_desks) {
            $data .= '["' . $help_desks->id . '",' . '"' . $help_desks->hhd_title . '",' . '"' . $help_desks->username . '",' . '"' . $help_desks->hhd_ticket_id . '",' . '"' . $help_desks->hdp_name . '",' . '"' . $help_desks->ts_name . '",' . '"' . $help_desks->th_name . '",' . '"' . $help_desks->created_at . '",' . '"' . $help_desks->hhd_problem . '",' . '"' . $help_desks->hhd_type . '",' . '"' . $help_desks->hhd_ticket_status . '",' . '"' . $help_desks->hhd_priority . '",' . '"' . $help_desks->hhd_request_user_id . '",' . '"' . $help_desks->hhd_receiver_user_id . '",' . '"' . $help_desks->hhd_file_atach . '"],';
        }
        $data = substr($data, 0, -1);
        $help_desks_count = HelpDesk::all()->count();
        return response('{ "recordsTotal":' . $help_desks_count . ',"recordsFiltered":' . $help_desks_count . ',"data": [' . $data . ']}');
    }

    public function fill_receiver(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $help_desk =DB::table('hnt_help_desk')
                ->join('hnt_ticket_status','hnt_help_desk.hhd_ticket_status','=','hnt_ticket_status.id')
                ->join('hnt_th_type','hnt_help_desk.hhd_type','=','hnt_th_type.id')
                ->join('hnt_hd_priority','hnt_help_desk.hhd_priority','=','hnt_hd_priority.id')
                ->join('users','hnt_help_desk.hhd_request_user_id','=','users.id')
                ->select('hnt_help_desk.id','hnt_help_desk.hhd_ticket_id','hnt_help_desk.hhd_title','hnt_help_desk.hhd_type','hnt_hd_priority.hdp_name','hnt_th_type.th_name','hnt_help_desk.hhd_problem','hnt_help_desk.hhd_ticket_status','hnt_help_desk.hhd_priority','hnt_ticket_status.ts_name','hnt_help_desk.hhd_request_user_id','hnt_help_desk.hhd_receiver_user_id','hnt_help_desk.hhd_file_atach','hnt_help_desk.created_at','users.name as username')->skip($start)
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                ->take($length)
                ->get();
        } else {
            $help_desk =DB::table('hnt_help_desk')
                ->join('hnt_ticket_status','hnt_help_desk.hhd_ticket_status','=','hnt_ticket_status.id')
                ->join('hnt_th_type','hnt_help_desk.hhd_type','=','hnt_th_type.id')
                ->join('hnt_hd_priority','hnt_help_desk.hhd_priority','=','hnt_hd_priority.id')
                ->join('users','hnt_help_desk.hhd_request_user_id','=','users.id')
                ->select('hnt_help_desk.id','hnt_help_desk.hhd_ticket_id','hnt_help_desk.hhd_title','hnt_help_desk.hhd_type','hnt_hd_priority.hdp_name','hnt_th_type.th_name','hnt_help_desk.hhd_problem','hnt_help_desk.hhd_ticket_status','hnt_help_desk.hhd_priority','hnt_ticket_status.ts_name','hnt_help_desk.hhd_request_user_id','hnt_help_desk.hhd_receiver_user_id','hnt_help_desk.hhd_file_atach','hnt_help_desk.created_at','users.name as username')->skip($start)
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                ->where('users.name', 'LIKE', "%$search%")
                ->orwhere('hnt_help_desk.hhd_title', 'LIKE', "%$search%")
                ->orwhere('hnt_hd_priority.hdp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_ticket_status.ts_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($help_desk as $help_desks) {
            $data .= '["' . $help_desks->id . '",' . '"' . $help_desks->hhd_title . '",' . '"' . $help_desks->username . '",' . '"' . $help_desks->hhd_ticket_id . '",' . '"' . $help_desks->hdp_name . '",' . '"' . $help_desks->ts_name . '",' . '"' . $help_desks->th_name . '",' . '"' . $help_desks->created_at . '",' . '"' . $help_desks->hhd_problem . '",' . '"' . $help_desks->hhd_type . '",' . '"' . $help_desks->hhd_ticket_status . '",' . '"' . $help_desks->hhd_priority . '",' . '"' . $help_desks->hhd_request_user_id . '",' . '"' . $help_desks->hhd_receiver_user_id . '",' . '"' . $help_desks->hhd_file_atach . '"],';
        }
        $data = substr($data, 0, -1);
        $help_desks_count = HelpDesk::all()->count();
        return response('{ "recordsTotal":' . $help_desks_count . ',"recordsFiltered":' . $help_desks_count . ',"data": [' . $data . ']}');
    }
}
