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
            $product->hpo_product_id =$request->name[$index];
            $product->hpo_count =$request->invoice_items_qty[$index];
            $product->hpo_description =$request->invoice_items_qty[$index];
            $product->hpo_order_id =$request->hpo_order_id;
            $product->hpo_client_id =$request->hpo_client_id;
            $order->hop_due_date = $request->hop_due_date;
            $order->hpo_discount = $request->hpo_discount;
            $product->save();
            $index++;
        }
        return json_encode(["response"=>"OK"]);
    }
}