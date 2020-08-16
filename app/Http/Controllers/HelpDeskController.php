<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDReceiverUser;
use App\HDtype;
use App\HDTypeRole;
use App\HelpDesk;
use App\TicketStatus;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use carbon\carbon;
use Illuminate\Support\Facades\DB;

class HelpDeskController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $ticket_status = TicketStatus::all();
        $ticket = TicketStatus::ALL();
        $role_id = DB::table('hnt_hhd_help_desk_type_role')->join('model_has_roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'model_has_roles.role_id')->select('hnt_hhd_help_desk_type_role.hhd_type_id')->where('model_has_roles.model_id', $current_user)->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)->get();
        return view('help_desk.index', compact('role_id', 'ticket', 'help_desk', 'ticket_status', 'type', 'priority', 'user'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'hhd_type' => 'required',
            'hhd_problem' => 'required',
            'hhd_priority' => 'required',
            'hhd_title' => 'required',
        ]);


//        Tokenize
//---------------------------
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $help_desk_check = HelpDesk::all();
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

        //select receiver user
        $receive_user = HDReceiverUser::select('hhru_receive_user')->where('hhru_name', $request->hhd_type)->get();
        //end

        $size_name = count(collect($receive_user));
        if ($size_name == 1) {
            $help_desk = new HelpDesk();
            $help_desk->hhd_ticket_id = $sub_total;
            $help_desk->hhd_title = $request->hhd_title;
            $help_desk->hhd_type = $request->hhd_type;
            $help_desk->hhd_file_atach = $request->file;
            $help_desk->hhd_problem = $request->hhd_problem;
            $help_desk->hhd_priority = $request->hhd_priority;
            if ($request->hhd_ticket_status != null) {
                $help_desk->hhd_ticket_status = $request->hhd_ticket_status;
            } else {
                $help_desk->hhd_ticket_status = 1;
            }
            $help_desk->hhd_request_user_id = auth()->user()->id;
            $help_desk->hhd_receiver_user_id = $receive_user[0]->hhru_receive_user;
//        $help_desk->hhd_file_atach = $request->hhd_file_atach;
            $help_desk->save();
        } else {

            $index = 0;
            foreach ($receive_user as $receive_users) {
                $help_desk = new HelpDesk();
                $help_desk->hhd_ticket_id = $sub_total;
                $help_desk->hhd_title = $request->hhd_title;
                $help_desk->hhd_type = $request->hhd_type;
                $help_desk->hhd_file_atach = $request->file;
                $help_desk->hhd_problem = $request->hhd_problem;
                $help_desk->hhd_priority = $request->hhd_priority;
                if ($request->hhd_ticket_status != null) {
                    $help_desk->hhd_ticket_status = $request->hhd_ticket_status;
                } else {
                    $help_desk->hhd_ticket_status = 1;
                }
                $help_desk->hhd_request_user_id = auth()->user()->id;
                $help_desk->hhd_receiver_user_id = $receive_user[$index]->hhru_receive_user;
//        $help_desk->hhd_file_atach = $request->hhd_file_atach;
                $help_desk->save();
                $index++;
            }
        }

        return json_encode(["response" => "OK"]);

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
        $help_desk->hhd_response = $request->hhd_response;
        $help_desk->hhd_ticket_status = $request->state;
        $help_desk->save();
        $disable_other_request = HelpDesk::select('id')->where('hhd_ticket_id', $request->hhd_ticket_id)->where('hhd_response', Null)->get();
        $index = 0;
        foreach ($disable_other_request as $item) {
            HelpDesk::find($item->id)
                ->delete();
            $index++;
        }
        return json_encode(["response" => "OK"]);
    }

    public function destroy(Request $request, $id)
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
            $help_desk = DB::table('hnt_help_desk')
                ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                ->join('users', 'hnt_help_desk.hhd_receiver_user_id', '=', 'users.id')
                ->where('hnt_help_desk.hhd_request_user_id', '=', auth()->user()->id)
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')
                ->groupBy('hnt_help_desk.hhd_ticket_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $help_desk = DB::table('hnt_help_desk')
                ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                ->join('users', 'hnt_help_desk.hhd_receiver_user_id', '=', 'users.id')
                ->where('hnt_help_desk.hhd_request_user_id', '=', auth()->user()->id)
                ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')
                ->where('users.name', 'LIKE', "%$search%")
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->orwhere('hnt_help_desk.hhd_title', 'LIKE', "%$search%")
                ->orwhere('hnt_hd_priority.hdp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_ticket_status.ts_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($help_desk as $help_desks) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $help_desks->hhd_title . '",' . '"' . $help_desks->hhd_ticket_id . '",' . '"' . $help_desks->hdp_name . '",' . '"' . $help_desks->ts_name . '",' . '"' . $help_desks->th_name . '",' . '"' . $help_desks->created_at . '",' . '"' . $help_desks->hhd_problem . '",' . '"' . $help_desks->hhd_type . '",' . '"' . $help_desks->hhd_ticket_status . '",' . '"' . $help_desks->hhd_priority . '",' . '"' . $help_desks->hhd_request_user_id . '",' . '"' . $help_desks->hhd_receiver_user_id . '",' . '"' . $help_desks->hhd_file_atach . '",' . '"' . $help_desks->hhd_response . '",' . '"' . $help_desks->id . '"],';
        }
        $data = substr($data, 0, -1);
        $help_desks_count = HelpDesk::all()->count();
        return response('{ "recordsTotal":' . $help_desks_count . ',"recordsFiltered":' . $help_desks_count . ',"data": [' . $data . ']}');
    }

    public function fill_receiver(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            if ($sort && $orderable != '') {
                if ($sort == 1) {
                    $help_desk = DB::table('hnt_help_desk')
                        ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                        ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                        ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                        ->join('users', 'hnt_help_desk.hhd_request_user_id', '=', 'users.id')
                        ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')->skip($start)
                        ->where('hnt_help_desk.deleted_at', '=', Null)
                        ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                        ->orderBy('hnt_help_desk.hhd_title', $orderable)
                        ->take($length)
                        ->get();
                }
                if ($sort == 2) {
                    $help_desk = DB::table('hnt_help_desk')
                        ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                        ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                        ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                        ->join('users', 'hnt_help_desk.hhd_request_user_id', '=', 'users.id')
                        ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')->skip($start)
                        ->where('hnt_help_desk.deleted_at', '=', Null)
                        ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                        ->orderBy('users.username', $orderable)
                        ->take($length)
                        ->get();
                }
                if ($sort == 3) {
                    $help_desk = DB::table('hnt_help_desk')
                        ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                        ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                        ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                        ->join('users', 'hnt_help_desk.hhd_request_user_id', '=', 'users.id')
                        ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')->skip($start)
                        ->where('hnt_help_desk.deleted_at', '=', Null)
                        ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                        ->orderBy('hnt_hd_priority.hdp_name', $orderable)
                        ->take($length)
                        ->get();
                }
            } else {
                $help_desk = DB::table('hnt_help_desk')
                    ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                    ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                    ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                    ->join('users', 'hnt_help_desk.hhd_request_user_id', '=', 'users.id')
                    ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')->skip($start)
                    ->where('hnt_help_desk.deleted_at', '=', Null)
                    ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                    ->take($length)
                    ->get();
            }

        } else {
            $help_desk = DB::table('hnt_help_desk')
                ->join('hnt_ticket_status', 'hnt_help_desk.hhd_ticket_status', '=', 'hnt_ticket_status.id')
                ->join('hnt_th_type', 'hnt_help_desk.hhd_type', '=', 'hnt_th_type.id')
                ->join('hnt_hd_priority', 'hnt_help_desk.hhd_priority', '=', 'hnt_hd_priority.id')
                ->join('users', 'hnt_help_desk.hhd_request_user_id', '=', 'users.id')
                ->select('hnt_help_desk.id', 'hnt_help_desk.hhd_ticket_id', 'hnt_help_desk.hhd_title', 'hnt_help_desk.hhd_type', 'hnt_hd_priority.hdp_name', 'hnt_th_type.th_name', 'hnt_help_desk.hhd_problem', 'hnt_help_desk.hhd_ticket_status', 'hnt_help_desk.hhd_priority', 'hnt_ticket_status.ts_name', 'hnt_help_desk.hhd_request_user_id', 'hnt_help_desk.hhd_receiver_user_id', 'hnt_help_desk.hhd_file_atach', 'hnt_help_desk.created_at', 'hnt_help_desk.hhd_response', 'users.name as username')->skip($start)
                ->where('hnt_help_desk.deleted_at', '=', Null)
                ->where('hnt_help_desk.hhd_receiver_user_id', '=', auth()->user()->id)
                ->where('users.name', 'LIKE', "%$search%")
                ->orwhere('hnt_help_desk.hhd_title', 'LIKE', "%$search%")
                ->orwhere('hnt_hd_priority.hdp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_ticket_status.ts_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($help_desk as $help_desks) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $help_desks->hhd_title . '",' . '"' . $help_desks->username . '",' . '"' . $help_desks->hhd_ticket_id . '",' . '"' . $help_desks->hdp_name . '",' . '"' . $help_desks->ts_name . '",' . '"' . $help_desks->th_name . '",' . '"' . Verta($help_desks->created_at) . '",' . '"' . $help_desks->hhd_problem . '",' . '"' . $help_desks->hhd_type . '",' . '"' . $help_desks->hhd_ticket_status . '",' . '"' . $help_desks->hhd_priority . '",' . '"' . $help_desks->hhd_request_user_id . '",' . '"' . $help_desks->hhd_receiver_user_id . '",' . '"' . $help_desks->hhd_file_atach . '",' . '"' . $help_desks->hhd_response . '",' . '"' . $help_desks->id . '"],';
        }
        $data = substr($data, 0, -1);
        $help_desks_count = HelpDesk::all()->count();
        return response('{ "recordsTotal":' . $help_desks_count . ',"recordsFiltered":' . $help_desks_count . ',"data": [' . $data . ']}');
    }


