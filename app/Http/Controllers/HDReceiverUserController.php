<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDReceiverUser;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class HDReceiverUserController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('hd_receiver_user.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hhru_name' => 'required',
            'hhru_receive_user' => 'required',
        ]);
        $receiver = new HDReceiverUser();
        $receiver->hhru_name = $request->hhru_name;
        $receiver->hhru_receive_user = $request->hhru_receive_user;
        $receiver->save();
        return json_encode(["response" => "OK", "receiver" => $receiver->hhru_name , "receiver-id" =>$receiver->id]);
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
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $receiver = HDReceiverUser::select('id', 'hhru_name', 'hhru_receive_user')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $receiver = HDReceiverUser::select('id', 'hhru_name', 'hhru_receive_user')
                ->where('hhru_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($receiver as $receivers) {
            $data .= '["' . $receivers->id . '",' . '"' . $receivers->hhru_name . '",' . '"' . $receivers->hhru_receive_user . '"],';
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

            $receiver = HDReceiverUser::select('hhru_name as text', 'id')->where('hhru_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $receiver]);
    }
}
