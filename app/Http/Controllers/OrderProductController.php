<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function store(Request $request)
    {
        $items = $request->name;
        $index = 0;
        foreach ($items as $item) {
            $product = new OrderProduct();
            $product->hpo_product_id = $request->name[$index];
            $product->hpo_count = $request->invoice_items_qty[$index];
            $product->hpo_order_id = $request->hpo_order_id;
            $product->hpo_client_id = $request->hpo_client_id;
            $product->hop_due_date = $request->hop_due_date;
            $product->hpo_discount = $request->hpo_discount;
            $product->hpo_description = $request->hpo_description;
            $product->hpo_total = $request->price;
            $product->hpo_total_discount = $request->total_discount;
            $product->hpo_status = '1';
            $product->save();
            $index++;
        }
        return json_encode(["response" => "OK"]);
    }

//    update invoices item
    public function update(Request $request, $id)
    {
        $items = $request->name;
        $index = 0;
        foreach ($items as $item) {
            $product = OrderProduct::where('hpo_order_id', $id);
            $product->hpo_product_id = $request->name[$index];
            $product->hpo_count = $request->invoice_items_qty[$index];
            $product->hpo_order_id = $request->hpo_order_id;
            $product->hpo_client_id = $request->hpo_client_id;
            $product->hop_due_date = $request->hop_due_date;
            $product->hpo_discount = $request->hpo_discount;
            $product->hpo_total = $request->price;
            $product->hpo_total_discount = $request->total_discount;
            $product->hpo_status = '1';
            $product->save();
            $index++;
        }
        return json_encode(["response" => "OK"]);
    }
}