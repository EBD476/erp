<?php

namespace App\Http\Controllers;

use App\FundIntangibleAssets;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class FundIntangibleAssetsController extends Controller
{
    public function index()
    {
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $funds_intangible_assets=FundIntangibleAssets::all();
        return view('finance_fund.fund_non_current.fund_intangible_assets.index', compact('priority', 'help_desk', 'type','funds_intangible_assets'));
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
        return view('finance_fund.fund_non_current.fund_intangible_assets.create',compact('client','priority', 'help_desk', 'type'));
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
            'hfia_name' => 'required'
        ]);
        $funds_intangible_asset = New HDpriority();
        $funds_intangible_asset->hfia_name = $request->hfia_name;
        $funds_intangible_asset->save();
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
        $funds_intangible_asset = FundIntangibleAssets:: find($id);
        return view('finance_fund.fund_non_current.fund_intangible_assets.edit', compact('priority', 'help_desk', 'priority', 'type', 'funds_intangible_asset'));
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
            'hfia_name' => 'required'
        ]);
        $funds_intangible_asset = FundIntangibleAssets:: find($id);
        $funds_intangible_asset->hfia_name = $request->hfia_name;
        $funds_intangible_asset->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy(HDpriority $id)
    {
        $funds_intangible_asset = FundIntangibleAssets:: find($id);
        $funds_intangible_asset->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
