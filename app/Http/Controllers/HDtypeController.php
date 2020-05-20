<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HelpDesk;
use App\HDtype;
use App\User;
use Illuminate\Http\Request;

class HDtypeController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('help_desk.hd_type.index', compact('type', 'help_desk', 'priority', 'type', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'th_name' => 'required'
        ]);
        $type = New HDtype();
        $type->th_name = $request->th_name;
        $type->save();
        return json_encode(["response" => "Done"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'th_name' => 'required'
        ]);
        $type = HDtype:: find($id);
        $type->th_name = $request->th_name;
        $type->save();
        return json_encode(["response" => "Done"]);
    }

    public function destroy(Request $request, $id)
    {
        $type = HDtype::find($id);
        $type->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $type = HDtype::select('id', 'th_name')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $type = HDtype::select('id', 'th_name')
                ->where('id', 'LIKE', "%$search%")
                ->orwhere('th_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($type as $types) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $types->th_name . '",' . '"' . $types->id . '"],';
        }
        $data = substr($data, 0, -1);
        $types_count = HDtype::all()->count();
        return response('{ "recordsTotal":' . $types_count . ',"recordsFiltered":' . $types_count . ',"data": [' . $data . ']}');
    }
}
