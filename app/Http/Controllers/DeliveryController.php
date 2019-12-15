<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Project;
use Carbon\Carbon;
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
        $invoice_status = DB::select("SELECT hpo_order_id,hp_Invoice_number,hp_project_name,hpo_product_id,hpo_count,hop_due_date FROM hnt_invoices , hnt_invoice_items WHERE hnt_invoices.hp_contract_type ='تحویل کالا' and   hnt_invoice_items.hpo_status = '4' group by hnt_invoice_items.hpo_order_id ");
        return view('delivery.index', ['invoice_status' => $invoice_status]);
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
                $order=Order::Select()->where('id',$id);
                $current_date = Carbon::now();
                $current_date = $current_date->year . $current_date->month . $current_date->day;
                $project = New Project();
                $project->hp_project_name =$order->hp_project_name;
                $project->hp_project_owner =$order->ho_client;
                $project->hp_project_owner_phone =$order->hp_phone_number;
                $project->hp_project_type =$order->hp_owner_user;
                $project->hp_project_units =$order->hp_number_of_units;
                $project->hp_project_address =$order->hp_address;
                $project->hp_project_location =$order->hp_project_location;
                $project->hp_project_complete_date =$current_date;
                $project->save();

            }
        }
        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);


    }

}
