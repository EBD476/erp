<?php

namespace App\Http\Controllers;

use App\BankAccountType;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class BankAccountTypeController extends Controller
{
    public function index()
    {
        $bank_account_type=BankAccountType::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.bank_account_type.index', compact('priority', 'help_desk', 'type','bank_account_type'));
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
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.bank_account_type.create',compact('priority', 'help_desk', 'type'));
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
            'hat_name' => 'required'
        ]);
        $bank_account_type = New BankAccountType();
        $bank_account_type->hat_name = $request->hat_name;
        $bank_account_type->save();
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
        $bank_account_type = BankAccountType::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.bank_account_type.edit', compact('priority', 'help_desk', 'priority', 'type','bank_account_type'));
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
            'hat_name' => 'required'
        ]);
        $bank_account_type = BankAccountType:: find($id);
        $bank_account_type->hat_name = $request->hat_name;
        $bank_account_type->save();
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
        $bank_account_type = BankAccountType::find($id);
        $bank_account_type->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
