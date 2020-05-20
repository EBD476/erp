<?php

namespace App\Http\Controllers;

use App\DataUser;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Process;
use App\ProcessLevel;
use App\User;
use App\Verifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifierController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $process = ProcessLevel::all();
        return view('verifier.index', compact('process', 'help_desk', 'priority', 'type', 'user'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'process_id' => 'required',
                'hp_priority' => 'required',
                'hp_verifier_id' => 'required',

            ]);
        $verifier = new Verifier();
        $verifier->process_id = $request->process_id;
        $verifier->hp_priority = $request->hp_priority;
        $verifier->hp_verifier_id = $request->hp_verifier_id;
        $verifier->save();
        return json_encode(["response" => "OK"]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'process_id' => 'required',
            'hp_priority' => 'required',
            'hp_verifier_id' => 'required',

        ]);
        $verifier = Verifier::find($id);
        $verifier->process_id = $request->process_id;
        $verifier->hp_priority = $request->hp_priority;
        $verifier->hp_verifier_id = $request->hp_verifier_id;
        $verifier->save();
        return json_encode(["response" => "OK"]);


    }

    public function destroy($id)
    {
        $verifier = Verifier::find($id);
        $verifier->delete();
        return json_encode(["response" => "OK"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $verifier = DB::Table('hnt_process_verifiers')
                ->join('users', 'hnt_process_verifiers.hp_verifier_id', 'users.id')
                ->join('hnt_process', 'hnt_process_verifiers.process_id', 'hnt_process.id')
                ->select('hnt_process_verifiers.id', 'hnt_process_verifiers.hp_verifier_id', 'hnt_process_verifiers.hp_priority', 'hnt_process_verifiers.process_id', 'users.name', 'hnt_process.hp_process_name')
                ->where('hnt_process_verifiers.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $verifier = DB::Table('hnt_process_verifiers')
                ->join('users', 'hnt_process_verifiers.hp_verifier_id', 'users.id')
                ->join('hnt_process', 'hnt_process_verifiers.process_id', 'hnt_process.id')
                ->select('hnt_process_verifiers.id', 'hnt_process_verifiers.hp_verifier_id', 'hnt_process_verifiers.hp_priority', 'hnt_process_verifiers.process_id', 'users.name', 'hnt_process.hp_process_name')
                ->where('hnt_process_verifiers.deleted_at', '=', Null)
                ->where('hnt_process.hp_process_name', 'LIKE', "%$search%")
                ->orwhere('users.name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($verifier as $verifiers) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $verifiers->hp_process_name . '",' . '"' . $verifiers->name . '",' . '"' . $verifiers->hp_priority . '",' . '"' . $verifiers->hp_verifier_id . '",' . '"' . $verifiers->process_id . '",' . '"' . $verifiers->id . '"],';
        }
        $data = substr($data, 0, -1);
        $verifiers_count = Verifier::all()->count();
        return response('{ "recordsTotal":' . $verifiers_count . ',"recordsFiltered":' . $verifiers_count . ',"data": [' . $data . ']}');
    }
}