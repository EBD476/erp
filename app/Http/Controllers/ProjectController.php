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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
        $support_response =Support::where('hs_show','0')->get();
        $projects = Project::all();
        return view('projects.index', compact('projects','user','support_response','type','help_desk','priority'));
    }

    public function create()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $support_response =Support::where('hs_show','0')->get();
        $user = User::all();
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $support_response =Support::where('hs_show','0')->get();
        $user=User::all();
        $request = Support::where('id', $id)->first();
        $project = Project::where('id', $request->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        return view('projects.show_response_data', compact('project', 'request', 'project_type','user','support_response','type','help_desk','priority'));
    }
    public function show_all_response()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
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
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

}
