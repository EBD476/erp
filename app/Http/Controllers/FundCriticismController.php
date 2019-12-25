<?php

namespace App\Http\Controllers;

use App\FundCriticism;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class FundCriticismController extends Controller
{
    public function index()
    {
        $criticism = FundCriticism::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.fund_current_assets.fund_criticism.index', compact('priority', 'help_desk', 'type' , 'criticism'));
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
        $criticism = FundCriticism::all();
        return view('finance_fund.fund_current_assets.fund_criticism.create',compact('client','priority', 'help_desk', 'type','criticism'));
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
            'hfc_name' => 'required'
        ]);
        $criticism = New FundCriticism();
        $criticism->hfc_name = $request->hfc_name;
        $criticism->save();
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
        $criticism = FundCriticism::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.edit', compact('priority', 'help_desk', 'priority', 'type','criticism'));
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
            'hfc_name' => 'required'
        ]);
        $criticism = FundCriticism:: find($id);
        $criticism->hfc_name = $request->hfc_name;
        $criticism->save();
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
        $criticism = FundCriticism:: find($id);
        $criticism->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
