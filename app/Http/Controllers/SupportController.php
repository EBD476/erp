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
        $support_response = Support::where('hs_show', '0')->get();
        $support_state = SupportStatus::ALL();
        $request = Support::all();
        $project = Project::all();
        return view('support.show_all_data', compact('project', 'request', 'support_state', 'user', 'support_response', 'help_desk', 'priority', 'type'));

    }

    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $support_response = Support::where('id', $id)->where('hs_show', '0')->first();
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
        $support_response = Support::where('id', $id)->where('hs_show', '0')->first();
        $project = Project::where('id', $support_response->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        $user_requested = User::select('name')->where('id', $support_response->hs_request_user_id)->get()->last();
        $user_response = User::select('name')->where('id', $support_response->hs_response_user_id)->get()->last();
        $client_name = Client::select('hc_name')->where('id', $project->hp_project_owner)->get()->last();
        return view('support.show_data', compact('project', 'project_type', 'user', 'help_desk', 'priority', 'type','client_name','user_requested','support_response','user_response'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::select('hp_order_id')->where('id', $id)->first();
        $status = Support::where('id', $id)->first();
        $counter = $status->hs_status + 1;
        Support::where('id', $id)->update(['hs_response' => $request->response, 'hs_status' => $counter, 'hs_response_user_id' => auth()->user()->id]);
        OrderState::where('order_id', $project)->update(['ho_process_id' => '8', 'ho_verifier_id' => auth()->user()->id]);
        OrderProduct::where('hpo_order_id', $project)->update(['hpo_status' => '8']);
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */

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
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
