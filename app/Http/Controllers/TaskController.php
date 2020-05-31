<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\ProductColor;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\ProductStatus;
use App\ProductTaskReport;
use App\ProductZone;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_task.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function product_task_report_list()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_task.report_list', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function checkbox(Request $request, $id)
    {
        $status = ProductStatus::all()->count();
        $checkbox = Task::find($id);
        if ($request->hpt_status < $status) {
            $hpt_product_zone_id = ProductZone::select('id')->where('hpz_priority', $request->hpt_status + 1)->get()->last();
            $checkbox->hpt_product_zone_id = $hpt_product_zone_id->id;
            $checkbox->hpt_status = $request->hpt_status + 1;
        } else {
            $checkbox->hpt_verify = 1;
        }
        $checkbox->save();
        return json_encode(["response" => "Done"]);
    }

    public function store(Request $request)
    {
        $current_user = auth()->user()->id;
        $task = new Task();
        $task->hpt_product_id = $request->hpt_product_id;
        $task->hpt_invoice_number = $request->hpt_invoice_number;
        $task->hpt_count = $request->hpt_count;
        $task->hpt_status = $request->hpt_status;
        if (empty($request->hpt_product_zone_id)) {
            $zone_id = ProductZone::select('id')->where('hpz_priority', 1)->get()->last();
            $task->hpt_product_zone_id = $zone_id->id;
        } else {
            $task->hpt_product_zone_id = $request->hpt_product_zone_id;
        }
        $task->hpt_user_id = $current_user;
        $task->save();
//reserve product serial number
        OrderProduct::where('hpo_order_id', $request->hpo_order_id)
            ->where('hpo_product_id', $request->hpt_product_id)
            ->update(['hpo_serial_number' => 'hnt']);

        return json_encode(["response" => "OK"]);
    }

    public function store_report(Request $request)
    {
        $current_user = auth()->user()->id;
        $task = new ProductTaskReport();
        $task->hpt_product_id = $request->hpt_product_id;
        $task->hpt_invoice_number = $request->hpt_invoice_number;
        $task->hpt_count = $request->hpt_count;
        $task->hpt_status = $request->hpt_status;
        $task->hpt_report = $request->hpt_report;
        $task->hpt_product_zone_id = $request->hpt_product_zone_id;
        $task->hpt_comment = $request->hpt_comment;
        $task->hpt_user_id = $current_user;
        $task->save();
        return json_encode(["response" => "OK"]);
    }

    public function destroy($id)
    {
        $provider = Task::find($id);
        $provider->delete();
        return json_encode(["response" => "Done"]);
    }

