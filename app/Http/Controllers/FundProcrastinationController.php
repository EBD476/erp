<?php

namespace App\Http\Controllers;

use App\FundProcrastination;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class FundProcrastinationController extends Controller
{
    public function index()
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $procrastination = FundProcrastination::all();
        return view('finance_fund.fund_current_assets.fund_criticism.fund_procrastination.index', compact('priority', 'help_desk', 'type','procrastination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        return view('finance_fund.fund_current_assets.fund_criticism.fund_procrastination.create',compact('client','priority', 'help_desk', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'hfp_user_id' => 'required',
            'hfp_type_id' => 'required',
            'hfp_amount' => 'required',
            'hfp_name' => 'required',
            'hfp_user_id_receive' => 'required',        ]);
        $procrastination = New FundProcrastination();
        $procrastination->hfp_user_id = $request->hfp_user_id;
        $procrastination->hfp_type_id = $request->hfp_type_id;
        $procrastination->hfp_amount = $request->hfp_amount;
        $procrastination->hfp_name = $request->hfp_name;
        $procrastination->hfp_user_id_receive = $request->hfp_user_id_receive;        $procrastination->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function show(HDpriority $hDpriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $procrastination = FundProcrastination::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.fund_procrastination.edit', compact('priority', 'help_desk', 'priority', 'type','procrastination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hfp_user_id' => 'required',
            'hfp_type_id' => 'required',
            'hfp_amount' => 'required',
            'hfp_name' => 'required',
            'hfp_user_id_receive' => 'required',
        ]);
        $procrastination = FundProcrastination:: find($id);
        $procrastination->hfp_user_id = $request->hfp_user_id;
        $procrastination->hfp_type_id = $request->hfp_type_id;
        $procrastination->hfp_amount = $request->hfp_amount;
        $procrastination->hfp_name = $request->hfp_name;
        $procrastination->hfp_user_id_receive = $request->hfp_user_id_receive;
        $procrastination->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procrastination = HDpriority::find($id);
        $procrastination->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
