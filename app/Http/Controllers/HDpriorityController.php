<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\User;
use Illuminate\Http\Request;
use App\HDtype;
use App\HelpDesk;

class HDpriorityController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('priority.index', compact('priority', 'help_desk', 'type', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hdp_name' => 'required'
        ]);
        $priority = New HDpriority();
        $priority->hdp_name = $request->hdp_name;
        $priority->save();
        return json_encode(["response" => "Done"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hdp_name' => 'required'
        ]);
        $priority = HDpriority:: find($id);
        $priority->hdp_name = $request->hdp_name;
        $priority->save();
        return json_encode(["response" => "Done"]);
    }

    public function destroy(Request $request, $id)
    {
        $priority = HDpriority::find($id);
        $priority->delete();
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
                    $priority = HDpriority::select('id', 'hdp_name')
                        ->orderBy('hdp_name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
            } else {
                $priority = HDpriority::select('id', 'hdp_name')
                    ->skip($start)
                    ->take($length)
                    ->get();
            }
        } else {
            $priority = HDpriority::select('id', 'hdp_name')
                ->where('id', 'LIKE', "%$search%")
                ->orwhere('hdp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($priority as $priorities) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $priorities->hdp_name . '",' . '"' . $priorities->id . '"],';
        }
        $data = substr($data, 0, -1);
        $priority_count = HDpriority::all()->count();
        return response('{ "recordsTotal":' . $priority_count . ',"recordsFiltered":' . $priority_count . ',"data": [' . $data . ']}');
    }
}
