<?php

namespace App\Http\Controllers;

use App\Client;
use App\OrderProduct;
use App\OrderState;
use App\Project;
use App\Project_Type;
use App\Support;
use App\SupportStatus;
use App\User;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('hs_show', '0')->get();
        $request = Support::where('hs_status', '1')->get();
        $project = Project::all();
        return view('support.index', compact('project', 'request', 'user', 'support_response', 'help_desk', 'priority', 'type'));

    }

    public function show()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('support.show_all_data', compact('project', 'request', 'support_state', 'user', 'support_response', 'help_desk', 'priority', 'type'));

    }

    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('id', $id)->first();
        $project = Project::where('id', $support_response->hs_project_id)->first();
        $user_requested = User::select('name')->where('id', $support_response->hs_request_user_id)->get()->last();
        $client_name = Client::select('hc_name')->where('id', $project->hp_project_owner)->get()->last();
        return view('support.edit', compact('project', 'request', 'project_type', 'user', 'support_response', 'help_desk', 'priority', 'type', 'user_requested', 'client_name'));
    }

    public function show_data($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('id', $id)->get()->first();
        $project = Project::where('id', $support_response->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        $user_requested = User::select('name')->where('id', $support_response->hs_request_user_id)->get()->last();
        $user_response = User::select('name')->where('id', $support_response->hs_response_user_id)->get()->last();
        $client_name = Client::select('hc_name')->where('id', $project->hp_project_owner)->get()->last();
        return view('support.show_data', compact('project', 'project_type', 'user', 'help_desk', 'priority', 'type', 'client_name', 'user_requested', 'support_response', 'user_response'));
    }


    public function store(Request $request)
    {
        $project = Project::select('id')->where('hp_project_name', $request->hp_project_name)->first();
        $user = User::select('id')->where('name', $request->hs_request_user_id)->get()->first();
        $current_user = auth()->user()->id;
        $support_status = SupportStatus::all()->count();
        $support = New Support();
        $support->hs_request_user_id = $user->id;
        $support->hs_response_user_id = $current_user;
        $support->hs_project_id = $project->id;
        $support->hs_title = $request->hs_title;
        $support->hs_response = $request->hs_response;
        $support->hs_attach_file_from_support = $request->file;
        $support->hs_description = $request->hs_description;
        $support->hs_show = 1;
        $support->hs_status = $support_status;
        $support->save();
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);

    }

    public function update(Request $request, $id)
    {
        $project = Project::select('hp_order_id')->where('id', $id)->first();
        $status = Support::where('id', $id)->first();
        $count_status = SupportStatus::all()->count();
        if ($status->hs_status < $count_status) {
            $counter = $status->hs_status + 1;
        } else {
            $counter = $status->hs_status;
        }
        Support::where('id', $id)->update(['hs_response' => $request->response, 'hs_attach_file_from_support' => $request->file, 'hs_show' => 1, 'hs_status' => $counter, 'hs_response_user_id' => auth()->user()->id]);
        OrderState::where('order_id', $project)->update(['ho_process_id' => '8', 'ho_verifier_id' => auth()->user()->id]);
        OrderProduct::where('hpo_order_id', $project)->update(['hpo_status' => '8']);
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);
    }

//  show in index
    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_show', '=', 0)
                ->orderBy('hnt_support.hs_project_id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_show', '=', 0)
                ->where('hnt_projects.hp_project_name', 'LIKE', "%$search%")
                ->orderBy('hnt_support.hs_project_id', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($support_response as $support_responses) {
            $time = verta($support_responses->created_at);
            $key++;
            $data .= '["' . $key . '",' . '"' . $support_responses->hs_title . '",' . '"' . $support_responses->hp_project_name . '",' . '"' . $time . '",' . '"' . $support_responses->id . '",' . '"' . $support_responses->hs_description . '",' . '"' . $support_responses->name . '"],';
        }
        $data = substr($data, 0, -1);
        $support_responses_count = Support::all()->count();
        return response('{ "recordsTotal":' . $support_responses_count . ',"recordsFiltered":' . $support_responses_count . ',"data": [' . $data . ']}');
    }

//  show in all list request
    public function fill_all(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'hnt_support.hs_response', 'hnt_support_status.hss_name', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'hnt_support.hs_response', 'hnt_support_status.hss_name', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_projects.hp_project_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($support_response as $support_responses) {
            $time = verta($support_responses->created_at);
            $key++;
            $data .= '["' . $key . '",' . '"' . $support_responses->hs_title . '",' . '"' . $support_responses->hp_project_name . '",' . '"' . $support_responses->hss_name . '",' . '"' . $time . '",' . '"' . $support_responses->id . '",' . '"' . $support_responses->hs_project_id . '",' . '"' . $support_responses->hs_description . '",' . '"' . $support_responses->hs_response . '",' . '"' . $support_responses->name . '"],';
        }
        $data = substr($data, 0, -1);
        $support_responses_count = Support::all()->count();
        return response('{ "recordsTotal":' . $support_responses_count . ',"recordsFiltered":' . $support_responses_count . ',"data": [' . $data . ']}');
    }

//    show recent list side request
    public function recent_list(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $project_id = $request->formName;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'hnt_support.hs_response', 'hnt_support_status.hss_name', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_project_id', '=', $project_id)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $support_response = DB::Table('hnt_support')
                ->join('hnt_projects', 'hnt_support.hs_project_id', '=', 'hnt_projects.id')
                ->join('hnt_support_status', 'hnt_support.hs_status', '=', 'hnt_support_status.id')
                ->join('users', 'hnt_support.hs_request_user_id', '=', 'users.id')
                ->select('hnt_projects.hp_project_name', 'hnt_support.hs_title', 'hnt_support.hs_project_id', 'hnt_support.created_at', 'hnt_support.id', 'hnt_support.hs_description', 'hnt_support.hs_response', 'hnt_support_status.hss_name', 'users.name')
                ->where('hnt_support.deleted_at', '=', NULL)
                ->where('hnt_support.hs_project_id', '=', $project_id)
                ->where('hnt_support.hs_title', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($support_response as $support_responses) {
            $time = verta($support_responses->created_at);
            $key++;
            $data .= '["' . $key . '",' . '"' . $support_responses->hs_title . '",' . '"' . $support_responses->hp_project_name . '",' . '"' . $support_responses->hss_name . '",' . '"' . $time . '",' . '"' . $support_responses->id . '",' . '"' . $support_responses->hs_project_id . '",' . '"' . $support_responses->hs_description . '",' . '"' . $support_responses->hs_response . '",' . '"' . $support_responses->name . '"],';
        }
        $data = substr($data, 0, -1);
        $support_responses_count = Support::all()->count();
        return response('{ "recordsTotal":' . $support_responses_count . ',"recordsFiltered":' . $support_responses_count . ',"data": [' . $data . ']}');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($file)) {

            if (!file_exists('img/support_response')) {
                mkdir('img/support_response', 0777, true);
            }
            $file->move('img/support_response', $filename);
        } else {
            $filename = 'default.png';
        }

        return response()->json(['link' => '/img/support_response/' . $filename]);
    }

}
