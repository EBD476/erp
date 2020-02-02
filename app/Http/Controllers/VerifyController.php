<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Process;
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
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $order = Order::select('id', 'hp_project_name', 'created_at')
            ->where('hp_Invoice_number', Null)->get();
//        dd($order);
        return view('verify_level.index', compact('order', 'help_desk', 'priority', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
//        $order_id=Order::SELECT('id')->where('hp_Invoice_number',null);
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

        $order = Order::find($id);
        return view('verify_level.preview', compact('order', 'first_verifier', 'verifyID', 'selected_priority', 'current_verified_order', 'help_desk', 'priority', 'type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
