<?php

namespace App\Http\Controllers;

use App\Finance;
use App\FinanceProduct;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class FinanceController extends Controller
{

    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        return view('finance.index', compact('order', 'help_desk', 'priority', 'type', 'user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function destroy(Finance $finance)
    {
        //
    }

    //    new agreement order list
    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoices')
                ->join('hnt_invoice_items', 'hnt_invoices.id', 'hnt_invoice_items.hpo_order_id')
                ->select('hnt_invoices.id', 'hnt_invoices.hp_project_name')
                ->where('hnt_invoice_items.hpo_status', '=', '2')
                ->where('hnt_invoices.deleted_at', '=', null)
                ->groupby('hnt_invoice_items.hpo_order_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoices')
                ->join('hnt_invoice_items', 'hnt_invoices.id', 'hnt_invoice_items.hpo_order_id')
                ->select('hnt_invoices.id', 'hnt_invoices.hp_project_name')
                ->where('hnt_invoice_items.hpo_status', '=', '2')
                ->where('hnt_invoices.deleted_at', '=', null)
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->groupby('hnt_invoice_items.hpo_order_id')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->id . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

    //    all agreement order list
    public function fill_all(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoices')
                ->join('hnt_finance_product','hnt_invoices.id','hnt_finance_product.hf_order_id')
                ->join('hnt_invoice_items', 'hnt_invoices.id', 'hnt_invoice_items.hpo_order_id')
                ->select('hnt_invoices.id', 'hnt_invoices.hp_project_name','hnt_finance_product.hf_paid_code','hnt_finance_product.hf_paid_type')
                ->where('hnt_invoices.deleted_at', '=', null)
                ->groupby('hnt_invoice_items.hpo_order_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoices')
                ->join('hnt_finance_product','hnt_invoices.id','hnt_finance_product.hf_order_id')
                ->join('hnt_invoice_items', 'hnt_invoices.id', 'hnt_invoice_items.hpo_order_id')
                ->select('hnt_invoices.id', 'hnt_invoices.hp_project_name','hnt_finance_product.hf_paid_code','hnt_finance_product.hf_paid_type')
                ->where('hnt_invoices.deleted_at', '=', null)
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->groupby('hnt_invoice_items.hpo_order_id')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->id . '",' . '"' . $orders->hf_paid_code . '",' . '"' . $orders->hf_paid_type . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
