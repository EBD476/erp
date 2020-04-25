<?php

namespace App\Http\Controllers;

use App\Project;
use App\Project_State;
use App\Project_Type;
use App\Support;
use App\SupportStatus;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use phpDocumentor\Reflection\Types\Compound;

class ProjectController extends Controller
{

    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $projects = Project::all();
        return view('projects.index', compact('projects','user','support_response','type','help_desk','priority'));
    }

    public function create()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $projects_type = Project_Type::ALL();
        $projects = Project_State::ALL();
        return view('projects.create', compact('projects', 'projects_type','user','support_response','type','help_desk','priority'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'project_name' => 'required',
            'project_owner' => 'required',
            'owner_phone' => 'required',
            'project_type' => 'required',
            'project_units' => 'required',
            'project_address' => 'required',
            'project_location' => 'required',
//            'project_options' => 'required' ,
            'project_completed' => 'required',
            'project_complete_date' => 'required',
            'project_description' => 'required',
        ]);

        $Project = new Project();
        $Project->hp_project_name = $request->project_name;
        $Project->hp_project_owner = $request->project_owner;
        $Project->hp_project_owner_phone = $request->owner_phone;
        $Project->hp_project_type = $request->project_type;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_completed = $request->project_completed;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();

        return json_encode(["response" => "OK"]);

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $projects_state = Project_State::all();
        $projects_type = Project_Type::ALL();
        $project = Project::find($id);
        return view('projects.edit', compact('project', 'projects_type', 'projects_state','user','support_response','type','help_desk','priority'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'project_name' => 'required',
            'project_owner' => 'required',
            'owner_phone' => 'required',
            'project_type' => 'required',
            'project_units' => 'required',
            'project_address' => 'required',
            'project_location' => 'required',
//            'project_options' => 'required' ,
            'project_completed' => 'required',
            'project_complete_date' => 'required',
            'project_description' => 'required',
        ]);

        $Project = Project::find($id);
        $Project->hp_project_name = $request->project_name;
        $Project->hp_project_owner = $request->project_owner;
        $Project->hp_project_owner_phone = $request->owner_phone;
        $Project->hp_project_type = $request->project_type;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_completed = $request->project_completed;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();
        return view('projects.index');
    }

    public function destroy($id)
    {
        $Project = Project::find($id);
        $Project->delete();
        return redirect()->back();

    }

    public function send_request($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $request_support = Project::find($id);
        return view('projects.support_request', compact('request_support', 'user','support_response','type','help_desk','priority'));
    }

    public function support_request(Request $request)
    {
        $request_support = new Support();
        $request_support->hs_project_id = $request->id;
        $request_support->hs_request_user_id = auth()->user()->id;
        $request_support->hs_title = $request->title;
        $request_support->hs_status = 1;
        $request_support->hs_show = 0;
        $request_support->hs_description = $request->description;
        $request_support->save();
        $sequence = SupportStatus::select('id')->where('hss_sequence', '1')->first();

        Project::where('id', $request->id)
            ->update(['hp_status' => $sequence->id]);
        return json_encode(["response" => "OK"]);

    }

    public function show_response($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $request = Support::where('id', $id)->first();
        $project = Project::where('id', $request->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        return view('projects.show_response_data', compact('project', 'request', 'project_type','user','support_response','type','help_desk','priority'));
    }

    public function show_all_response()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response =Support::where('hs_show','0')->get();
        $request = Support::where('hs_status', '2')->get();
        $support_state = SupportStatus::ALL();
        $project = Project::all();
        return view('projects.show_all_response', compact('project', 'request','support_state', 'user','support_response','type','help_desk','priority'));

    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $Project = Project::skip($start)->take($length)->get();
        } else {
            $Project = Project::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($Project as $Projects) {
            $data .= '["' . $Projects->id . '",' . '"' . $Projects->hp_project_name . '",' . '"' . $Projects->hp_employer_name . '",' . '"' . $Projects->hp_connector . '",' . '"' . $Projects->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $Projects_count = Project::all()->count();
        return response('{ "recordsTotal":' . $Projects_count . ',"recordsFiltered":' . $Projects_count . ',"data": [' . $data . ']}');
    }

}
