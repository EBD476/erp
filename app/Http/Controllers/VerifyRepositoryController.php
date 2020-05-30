<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class VerifyRepositoryController extends Controller
{
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $product = Order::select('id', 'hp_product_selection', 'created_at')
            ->whereNotNull('hp_Invoice_number')->get();
        return view('verify_level.index', compact('product','help_desk','priority','type','user'));
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
//        $order_id=Order::SELECT('id')->where('hp_Invoice_number',null);
        $userID = auth()->user()->id;
        $current_verified_order = VerifyID::where('verify_id', $userID)->first();
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
        return view('verify_level.preview', compact('order', 'first_verifier', 'verifyID', 'selected_priority','current_verified_order'));

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
                $order->hp_Invoice_number = 'HNT_980406_001';
                $order->save();

            }

        }


        return redirect()->route('verify_pre.index');
    }
}
