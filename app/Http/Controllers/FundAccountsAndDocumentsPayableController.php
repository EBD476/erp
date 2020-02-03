<?php

namespace App\Http\Controllers;

use App\FundAccountsAndDocumentsPayable;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class FundAccountsAndDocumentsPayableController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $fund_accounts_document_payable=FundAccountsAndDocumentsPayable::all();
        return view('finance_fund.fund_current_assets.fund_accounts_and_documents_payable.index', compact('priority', 'help_desk', 'type','fund_accounts_document_payable','user'));
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
        return view('finance_fund.fund_current_assets.fund_accounts_and_documents_payable.create',compact('priority', 'help_desk', 'type','user'));
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
            'hfaadp_invoice_number' => 'required',
            'hfaadp_invoice_description' => 'required',
            'hfaadp_invoice_date' => 'required',
            'hfaadp_invoice_amount' => 'required',
            'hfaadp_attache_file' => 'required',
        ]);
        $fund_accounts_and_documents_payable = New FundAccountsAndDocumentsPayable();
        $fund_accounts_and_documents_payable->hfaadp_invoice_number = $request->hfaadp_invoice_number;
        $fund_accounts_and_documents_payable->hfaadp_invoice_description = $request->hfaadp_invoice_description;
        $fund_accounts_and_documents_payable->hfaadp_invoice_date = $request->hfaadp_invoice_date;
        $fund_accounts_and_documents_payable->hfaadp_invoice_amount = $request->hfaadp_invoice_amount;
        $fund_accounts_and_documents_payable->hfaadp_attache_file = $request->hfaadp_attache_file;
        $fund_accounts_and_documents_payable->save();
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
        $fund_accounts_document_payable = FundAccountsAndDocumentsPayable:: find($id);
        return view('finance_fund.fund_current_assets.fund_accounts_document_payable.index', compact('priority', 'help_desk', 'priority', 'type', 'fund_accounts_document_payable','user'));
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
            'hfaadp_invoice_number' => 'required',
            'hfaadp_invoice_description' => 'required',
            'hfaadp_invoice_date' => 'required',
            'hfaadp_invoice_amount' => 'required',
            'hfaadp_attache_file' => 'required',
        ]);
        $fund_accounts_and_documents_payable = FundAccountsAndDocumentsPayable:: find($id);
        $fund_accounts_and_documents_payable->hfaadp_invoice_number = $request->hfaadp_invoice_number;
        $fund_accounts_and_documents_payable->hfaadp_invoice_description = $request->hfaadp_invoice_description;
        $fund_accounts_and_documents_payable->hfaadp_invoice_date = $request->hfaadp_invoice_date;
        $fund_accounts_and_documents_payable->hfaadp_invoice_amount = $request->hfaadp_invoice_amount;
        $fund_accounts_and_documents_payable->hfaadp_attache_file = $request->hfaadp_attache_file;
        $fund_accounts_and_documents_payable->save();
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
        $fund_accounts_and_documents_payable = FundAccountsAndDocumentsPayable:: find($id);
        $fund_accounts_and_documents_payable->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
