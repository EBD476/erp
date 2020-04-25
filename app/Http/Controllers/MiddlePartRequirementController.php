<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\MiddlePartRequirement;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class MiddlePartRequirementController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('middle_part_requirement.index', compact('middle_part_requirement', 'type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hmpr_middle_part_id' => 'required',
            'hmpr_middle_part_count' => 'required',
            'hmpr_comment' => 'required',
        ]);

        $middle_part_requirement = new MiddlePartRequirement();
        $middle_part_requirement->hmpr_middle_part_id = $request->hmpr_middle_part_id;
        $middle_part_requirement->hmpr_middle_part_count = $request->hmpr_middle_part_count;
        $middle_part_requirement->hmpr_comment = $request->hmpr_comment;
        $middle_part_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hmpr_middle_part_id' => 'required',
            'hmpr_middle_part_count' => 'required',
            'hmpr_comment' => 'required',
        ]);
        $middle_part_requirement = MiddlePartRequirement::find($id);
        $middle_part_requirement->hmpr_middle_part_id = $request->hmpr_middle_part_id;
        $middle_part_requirement->hmpr_middle_part_count = $request->hmpr_middle_part_count;
        $middle_part_requirement->hmpr_comment = $request->hmpr_comment;
        $middle_part_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    public function destroy($id)
    {
        $middle_part_requirement = MiddlePartRequirement::find($id);
        $middle_part_requirement->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $middle_part_requirement = DB::table('hnt_middle_part_requirements')
                ->join('hnt_middle_part', 'hnt_middle_part_requirements.hmpr_middle_part_id', '=', 'hnt_middle_part.id')
                ->select('hnt_middle_part_requirements.id', 'hnt_middle_part_requirements.hmpr_middle_part_id', 'hnt_middle_part_requirements.hmpr_middle_part_count', 'hnt_middle_part_requirements.hmpr_comment', 'hnt_middle_part.hmp_name')
                ->where('hnt_middle_part_requirements.deleted_at','=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $middle_part_requirement = DB::table('hnt_middle_part_requirements')
                ->join('hnt_middle_part', 'hnt_middle_part_requirements.hmpr_middle_part_id', '=', 'hnt_middle_part.id')
                ->select('hnt_middle_part_requirements.id', 'hnt_middle_part_requirements.hmpr_middle_part_id', 'hnt_middle_part_requirements.hmpr_middle_part_count', 'hnt_middle_part_requirements.hmpr_comment', 'hnt_middle_part.hmp_name')
                ->where('hnt_middle_part_requirements.deleted_at','=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($middle_part_requirement as $middle_part_requirements) {
            $data .= '["' . $middle_part_requirements->id . '",' . '"' . $middle_part_requirements->hmp_name . '",' . '"' . $middle_part_requirements->hmpr_middle_part_count . '",' . '"' . $middle_part_requirements->hmpr_comment . '",' . '"' . $middle_part_requirements->hmpr_middle_part_id . '"],';
        }
        $data = substr($data, 0, -1);
        $middle_part_requirements_count = MiddlePartRequirement::all()->count();
        return response('{ "recordsTotal":' . $middle_part_requirements_count . ',"recordsFiltered":' . $middle_part_requirements_count . ',"data": [' . $data . ']}');
    }
}
