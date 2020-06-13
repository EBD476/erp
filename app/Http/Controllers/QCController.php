<?php

namespace App\Http\Controllers;

use App\OrderState;
use App\OrderProduct;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class QCController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('qc.index', compact('help_desk', 'priority', 'type', 'user'));
    }

//    store data
    public function update(Request $request, $id)
    {
        $product = $request->state;
        OrderProduct::where('hpo_order_id', $id)
            ->update(['hpo_status' => $product]);
        $count = OrderProduct::where('hpo_order_id', $id)->get();
        $number = 0;
        foreach ($count as $counts) {
            if ($counts->hpo_status == $product) {
                $number++;
            }
            if (OrderProduct::where('hpo_order_id', $id)->count() == $number) {
                OrderState::where('order_id', $id)
                    ->update(['ho_process_id' => '5']);
            }
        }
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_status','hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state','hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 4)
                ->where('hnt_invoices.hp_contract_type', '=', 'نصب در محل')
                ->orderBy('hnt_invoices.hp_Invoice_number')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients','hnt_invoices.ho_client','=','hnt_clients.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_status','hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state','hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 4)
                ->where('hnt_invoices.hp_contract_type', '=', 'نصب در محل')
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_employer_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_Invoice_number . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hc_name . '",' . '"' . $orders->hop_due_date . '",' . '"' . $orders->hpo_order_id . '",' . '"' . $orders->id . '",' . '"' . $orders->hpo_status . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
    public function fill_all(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_status','hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state','hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '>', 4)
                ->orderBy('hnt_invoices.hp_Invoice_number')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients','hnt_invoices.ho_client','=','hnt_clients.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_status','hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state','hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '<', 5)
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_employer_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_Invoice_number . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hc_name . '",' . '"' . $orders->hop_due_date . '",' . '"' . $orders->hpo_order_id . '",' . '"' . $orders->id . '",' . '"' . $orders->hpo_status . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
