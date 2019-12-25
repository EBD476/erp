<?php

namespace App\Http\Controllers;

use App\FundProcrastinationType;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class FundProcrastinationTypeController extends Controller
{
    public function index()
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $procrastination_type = FundProcrastinationType::all();
        return view('finance_fund.fund_current_assets.fund_criticism.fund_procrastination.fund_procrastination_type.index', compact('priority', 'help_desk', 'type','procrastination_type'));
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
        return view('priority.create',compact('priority', 'help_desk', 'type'));
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
            'hfpt_name' => 'required'
        ]);
        $procrastination_type = New FundProcrastinationType();
        $procrastination_type->hfpt_name = $request->hfpt_name;
        $procrastination_type->save();
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
        $procrastination_type = FundProcrastinationType::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.fund_procrastination.fund_procrastination_type.edit', compact('priority', 'help_desk', 'priority', 'type','procrastination_type'));
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
            'hfpt_name' => 'required'
        ]);
        $procrastination_type = FundProcrastinationType:: find($id);
        $procrastination_type->hfpt_name = $request->hfpt_name;
        $procrastination_type->save();
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
        $procrastination_type = FundProcrastinationType::find($id);
        $procrastination_type->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
