<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Support\Facades\DB;

class PositionUserController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('position_user.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpu_name' => 'required',
            'hpu_code' => 'required',
        ]);
        $position = new Position();
        $position->hpu_name = $request->hpu_name;
        $position->hpu_code = $request->hpu_code;
        $position->save();
        return json_encode(["response" => "OK", "receiver" => $position->hhru_name, "receiver-id" => $position->id]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpu_name' => 'required',
            'hpu_code' => 'required',
        ]);
        $position = Position::find($id);
        $position->hpu_name = $request->hpu_name;
        $position->hpu_code = $request->hpu_code;
        $position->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();
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
            $position = DB::Table('hnt_position_user')
                ->select('hnt_position_user.id', 'hnt_position_user.hpu_name', 'hnt_position_user.hpu_code')
                ->where('hnt_position_user.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $position = DB::Table('hnt_position_user')
                ->select('hnt_position_user.id', 'hnt_position_user.hpu_name', 'hnt_position_user.hpu_code')
                ->where('hnt_position_user.deleted_at', '=', Null)
                ->where('hnt_position_user.hpu_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($position as $positions) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $positions->hpu_name . '",' . '"' . $positions->hpu_code . '",' . '"' . $positions->id . '"],';
        }
        $data = substr($data, 0, -1);
        $position_count = Position::all()->count();
        return response('{ "recordsTotal":' . $position_count . ',"recordsFiltered":' . $position_count . ',"data": [' . $data . ']}');
    }

//fill select to
//    public function fill_data_position(Request $request)
//    {
//        $search = $request->search;
//        if ($search != "") {
//
//            $position = DB::table('users')->join('hnt_position_user', 'users.position', 'hnt_position_user.id')
//                ->select('users.name as text', 'users.id', 'hnt_position_user.hpu_name as position')
//                ->where('users.name', 'LIKE', "%$search%")
//                ->get();
//        }
//        return json_encode(["results" => $position]);
//    }
}