//     fill new order
    public function fill_new(Request $request)
    {
        $current_user = auth()->user()->id;
        $select_zone = ProductZone::select('id')->where('hpz_user_id', $current_user)->get()->last();
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $task = DB::table('hnt_product_task')
                ->join('hnt_product_zone', 'hnt_product_task.hpt_product_zone_id', '=', 'hnt_product_zone.id')
                ->join('hnt_products', 'hnt_product_task.hpt_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('users', 'hnt_product_task.hpt_user_id', '=', 'users.id')
                ->join('hnt_product_status', 'hnt_product_task.hpt_status', '=', 'hnt_product_status.hps_level')
                ->select('hnt_product_task.id', 'hnt_product_task.hpt_product_id', 'hnt_products.hp_product_name', 'hnt_product_task.hpt_invoice_number', 'hnt_product_task.hpt_count', 'hnt_product_task.hpt_report', 'hnt_product_task.hpt_comment', 'hnt_products.hp_product_model', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_product_status.hps_name', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_product_zone.hpz_name', 'users.name', 'hnt_product_task.hpt_product_zone_id', 'hnt_product_task.hpt_status')
                ->where('hnt_product_task.hpt_product_zone_id', '=', $select_zone->id)
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_product_task.hpt_verify', '=', 0)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $task = DB::table('hnt_product_task')
                ->join('hnt_product_zone', 'hnt_product_task.hpt_product_zone_id', '=', 'hnt_product_zone.id')
                ->join('hnt_products', 'hnt_product_task.hpt_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('users', 'hnt_product_task.hpt_user_id', '=', 'users.id')
                ->join('hnt_product_status', 'hnt_product_task.hpt_status', '=', 'hnt_product_status.hps_level')
                ->select('hnt_product_task.id', 'hnt_product_task.hpt_product_id', 'hnt_products.hp_product_name', 'hnt_product_task.hpt_invoice_number', 'hnt_product_task.hpt_count', 'hnt_product_task.hpt_report', 'hnt_product_task.hpt_comment', 'hnt_products.hp_product_model', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_product_status.hps_name', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_product_zone.hpz_name', 'users.name', 'hnt_product_task.hpt_product_zone_id', 'hnt_product_task.hpt_status')
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_product_task.hpt_product_zone_id', '=', $select_zone->id)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->where('hnt_product_task.hpt_verify', '=', 0)
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($task as $tasks) {
            $key++;
            $data .= '["' . $key . '","' . $tasks->hpt_invoice_number . '",' . '"' . $tasks->hp_serial_number . " " . $tasks->hp_product_name . " " . $tasks->hp_product_model . " " . $tasks->hn_color_name . " " . $tasks->hpp_property_name . " " . $tasks->hp_product_size . '",' . '"' . $tasks->hpt_count . '",' . '"' . $tasks->name . '",' . '"' . $tasks->hpz_name . '",' . '"' . $tasks->hps_name . '",' . '"' . $tasks->hpt_report . '",' . '"' . $tasks->hpt_comment . '",' . '"' . $tasks->id . '",' . '"' . $tasks->hpt_product_zone_id . '",' . '"' . $tasks->hpt_status . '",' . '"' . $tasks->hpt_product_id . '"],';
        }
        $data = substr($data, 0, -1);
        $task_count = Task::all()->count();
        return response('{ "recordsTotal":' . $task_count . ',"recordsFiltered":' . $task_count . ',"data": [' . $data . ']}');
    }//     fill new order

    public function fill_report_list(Request $request)
    {
        $current_user = auth()->user()->id;
        $select_zone = ProductZone::select('id')->where('hpz_user_id', $current_user)->get()->last();
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $task = DB::table('hnt_product_task_report')
                ->join('hnt_product_zone', 'hnt_product_task_report.hpt_product_zone_id', '=', 'hnt_product_zone.id')
                ->join('hnt_products', 'hnt_product_task_report.hpt_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('users', 'hnt_product_task_report.hpt_user_id', '=', 'users.id')
                ->join('hnt_product_status', 'hnt_product_task_report.hpt_status', '=', 'hnt_product_status.hps_level')
                ->select('hnt_product_task_report.id', 'hnt_product_task_report.hpt_product_id', 'hnt_products.hp_product_name', 'hnt_product_task_report.hpt_invoice_number', 'hnt_product_task_report.hpt_count', 'hnt_product_task_report.hpt_report', 'hnt_product_task_report.hpt_comment', 'hnt_products.hp_product_model', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_product_status.hps_name', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_product_zone.hpz_name', 'users.name', 'hnt_product_task_report.hpt_product_zone_id', 'hnt_product_task_report.hpt_status')
                ->where('hnt_product_task_report.hpt_product_zone_id', '=', $select_zone->id)
                ->where('hnt_products.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $task = B::table('hnt_product_task_report')
                ->join('hnt_product_zone', 'hnt_product_task_report.hpt_product_zone_id', '=', 'hnt_product_zone.id')
                ->join('hnt_products', 'hnt_product_task_report.hpt_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('users', 'hnt_product_task_report.hpt_user_id', '=', 'users.id')
                ->join('hnt_product_status', 'hnt_product_task_report.hpt_status', '=', 'hnt_product_status.hps_level')
                ->select('hnt_product_task_report.id', 'hnt_product_task_report.hpt_product_id', 'hnt_products.hp_product_name', 'hnt_product_task_report.hpt_invoice_number', 'hnt_product_task_report.hpt_count', 'hnt_product_task_report.hpt_report', 'hnt_product_task_report.hpt_comment', 'hnt_products.hp_product_model', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_product_status.hps_name', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_product_zone.hpz_name', 'users.name', 'hnt_product_task_report.hpt_product_zone_id', 'hnt_product_task_report.hpt_status')
                ->where('hnt_product_task_report.hpt_product_zone_id', '=', $select_zone->id)
                ->where('hnt_products.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->where('hnt_product_task.hpt_verify', '=', 0)
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($task as $tasks) {
            $key++;
            $data .= '["' . $key . '","' . $tasks->hpt_invoice_number . '",' . '"' . $tasks->hp_serial_number . " " . $tasks->hp_product_name . " " . $tasks->hp_product_model . " " . $tasks->hn_color_name . " " . $tasks->hpp_property_name . " " . $tasks->hp_product_size . '",' . '"' . $tasks->hpt_count . '",' . '"' . $tasks->name . '",' . '"' . $tasks->hpz_name . '",' . '"' . $tasks->hps_name . '",' . '"' . $tasks->hpt_report . '",' . '"' . $tasks->hpt_comment . '",' . '"' . $tasks->id . '",' . '"' . $tasks->hpt_product_zone_id . '",' . '"' . $tasks->hpt_status . '",' . '"' . $tasks->hpt_product_id . '"],';
        }
        $data = substr($data, 0, -1);
        $task_count = Task::all()->count();
        return response('{ "recordsTotal":' . $task_count . ',"recordsFiltered":' . $task_count . ',"data": [' . $data . ']}');
    }

//    fill report list
    public function preview(Request $request)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $data = DB::table('hnt_product_task_report')
            ->join('hnt_product_zone', 'hnt_product_task_report.hpt_product_zone_id', '=', 'hnt_product_zone.id')
            ->join('hnt_products', 'hnt_product_task_report.hpt_product_id', '=', 'hnt_products.id')
            ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
            ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
            ->join('users', 'hnt_product_task_report.hpt_user_id', '=', 'users.id')
            ->join('hnt_product_status', 'hnt_product_task_report.hpt_status', '=', 'hnt_product_status.hps_level')
            ->select('hnt_product_task_report.hpt_product_id', 'hnt_products.hp_product_name', 'hnt_product_task_report.hpt_invoice_number', 'hnt_product_task_report.hpt_count', 'hnt_product_task_report.hpt_report', 'hnt_product_task_report.hpt_comment', 'hnt_products.hp_product_model', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_products.hp_product_image', 'hnt_products.hp_voltage', 'hnt_products.hp_serial_number', 'hnt_product_zone.hpz_name', 'users.name')
            ->where('hnt_products.deleted_at', '=', Null)
            ->where('hnt_product_task_report.hpt_invoice_number', '=', $request->id)
            ->get();
        $data_invoices = $data->last();
        return view('products.product_task.preview', ["data" => $data], compact('type', 'priority', 'help_desk', 'user', 'data_invoices'));
    }

}
