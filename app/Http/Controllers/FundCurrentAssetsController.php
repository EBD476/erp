<?php

namespace App\Http\Controllers;

use App\FundCurrentAssets;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class FundCurrentAssetsController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $current_assets=FundCurrentAssets::all();
        return view('finance_fund.fund_current_assets.index', compact('priority', 'help_desk', 'type','current_assets','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.fund_current_assets.create',compact('client','priority', 'help_desk', 'type','user'));
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
            'hfca_name' => 'required'
        ]);
        $current_assets = New FundCurrentAssets();
        $current_assets->hfca_name = $request->hfca_name;
        $current_assets->save();
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
        $user=User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $current_assets = FundCurrentAssets::find($id);
        return view('finance_fund.fund_current_assets.edit', compact('priority', 'help_desk', 'priority', 'type','current_assets','user'));
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
            'hfca_name' => 'required'
        ]);
        $current_assets = FundCurrentAssets:: find($id);
        $current_assets->hfca_name = $request->hfca_name;
        $current_assets->save();
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
        $current_assets = FundCurrentAssets:: find($id);
        $current_assets->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
