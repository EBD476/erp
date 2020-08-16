<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDReceiverUser;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HDReceiverUserController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('help_desk.hd_receiver_user.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hhru_name' => 'required',
            'hhru_receive_user' => 'required',
        ]);
        $size_name = count(collect($request)->get('hhru_receive_user'));
        if ($size_name == 1) {
            $receiver = new HDReceiverUser();
            $receiver->hhru_name = $request->hhru_name;
            $receiver->hhru_receive_user = $request->hhru_receive_user[0];
            $receiver->save();
        } else {
            $item = $request->hhru_receive_user;
            $index = 0;
            foreach ($item as $items) {
                $receiver = new HDReceiverUser();
                $receiver->hhru_name = $request->hhru_name;
                $receiver->hhru_receive_user = $request->hhru_receive_user[$index];
                $receiver->save();
                $index++;
            }
        }
        return json_encode(["response" => "OK", "receiver" => $receiver->hhru_name, "receiver-id" => $receiver->id]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hhru_name' => 'required',
            'hhru_receive_user' => 'required',
        ]);
        $receiver = HDReceiverUser::find($id);
        $receiver->hhru_name = $request->hhru_name;
        $receiver->hhru_receive_user = $request->hhru_receive_user;
        $receiver->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $receiver = HDReceiverUser::find($id);
        $receiver->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            if ($sort && $orderable != '') {
                if ($sort == 1) {
                    $receiver = DB::Table('hnt_hd_receiver_user')
                        ->join('hnt_th_type', 'hnt_hd_receiver_user.hhru_name', 'hnt_th_type.id')
                        ->join('users', 'hnt_hd_receiver_user.hhru_receive_user', 'users.id')
                        ->select('hnt_hd_receiver_user.id', 'hnt_hd_receiver_user.hhru_name', 'hnt_hd_receiver_user.hhru_receive_user', 'hnt_th_type.th_name', 'users.name')
                        ->where('hnt_hd_receiver_user.deleted_at', '=', Null)
                        ->orderBy('users.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if ($sort == 2) {
                    $receiver = DB::Table('hnt_hd_receiver_user')
                        ->join('hnt_th_type', 'hnt_hd_receiver_user.hhru_name', 'hnt_th_type.id')
                        ->join('users', 'hnt_hd_receiver_user.hhru_receive_user', 'users.id')
                        ->select('hnt_hd_receiver_user.id', 'hnt_hd_receiver_user.hhru_name', 'hnt_hd_receiver_user.hhru_receive_user', 'hnt_th_type.th_name', 'users.name')
                        ->where('hnt_hd_receiver_user.deleted_at', '=', Null)
                        ->orderBy('hnt_th_type.th_name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if ($sort == 3) {
                    $receiver = DB::Table('hnt_hd_receiver_user')
                        ->join('hnt_th_type', 'hnt_hd_receiver_user.hhru_name', 'hnt_th_type.id')
                        ->join('users', 'hnt_hd_receiver_user.hhru_receive_user', 'users.id')
                        ->select('hnt_hd_receiver_user.id', 'hnt_hd_receiver_user.hhru_name', 'hnt_hd_receiver_user.hhru_receive_user', 'hnt_th_type.th_name', 'users.name')
                        ->where('hnt_hd_receiver_user.deleted_at', '=', Null)
                        ->orderBy('hnt_hd_receiver_user.hhru_name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
            } else {
                $receiver = DB::Table('hnt_hd_receiver_user')
                    ->join('hnt_th_type', 'hnt_hd_receiver_user.hhru_name', 'hnt_th_type.id')
                    ->join('users', 'hnt_hd_receiver_user.hhru_receive_user', 'users.id')
                    ->select('hnt_hd_receiver_user.id', 'hnt_hd_receiver_user.hhru_name', 'hnt_hd_receiver_user.hhru_receive_user', 'hnt_th_type.th_name', 'users.name')
                    ->where('hnt_hd_receiver_user.deleted_at', '=', Null)
                    ->skip($start)
                    ->take($length)
                    ->get();
            }
        } else {
            $receiver = DB::Table('hnt_hd_receiver_user')
                ->join('hnt_th_type', 'hnt_hd_receiver_user.hhru_name', 'hnt_th_type.id')
                ->join('users', 'hnt_hd_receiver_user.hhru_receive_user', 'users.id')
                ->select('hnt_hd_receiver_user.id', 'hnt_hd_receiver_user.hhru_name', 'hnt_hd_receiver_user.hhru_receive_user', 'hnt_th_type.th_name', 'users.name')
                ->where('hnt_hd_receiver_user.deleted_at', '=', Null)
                ->where('hhru_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($receiver as $receivers) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $receivers->name . '",' . '"' . $receivers->th_name . '",' . '"' . $receivers->hhru_name . '",' . '"' . $receivers->hhru_receive_user . '",' . '"' . $receivers->id . '"],';
        }
        $data = substr($data, 0, -1);
        $receivers_count = HDReceiverUser::all()->count();
        return response('{ "recordsTotal":' . $receivers_count . ',"recordsFiltered":' . $receivers_count . ',"data": [' . $data . ']}');
    }

//fill select to
    public function fill_data_receiver(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $receiver = DB::table('users')->join('hnt_position_user', 'users.position', 'hnt_position_user.id')
                ->select('users.name as text', 'users.id', 'hnt_position_user.hpu_name as position')
                ->where('users.name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $receiver]);
    }

    //fill select to
    public function fill_type_ticket(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $receiver = HDtype::select('th_name as text', 'id')->where('th_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $receiver]);
    }
}
