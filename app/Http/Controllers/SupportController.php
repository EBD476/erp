<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\OrderState;
use App\Project;
use App\Project_Type;
use App\Support;
use App\SupportStatus;
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
        $request = Support::where('hs_status','1')->get();
        $project = Project::all();
        return view('support.index', compact('project','request'));

    }

    public function show()
    {
        $support_state=SupportStatus::ALL();
        $request = Support::all();
        $project = Project::all();
        return view('support.show_all_data', compact('project','request','support_state'));

    }

    public function edit($id)
    {

        $request = Support::where('id',$id)->first();
        $project = Project::where('id',$request->hs_project_id)->first();
        $project_type=Project_Type::where('id',$project->hp_project_type)->first();
        return view('support.edit', compact('project','request','project_type'));
    }
    public function show_data($id)
    {
        $request = Support::where('id',$id)->first();
        $project = Project::where('id',$request->hs_project_id)->first();
        $project_type=Project_Type::where('id',$project->hp_project_type)->first();
        return view('support.show_data', compact('project','request','project_type'));
    }

    public function update(Request $request, $id)
    {
        $project=Project::select('hp_order_id')->where('id', $id)->first();
        $status=Support::where('id', $id)->first();
        $counter= $status->hs_status + 1;
        Support::where('id', $id)->update(['hs_response'=> $request->response,'hs_status'=>$counter]);
        OrderState::where('order_id',$project)->update(['ho_process_id'=>'7','ho_verifier_id'=>auth()->user()->id]);
        OrderProduct::where('hpo_order_id',$project)->update(['hpo_status'=>'7']);
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */

}
