<?php

namespace App\Http\Controllers;

use App\FinanceBank;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class FinanceBankController extends Controller
{
    public function index()
    {
        $user=User::all();
        $finance_bank = FinanceBank::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $type = HDtype::all();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.finance_bank.index', compact('priority', 'help_desk', 'type','finance_bank','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $type = HDtype::all();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.finance_bank.create',compact('type','help_desk','priority','user'));
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
            'hfb_name' => 'required',
            'hfb_bank_account_number' => 'required',
            'hfb_account_id' => 'required',
            'hfb_branch' => 'required',
            'hfb_address' => 'required',
        ]);
        $finance_bank = New FinanceBank();
        $finance_bank->hfb_name = $request->hfb_name;
        $finance_bank->hfb_bank_account_number = $request->hfb_bank_account_number;
        $finance_bank->hfb_account_id = $request->hfb_account_id;
        $finance_bank->hfb_branch = $request->hfb_branch;
        $finance_bank->hfb_address = $request->hfb_address;
        $finance_bank->save();
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
        $finance_bank = FinanceBank::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.finance_bank.edit', compact('priority', 'help_desk', 'priority', 'type','finance_bank','user'));
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
            'hfb_name' => 'required',
            'hfb_bank_account_number' => 'required',
            'hfb_account_id' => 'required',
            'hfb_branch' => 'required',
            'hfb_address' => 'required',        ]);
        $finance_bank = FinanceBank:: find($id);
        $finance_bank->hfb_name = $request->hfb_name;
        $finance_bank->hfb_bank_account_number = $request->hfb_bank_account_number;
        $finance_bank->hfb_account_id = $request->hfb_account_id;
        $finance_bank->hfb_branch = $request->hfb_branch;
        $finance_bank->hfb_address = $request->hfb_address;
        $finance_bank->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy(HDpriority $hDpriority)
    {
        $finance_bank = FinanceBank:: find($id);;
        $finance_bank->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
