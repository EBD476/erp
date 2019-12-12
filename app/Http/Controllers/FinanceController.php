<?php

namespace App\Http\Controllers;

use App\Finance;
use App\FinanceProduct;
use App\OrderProduct;
use App\OrderState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = DB::select("SELECT hpo_order_id,hp_project_name FROM hnt_invoices , hnt_invoice_items WHERE hnt_invoice_items.hpo_status = '2' group by hnt_invoice_items.hpo_order_id ");
        return view('finance.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hdp_name' => 'hf_paid_code'
        ]);
        $priority = New FinanceProduct();
        $priority->hf_paid_code = $request->code;
        $priority->hf_order_id = $request->id;
        $priority->save();
        OrderProduct::where('hpo_order_id', $id)
            ->update(['hpo_status' => 6]);
        OrderState::where('order_id', $id)
            ->update(['ho_process_id' => 3]);

        return json_encode(["response" => "Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        //
    }
}
