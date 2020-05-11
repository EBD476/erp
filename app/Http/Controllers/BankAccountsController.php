<?php

namespace App\Http\Controllers;

use App\BankAccounts;
use App\FinanceBank;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{
    public function index()
    {
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $bank_account = BankAccounts::all();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.index', compact('priority', 'help_desk', 'type', 'bank_account', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank = FinanceBank::all();
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.create', compact('priority', 'help_desk', 'type', 'bank', 'user'));
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
            'hba_account_number' => 'required',
            'hba_balance' => 'required',
            'hba_debt' => 'required',
            'hba_crediting' => 'required',
            'hba_deduction_date' => 'required',
            'hba_deposit_date' => 'required',
        ]);
        $bank_account = New BankAccounts();
        $bank_account->hba_bank_id = $request->hba_bank_id;
        $bank_account->hba_account_number = $request->hba_account_number;
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
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $bank_account = HDpriority::find($id);
        return view('finance_fund.fund_current_assets.fund_criticism.bank_accounts.index', compact('user','priority', 'help_desk', 'priority', 'type', 'bank_account'));
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
            'hba_account_number' => 'required',
            'hba_balance' => 'required',
            'hba_debt' => 'required',
            'hba_crediting' => 'required',
            'hba_deduction_date' => 'required',
            'hba_deposit_date' => 'required',
        ]);
        $bank_account = BankAccounts:: find($id);
        $bank_account->hba_bank_id = $request->hba_bank_id;
        $bank_account->hba_account_number = $request->hba_account_number;
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

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
