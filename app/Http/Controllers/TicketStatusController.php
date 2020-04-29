<?php

namespace App\Http\Controllers;

use App\TicketStatus;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class TicketStatusController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('help_desk.ticket_status.index', compact('ticket', 'help_desk', 'priority', 'type', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ts_name' => 'required'
        ]);
        $ticket = new TicketStatus();
        $ticket->ts_name = $request->ts_name;
        $ticket->save();
        return json_encode(["response" => "ok"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ts_name' => 'required'
        ]);
        $ticket = TicketStatus::find($id);
        $ticket->ts_name = $request->ts_name;
        $ticket->save();
        return json_encode(["response" => "ok"]);
    }

    public function destroy(Request $request, $id)
    {
        $ticket = TicketStatus::find($id);
        $ticket->delete();
        return json_encode(["response" => "ok"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $ticket = TicketStatus::select('id', 'ts_name')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $ticket = TicketStatus::select('id', 'ts_name')
                ->where('id', 'LIKE', "%$search%")
                ->where('ts_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($ticket as $tickets) {
            $data .= '["' . $tickets->id . '",' . '"' . $tickets->ts_name . '"],';
        }
        $data = substr($data, 0, -1);
        $tickets_count = TicketStatus::all()->count();
        return response('{ "recordsTotal":' . $tickets_count . ',"recordsFiltered":' . $tickets_count . ',"data": [' . $data . ']}');
    }
}
