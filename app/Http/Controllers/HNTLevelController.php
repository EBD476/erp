<?php

namespace App\Http\Controllers;

use App\HNTLevel;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class HNTLevelController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('hnt-level.index', compact('level', 'help_desk', 'priority', 'type', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_process_name' => 'required',
            'hp_process_id' => 'required'
        ]);
        $level = New HNTLevel();
        $level->hp_process_name = $request->hp_process_name;
        $level->hp_process_id = $request->hp_process_id;
        $level->save();
        return json_encode(["response" => "OK"]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hp_process_name' => 'required',
            'hp_process_id' => 'required'
        ]);
        $level = HNTLevel:: find($id);
        $level->hp_process_name = $request->hp_process_name;
        $level->hp_process_id = $request->hp_process_id;
        $level->save();
        return json_encode(["response" => "ok"]);
    }

    public function destroy($id)
    {
        $level = HNTLevel::find($id);
        $level->delete();
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
            $level = HNTLevel::select('id', 'hp_process_id', 'hp_process_name')
                ->orderby('hp_process_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $level = HNTLevel::select('id', 'hp_process_id', 'hp_process_name')
                ->where('id', 'LIKE', "%$search%")
                ->orwhere('hp_process_id', 'LIKE', "%$search%")
                ->orwhere('hp_process_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($level as $levels) {
            $data .= '["' . $levels->hp_process_id . '",' . '"' . $levels->hp_process_name . '",' . '"' . $levels->id . '"],';
        }
        $data = substr($data, 0, -1);
        $levels_count = HNTLevel::all()->count();
        return response('{ "recordsTotal":' . $levels_count . ',"recordsFiltered":' . $levels_count . ',"data": [' . $data . ']}');
    }
}
