<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\Project_State;
use App\Project_Type;
use App\Support;
use App\SupportStatus;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Compound;
use Symfony\Component\Mime\Address;

class ProjectController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $projects = Project::select('hp_project_location')->get();
        return view('projects.index', compact('user', 'type', 'help_desk', 'priority', 'projects'));
    }

    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_show', '0')->get();
        $projects_type = Project_Type::ALL();
        $projects = Project_State::ALL();
        $projects_city = \App\address::all();
        return view('projects.create', compact('projects_city','projects', 'projects_type', 'user', 'support_response', 'type', 'help_desk', 'priority'));
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
        $Project->hp_owner = $request->hp_owner;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();

        return json_encode(["response" => "OK"]);

    }

    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_show', '0')->get();
        $projects_state = Project_State::all();
        $projects_type = Project_Type::ALL();
        $project = Project::find($id);
        $client = Client::select('hc_name')->where('id', $project->hp_project_owner)->get()->first();
        return view('projects.edit', compact('project', 'client', 'projects_type', 'projects_state', 'user', 'support_response', 'type', 'help_desk', 'priority'));

    }

    public function update(Request $request, $id)
    {
//        $this->validate($request, [
//            'project_name' => 'required',
//            'project_owner' => 'required',
//            'owner_phone' => 'required',
//            'project_type' => 'required',
//            'project_units' => 'required',
//            'project_address' => 'required',
//            'project_location' => 'required',
////            'project_options' => 'required' ,
//            'project_completed' => 'required',
//            'project_complete_date' => 'required',
//            'project_description' => 'required',
//        ]);
        $owner = Client::select('id')->where('hc_name',$request->project_owner)->get()->last();
        $Project = Project::find($id);
        $Project->hp_project_name = $request->project_name;
        $Project->hp_project_owner = $owner->id;
        $Project->hp_project_owner_phone = $request->owner_phone;
        $Project->hp_project_type = $request->project_type;
        $Project->hp_owner = $request->hp_owner;
        $Project->hp_project_units = $request->project_units;
        $Project->hp_project_address = $request->project_address;
        $Project->hp_project_location = $request->project_location;
        $Project->hp_project_options = $request->project_options;
        $Project->hp_project_complete_date = $request->project_complete_date;
        $Project->hp_project_description = $request->project_description;
        $Project->save();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $projects = Project::select('hp_project_location')->get();
        return view('projects.index', compact('user', 'type', 'help_desk', 'priority', 'projects'));
    }

    public function destroy($id)
    {
        $Project = Project::find($id);
        $Project->delete();
        return json_encode(["response" => "OK"]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($file)) {

//            $current_date = Verta::now();
//            $file_name = $current_date . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists('img/support_request')) {
                mkdir('img/support_request', 0777, true);
            }
            $file->move('img/support_request', $filename);
        } else {
            $filename = 'default.png';
        }

        return response()->json(['link' => '/img/support_request/' . $filename]);
    }

    public function send_request($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_show', '0')->get();
        $request_support = Project::find($id);
        return view('projects.support_request', compact('request_support', 'user', 'support_response', 'type', 'help_desk', 'priority'));
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
        $request_support->hs_attach_file = $request->file;
        $request_support->save();
        $sequence = SupportStatus::select('id')->where('hss_sequence', '1')->first();

        Project::where('id', $request->id)
            ->update(['hp_status' => $sequence->id]);
        return json_encode(["response" => "OK"]);

    }

    public function show_response($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_show', '0')->get();
        $request = Support::where('id', $id)->first();
        $project = Project::where('id', $request->hs_project_id)->first();
        $client = Client::select('hc_name')->where('id', $project->hp_project_owner)->get()->last();
        return view('projects.show_response_data', compact('client', 'project', 'request', 'user', 'support_response', 'type', 'help_desk', 'priority'));
    }

    public function show_all_response()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('projects.show_all_response', compact('user', 'type', 'help_desk', 'priority'));

    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $Project = DB::Table('hnt_projects')
                ->join('hnt_clients', 'hnt_projects.hp_project_owner', '=', 'hnt_clients.id')
                ->join('hnt_project_address_state', 'hnt_projects.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_projects.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->select('hnt_projects.hp_project_name','hnt_project_address_city.hp_city','hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name', 'hnt_projects.hp_project_complete_date', 'hnt_projects.hp_order_id', 'hnt_projects.id', 'hnt_projects.hp_project_owner_phone', 'hnt_projects.hp_project_type', 'hnt_projects.hp_contract_type', 'hnt_projects.hp_owner', 'hnt_projects.hp_project_address')
                ->where('hnt_projects.deleted_at', '=', NULL)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $Project = DB::Table('hnt_projects')
                ->join('hnt_clients', 'hnt_projects.hp_project_owner', '=', 'hnt_clients.id')
                ->select('hnt_projects.hp_project_name','hnt_project_address_city.hp_city','hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name', 'hnt_projects.hp_project_complete_date', 'hnt_projects.hp_order_id', 'hnt_projects.id')
                ->where('hnt_projects.deleted_at', '=', NULL)
                ->where('hnt_projects.hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hnt_clients.hc_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($Project as $Projects) {
            $key++;
//            $data .= '["' . $key . '",' . '"' . $Projects->hp_project_name . '",' . '"' . $Projects->hc_name . '",' . '"' . $Projects->hp_project_complete_date . '",' . '"' . $Projects->hp_order_id . '",' . '"' . $Projects->id . '",' . '"' . $Projects->hp_city . '",' . '"' . $Projects->hp_project_state . '",' . '"' . $Projects->hp_project_owner_phone . '"],';
            $data .= '["' . $key . '",' . '"' . $Projects->hp_project_name . '",' . '"' . $Projects->hc_name . '",' . '"' . $Projects->hp_project_complete_date . '",' . '"' . $Projects->hp_order_id . '",' . '"' . $Projects->id . '",' . '"' . $Projects->hp_project_owner_phone . '",' . '"' . $Projects->hp_project_type . '",' . '"' . $Projects->hp_contract_type . '",' . '"' . $Projects->hp_owner . '",' . '"' . $Projects->hp_project_address . '"],';
        }
        $data = substr($data, 0, -1);
        $Projects_count = Project::all()->count();
        return response('{ "recordsTotal":' . $Projects_count . ',"recordsFiltered":' . $Projects_count . ',"data": [' . $data . ']}');
    }

    public function fill_response(Request $request)
    {
        $current_user = auth()->user()->id;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.created_at', 'hnt_support.hs_status', 'hnt_support.id', 'hnt_support_status.hss_name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_request_user_id', '=', $current_user)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.created_at', 'hnt_support.hs_status', 'hnt_support.id', 'hnt_support_status.hss_name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_request_user_id', '=', $current_user)
                ->where('hnt_projects.hp_project_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($support_response as $support_responses) {
            $time = verta($support_responses->created_at);
            $key++;
            $data .= '["' . $key . '",' . '"' . $support_responses->hs_title . '",' . '"' . $support_responses->hp_project_name . '",' . '"' . $support_responses->hss_name . '",' . '"' . $time . '",' . '"' . $support_responses->id . '"],';
        }
        $data = substr($data, 0, -1);
        $support_responses_count = Support::all()->count();
        return response('{ "recordsTotal":' . $support_responses_count . ',"recordsFiltered":' . $support_responses_count . ',"data": [' . $data . ']}');
    }

}
