<?php

namespace App\Http\Controllers;

use App\BankAccounts;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{
    public function index()
    {
        $bank_account = BankAccounts::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.index', compact('priority', 'help_desk', 'type', 'bank_account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.create');
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
            'hba_bank_id' => 'required',
            'hba_balance' => 'required',
            'hba_debt' => 'required',
            'hba_crediting' => 'required',
            'hba_deduction_date' => 'required',
            'hba_deposit_date' => 'required',
        ]);
        $bank_account = New BankAccounts();
        $bank_account->hba_bank_id = $request->hba_bank_id;
        $bank_account->hba_balance = $request->hba_balance;
        $bank_account->hba_debt = $request->hba_debt;
        $bank_account->hba_crediting = $request->hba_crediting;
        $bank_account->hba_deduction_date = $request->hba_deduction_date;
        $bank_account->hba_deposit_date = $request->hba_deposit_date;
        $bank_account->save();
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
        $bank_account = HDpriority::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.index', compact('priority', 'help_desk', 'priority', 'type','bank_account'));
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
            'hba_bank_id' => 'required',
            'hba_balance' => 'required',
            'hba_debt' => 'required',
            'hba_crediting' => 'required',
            'hba_deduction_date' => 'required',
            'hba_deposit_date' => 'required',
        ]);
        $bank_account = BankAccounts:: find($id);
        $bank_account->hba_bank_id = $request->hba_bank_id;
        $bank_account->hba_balance = $request->hba_balance;
        $bank_account->hba_debt = $request->hba_debt;
        $bank_account->hba_crediting = $request->hba_crediting;
        $bank_account->hba_deduction_date = $request->hba_deduction_date;
        $bank_account->hba_deposit_date = $request->hba_deposit_date;
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
        $bank_account = HDpriority::find($id);
        $bank_account->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
