<?php

namespace App\Http\Controllers;

use App\FinanceFund;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class FinanceFundController extends Controller
{
    public function index()
    {
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $fund = FinanceFund::all();
        return view('finance_fund.index', compact('priority', 'help_desk', 'type','fund'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.create',compact('type','help_desk','priority'));
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
            'hff_name' => 'required'
        ]);
        $fund = New FinanceFund();
        $fund->hff_name = $request->hff_name;
        $fund->save();
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
        $fund = FinanceFund::find($id);
        return view('finance_fund.edit', compact('priority', 'help_desk', 'priority', 'type', 'fund'));
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
            'hff_name' => 'required'
        ]);
        $fund = FinanceFund:: find($id);
        $fund->hff_name = $request->hff_name;
        $fund->save();
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
        $fund = FinanceFund:: find($id);
        $fund->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
