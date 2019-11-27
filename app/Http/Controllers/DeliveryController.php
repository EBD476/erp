<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\OrderState;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice_status=DB::select("SELECT hpo_order_id,hp_Invoice_number,hp_project_name,hpo_product_id,hpo_count,hop_due_date FROM hnt_invoices , hnt_invoice_items WHERE hnt_invoices.hp_contract_type ='تحویل کالا' and   hnt_invoice_items.hpo_status = '4' group by hnt_invoice_items.hpo_order_id ");
        return view('delivery.index',['invoice_status'=>$invoice_status]);
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

}
