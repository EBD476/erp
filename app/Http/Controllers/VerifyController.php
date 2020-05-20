<?php

namespace App\Http\Controllers;

use App\address;
use App\Client;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Process;
use App\Product;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\Project_State;
use App\User;
use App\Verifier;
use App\VerifyID;
use Illuminate\Http\Request;
use carbon\carbon;


class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
        return view('verify_level.index', compact('order', 'help_desk', 'priority', 'type','user'));
    }

    public function edit($id)
    {
        $userID = auth()->user()->id;
        $current_verified_order = Verifier::where('hp_verifier_id', $userID and 'process_id', '1')->first();
        $current_verifier = VerifyID::select('verify_id')->where('verify_id', $userID)->first();
        if ($current_verifier != null) {
            $first_verifier = Process::where('hp_verifier_id', $userID)
                ->where('hp_priority', 1)
                ->first();
            if ($current_verifier->verify_id != $userID) {

                if ($first_verifier != null) {
                    $second_verifier = Process::where('hp_verifier_id', $userID)->first();
                    $selected_priority = VerifyID::where('verify_id', '<>', $second_verifier)->first();


                }
            } else {
//                 return back();
            }

        }
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $order = Order::find($id);
        $product = Product::select('id','hp_product_model','hp_product_color_id','hp_product_size','hp_product_property','hp_product_code_number','hp_product_name','hp_product_price')->get();
        $items = ProductPropertyItems::select('id','hppi_items_name','hppi_color')->get();
        $properties = ProductProperty::select('id','hpp_property_name','hpp_property_items')->get();
        $data = OrderProduct::where('hpo_order_id',$id)->get();
        $color = ProductColor::select('id','hn_color_name')->get();
        $data_dis = OrderProduct::select('hop_due_date')->where('hpo_order_id',$id)->get()->last();
        $city = address:: where('id', $order->hp_address_city_id)->get()->last();
        $state = Project_State:: where('id', $order->hp_address_state_id)->get()->last();
        $client =Client::select('id','hc_name')->where('id',$order->ho_client)->get()->last();
        $order_registrant = User::select('name')->where('id',$order->hp_registrant)->get()->last();
        return view('verify_level.preview', compact('items','due_date','color','properties','client','order_registrant','order', 'first_verifier', 'verifyID', 'selected_priority', 'current_verified_order', 'help_desk', 'priority', 'type','user','product','data','state','city','data_dis'));

    }

    public function update(Request $request, $id)
    {
        //        ثبت نام تاییدکنندگان سطح
//           ثبت اولین تاییدکننده
        $userID = auth()->user()->id;
        $order = Order::find($id);
        $order_state = OrderState::select('ho_process_id')
            ->where('order_id', $order->id)
            ->first();

        if ($order_state === null) {

            $current_priority = Process::select('process_id', 'hp_verifier_id', 'hp_priority')
                ->where('hp_verifier_id', $userID)
                ->where('hp_priority', 1)
                ->first();

            if ($current_priority != null) {
                $order_state = OrderState::create(['order_id' => $order->id, 'ho_process_id' => 1, 'ho_verifier_id' => $userID]);
            } else {
                return redirect()->route('verify_pre.index');
            }
        }

        $selected_verifier = Process::select('process_id', 'hp_verifier_id', 'hp_priority')
            ->where('hp_verifier_id', $userID)
            ->where('process_id', $order_state->ho_process_id)
            ->first();

        $first_verifier_process = Process::select('process_id', 'hp_verifier_id')
            ->where('hp_verifier_id', $userID)
            ->where('hp_priority', 1)
            ->where('process_id', $order_state->ho_process_id)
            ->first();


        //بابت خطای تکرار تایید
        if ($selected_verifier === null) {
            return redirect()->route('verify_pre.index');
        }

        $current_verified_order = VerifyID::where('verify_id', $userID)->first();

        if ($current_verified_order === null) {
            $first_verifier = new VerifyID();
            $first_verifier->verify_id = $selected_verifier->hp_verifier_id;
            $first_verifier->verify_level = $selected_verifier->process_id;
            $first_verifier->hv_order_id = $order->id;
            $first_verifier->save();
        }

        if ($first_verifier_process != null) {
            return redirect()->route('verify_pre.index');
        }

        //           ثبت شماره قرارداد
        $order_state = OrderState::select('ho_process_id')
            ->where('ho_process_id', $selected_verifier)
            ->first();
        if ($order_state === null) {
            $order_state = OrderState::where('order_id', $order->id)->first();
            $order_state->ho_verifier_id = $selected_verifier->hp_verifier_id;
            $order_state->save();

            $compare_process = Process::where('process_id', $order_state->ho_process_id)->count();
            if ($compare_process === $selected_verifier->hp_priority) {

                $order_state->ho_process_id = $order_state->ho_process_id + 1;
                $order_state->save();


                // register invoice
                // register approve
                $current_date = Carbon::now();
                $current_date = $current_date->year . $current_date->month . $current_date->day;
                $order->hp_Invoice_number = "HNT_" . sprintf("%04d", $id) . "_" . $current_date . "_" . $order->id;;
                $order->save();

                OrderProduct::where('hpo_order_id', $id)
                    ->update(['hpo_status' => '2']);

            }

        }


        return redirect()->route('verify_pre.index');
    }


    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