//    upload file
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $file_name = $_FILES['file']['name'];

        if (isset($file)) {

            $current_date = Verta::now();
//            $file_name = $current_date . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists('img/help_desk_request')) {
                mkdir('img/help_desk_request', 0777, true);
            }
            $file->move('img/help_desk_request', $file_name);
        } else {
            $file_name = 'default.png';
        }

        return response()->json(['link' => '/img/help_desk_request/' . $file_name]);
    }

    public function show($id)
    {
        $help_desks = HelpDesk::find($id);
        $help_desks->hhd_ticket_status = 2;
        $help_desks->save();


//        $users = User::select('name')->where('id', $help_desks->hcv_request_user_id)->get()->last();
        $type_current = HDtype::select('th_name')->where('id', $help_desks->hhd_type)->get()->last();
        $priority_current = HDpriority::select('hdp_name')->where('id', $help_desks->hhd_type)->get()->last();
        $help_desk_current = HelpDesk::where('hhd_ticket_status', '1')->get();
        $ticket_status_current = TicketStatus::select('ts_name')->where('id', $help_desks->hhd_ticket_status)->get()->last();

        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $ticket_status = TicketStatus::all();

        return view('help_desk.receive_show', compact('type_current','priority_current','help_desk_current','ticket_status_current','users','help_desks', 'ticket', 'help_desk', 'ticket_status', 'type', 'priority', 'user'));


    }
}
