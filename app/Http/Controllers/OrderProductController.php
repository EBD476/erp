<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function store(Request $request)
    {
        $id = 0;
        $product_name = implode(',', $request->name);
        $product_price_ = implode(',', $request->hp_product_price);
        $product_qty = implode(',', $request->invoice_items_qty);
        $product_items = implode(',', $request->invoice_items);
        foreach ($id as $id) {
            $product = new OrderProduct();
            $product->hop_product_name = $product_name[0];
            $product->invoice_items_qty = $product_qty[0];
            $product->hp_product_price = $product_price_[0];
            $product->invoice_items = $product_items[0];
            $product->hop_order_id = 1;
            $product->save();
            if ($product_name[1] != 0) {
                $id = $id + 1;
            } else {
                $id=0;
            }
        }


    }
}


//$product = implode(',',$request->invoice_items_qty);
//$del = $product[0];
//$save=new OrderProduct();
//$save->hop_product_count=$del;
//$save->save();