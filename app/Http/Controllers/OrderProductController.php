<?php

namespace App\Http\Controllers;


use App\Order;
use App\OrderProduct;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use VerumConsilium\Browsershot\Facades\PDF;

class OrderProductController extends Controller
{

//    store invoices item
    public function store(Request $request)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $size_name = count(collect($request)->get('total'));

        if ($size_name == 1) {
            if ($request->name != "") {
                $product = new OrderProduct();
                $product->hpo_product_id = $request->name[0];
                $product->hpo_count = 1;
                $product->hpo_order_id = $request->hpo_order_id;
                $product->hop_due_date = $create_due_date;
                $product->hpo_description = $request->invoice_items[0];
                $product->hpo_total = $request->total[0];
                $product->hpo_status = '1';
                $product->save();

            }
        } else {
            $items = $request->name;
            $index = 0;
            foreach ($items as $item) {
                if ($item != "") {
                    $product = new OrderProduct();
                    $product->hpo_product_id = $request->name[$index];
                    $product->hpo_count = $request->invoice_items_qty[$index];
                    $product->hpo_order_id = $request->hpo_order_id;
                    $product->hop_due_date = $create_due_date;
                    $product->hpo_description = $request->invoice_items[$index];
                    $product->hpo_total = $request->total[$index];
                    $product->hpo_status = '1';
                    $product->save();
                    $index++;
                }


            }
        }

//      update invoice tb
//      Tax Pr
        $tax = Tax::select('hpx_tax')->get()->last();
        $process = $tax->hpx_tax * $request->all_tot / 100;
        $all_tot = $request->all_tot - $process;
        $process_dis = $tax->hpx_tax * $request->all_dis / 100;
        $all_dis = $request->all_dis - $process_dis;
        $product_order = Order::find($request->hpo_order_id);
        $product_order->hp_total_all = $request->all_tot;
        if ($request->all_dis == "") {
            $product_order->hp_total_discount = $all_tot;
        } else {
            $product_order->hp_total_discount = $all_dis;
        }
        $product_order->hp_discount = $request->hpo_discount;
        $product_order->hp_tax = $tax->hpx_tax;
        $product_order->save();


        return json_encode(["response" => "OK"]);
    }

//    update invoices item
    public function update(Request $request, $id)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $items = $request->pid;
        $index = 0;
        foreach ($items as $item) {
            if ($item != "") {
                $product = OrderProduct::where('hpo_order_id', $id)->where('id', $request->pid[$index])->first();
                $product->hpo_product_id = $request->name[$index];
                $product->hpo_count = $request->invoice_items_qty[$index];
                $product->hpo_order_id = $request->hpo_order_id;
                if ($request->hop_due_date != "") {
                    $product->hop_due_date = $request->hop_due_date;
                } else {
                    $product->hop_due_date = $create_due_date;
                }
                $product->hpo_total = $request->total[$index];
                $product->hpo_description = $request->invoice_items[$index];
                $product->hpo_status = '1';
                $product->save();
                $index++;
            }
        }

//      update invoice tb
        //      update invoice tb
//      Tax Pr
        $tax = Tax::select('hpx_tax')->get()->last();
        $process = $tax->hpx_tax * $request->all_tot / 100;
        $process_dis = $tax->hpx_tax * $request->all_dis / 100;
        $all_tot = $request->all_tot - $process;
        $all_dis = $request->all_dis - $process_dis;
        $product_order = Order::find($request->hpo_order_id);
        $product_order->hp_total_all = $request->all_tot;
        if ($request->all_dis == "") {
            $product_order->hp_total_discount = $all_tot;
        } else {
            $product_order->hp_total_discount = $all_dis;
        }
        $product_order->hp_discount = $request->hpo_discount;
        $product_order->hp_tax = $tax->hpx_tax;
        $product_order->save();

        return json_encode(["response" => "OK"]);
    }

//    delete invoice items
    public function destroy($id)
    {
        $item = OrderProduct::find($id);
        $item->delete();
        return json_encode(["response" => "OK"]);

    }

    public function add(Request $request)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $size_name = count(collect($request)->get('total'));

        if ($size_name == 1) {
            if ($request->name != "") {
                $product = new OrderProduct();
                $product->hpo_product_id = $request->name;
                $product->hpo_count = 1;
                $product->hpo_order_id = $request->hpo_order_id;
                $product->hop_due_date = $create_due_date;
                $product->hpo_description = $request->invoice_items;
                $product->hpo_total = $request->total;
                $product->hpo_status = '1';
                $product->save();
                return json_encode(["response" => "OK", "pid" => $product->id]);

            }
        }
    }

//    fill  data table
    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_order_id','hnt_invoice_items.hpo_count','hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id','hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 3)
                ->skip($start)->take($length)->get();
//            $product = Product::onlyTrashed()->get();
//            $product = Product::withTrashed()->get();

        } else {
            $product = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->select('hnt_invoice_items.id','hnt_invoice_items.hpo_count','hnt_invoice_items.hpo_order_id','hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_color_id','hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name')
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_product_color.hn_color_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product as $products) {
            $key++;
            $data .= '["' . $key . '","' . $products->hp_Invoice_number . '",' . '"' . $products->hp_product_name . '",' . '"' . $products->hp_product_model . '",' . '"' . $products->hpp_property_name . '",' . '"' . $products->hn_color_name . '",' . '"' . $products->hp_product_size . '",' . '"' . $products->hpo_count . '",' . '"' . $products->hop_due_date . '",' . '"' . $products->hpo_order_id . '"],';
        }
        $data = substr($data, 0, -1);
        $products_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $products_count . ',"recordsFiltered":' . $products_count . ',"data": [' . $data . ']}');
    }

}
