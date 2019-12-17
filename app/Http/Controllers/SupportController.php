<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\OrderState;
use App\Project;
use App\Project_Type;
use App\Support;
use App\SupportStatus;
use App\User;
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
        $support_response =Support::where('hs_show','0')->get();
        $request = Support::where('hs_status', '1')->get();
        $project = Project::all();
        return view('support.index', compact('project', 'request','user','support_response','help_desk','priority','type'));

    }

    public function show()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
        $support_response =Support::where('hs_show','0')->get();
        $support_state = SupportStatus::ALL();
        $request = Support::all();
        $project = Project::all();
        return view('support.show_all_data', compact('project', 'request', 'support_state','user','support_response','help_desk','priority','type'));

    }

    public function edit($id)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $support_response =Support::where('hs_show','0')->get();
        $user=User::all();
        $request = Support::where('id', $id)->first();
        $project = Project::where('id', $request->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        return view('support.edit', compact('project', 'request', 'project_type','user','support_response','help_desk','priority','type'));
    }

    public function show_data($id)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $user=User::all();
        $request = Support::where('id', $id)->first();
        $project = Project::where('id', $request->hs_project_id)->first();
        $project_type = Project_Type::where('id', $project->hp_project_type)->first();
        return view('support.show_data', compact('project', 'request', 'project_type','user','help_desk','priority','type'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::select('hp_order_id')->where('id', $id)->first();
        $status = Support::where('id', $id)->first();
        $counter = $status->hs_status + 1;
        Support::where('id', $id)->update(['hs_response' => $request->response, 'hs_status' => $counter, 'hs_response_user_id' => auth()->user()->id]);
        OrderState::where('order_id', $project)->update(['ho_process_id' => '7', 'ho_verifier_id' => auth()->user()->id]);
        OrderProduct::where('hpo_order_id', $project)->update(['hpo_status' => '7']);
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */

}
