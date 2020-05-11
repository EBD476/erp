<?php

namespace App\Http\Controllers;

use App\PartRequirement;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class PartRequirementController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $part_requirement = PartRequirement:: all();
        return view('part_requirement.index', compact('part_requirement', 'type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpr_part_id' => 'required',
            'hpr_part_count' => 'required',
            'hpr_comment' => 'required',
        ]);

        $part_requirement = new PartRequirement();
        $part_requirement->hpr_part_id = $request->hpr_part_id;
        $part_requirement->hpr_part_count = $request->hpr_part_count;
        $part_requirement->hpr_comment = $request->hpr_comment;
        $part_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $part_requirement = PartRequirement::find($id);
        return view('part_requirement.edit', compact('part_requirement', 'type', 'priority', 'help_desk', 'user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpr_part_id' => 'required',
            'hpr_part_count' => 'required',
            'hpr_comment' => 'required',
        ]);
        $part_requirement = PartRequirement::find($id);
        $part_requirement->hpr_part_id = $request->hpr_part_id;
        $part_requirement->hpr_part_count = $request->hpr_part_count;
        $part_requirement->hpr_comment = $request->hpr_comment;
        $part_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    public function destroy($id)
    {
        $part_requirement = PartRequirement::find($id);
        $part_requirement->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $part_requirement =DB::table('hnt_part_requirements')
                ->join('hnt_parts', 'hnt_part_requirements.hpr_part_id', '=', 'hnt_parts.id')
                ->select('hnt_part_requirements.id', 'hnt_part_requirements.hpr_part_id', 'hnt_part_requirements.hpr_part_count', 'hnt_part_requirements.hpr_comment', 'hnt_parts.hp_name')
                ->where('hnt_part_requirements.deleted_at','=', Null)
                ->skip($start)->take($length)->get();
        } else {
            $part_requirement = DB::table('hnt_part_requirements')
                ->join('hnt_parts', 'hnt_part_requirements.hpr_part_id', '=', 'hnt_parts.id')
                ->select('hnt_part_requirements.id', 'hnt_part_requirements.hpr_part_id', 'hnt_part_requirements.hpr_part_count', 'hnt_part_requirements.hpr_comment', 'hnt_parts.hp_name')
                ->where('hnt_part_requirements.deleted_at','=', Null)
                ->where('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($part_requirement as $part_requirements) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $part_requirements->hp_name . '",' . '"' . $part_requirements->hpr_part_count . '",' . '"' . $part_requirements->hpr_comment . '",' . '"' . $part_requirements->hpr_part_id . '",' . '"' . $part_requirements->id . '"],';
        }
        $data = substr($data, 0, -1);
        $part_requirements_count = PartRequirement::all()->count();
        return response('{ "recordsTotal":' . $part_requirements_count . ',"recordsFiltered":' . $part_requirements_count . ',"data": [' . $data . ']}');
    }

}
