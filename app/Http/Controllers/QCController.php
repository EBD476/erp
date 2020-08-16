<?php

namespace App\Http\Controllers;

use App\OrderState;
use App\OrderProduct;
use App\RepositoryCreate;
use App\RepositoryProduct;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class QCController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_name = RepositoryCreate::select('id', 'hr_name')->get();
        return view('qc.index', compact('repository_name', 'help_desk', 'priority', 'type', 'user'));
    }

//    store data
    public function update(Request $request, $id)
    {
        $current_date = Verta::now();
        $product = $request->state;
        if ($request->all == 1) {
            OrderProduct::where('hpo_order_id', $id)
                ->update(['hpo_status' => $product, 'hpo_verify_qc_date' => $current_date]);
        }
        if ($request->all == 0) {
            OrderProduct::where('id', $id)
                ->update(['hpo_status' => $product, 'hpo_verify_qc_date' => $current_date]);
        }
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

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_status', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_description', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_contract_type', 'hnt_invoices.hp_owner_user', 'hnt_invoices.hp_connector', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_invoices.hp_phone_number', 'hnt_invoices.hp_type_project', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 4)
                ->orderBy('hnt_invoices.hp_Invoice_number')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_status', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_description', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_contract_type', 'hnt_invoices.hp_owner_user', 'hnt_invoices.hp_connector', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_invoices.hp_phone_number', 'hnt_invoices.hp_type_project', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '=', 4)
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_employer_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_Invoice_number . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hc_name . '",' . '"' . $orders->hop_due_date . '",' . '"' . $orders->hpo_order_id . '",' . '"' . $orders->id . '",' . '"' . $orders->hpo_status . '",' . '"' . $orders->hpo_description . '",' . '"' . $orders->hpo_count . '",' . '"' . $orders->hp_address . '",' . '"' . $orders->hp_phone_number . '",' . '"' . $orders->hp_type_project . '",' . '"' . $orders->hp_contract_type . '",' . '"' . $orders->hp_owner_user . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_product_name . " " . $orders->hp_product_model . " " . $orders->hn_color_name . " " . $orders->hpp_property_name . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

    public function fill_all(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_verify_qc_date', 'hnt_invoice_items.hpo_status', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_description', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_contract_type', 'hnt_invoices.hp_owner_user', 'hnt_invoices.hp_connector', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_invoices.hp_phone_number', 'hnt_invoices.hp_type_project', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '>', 4)
                ->orderBy('hnt_invoices.hp_Invoice_number')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $order = DB::table('hnt_invoice_items')
                ->join('hnt_invoices', 'hnt_invoice_items.hpo_order_id', '=', 'hnt_invoices.id')
                ->join('hnt_products', 'hnt_invoice_items.hpo_product_id', '=', 'hnt_products.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_project_address_state', 'hnt_invoices.hp_address_state_id', '=', 'hnt_project_address_state.id')
                ->join('hnt_project_address_city', 'hnt_invoices.hp_address_city_id', '=', 'hnt_project_address_city.id')
                ->join('hnt_clients', 'hnt_invoices.ho_client', '=', 'hnt_clients.id')
                ->select('hnt_invoice_items.id', 'hnt_invoice_items.hpo_verify_qc_date', 'hnt_invoice_items.hpo_status', 'hnt_invoice_items.hpo_serial_number', 'hnt_invoice_items.hpo_order_id', 'hnt_invoice_items.hpo_description', 'hnt_invoice_items.hpo_count', 'hnt_invoice_items.hop_due_date', 'hnt_products.hp_product_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_invoices.hp_Invoice_number', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_contract_type', 'hnt_invoices.hp_owner_user', 'hnt_invoices.hp_connector', 'hnt_invoices.hp_project_name', 'hnt_invoices.hp_employer_name', 'hnt_invoices.hp_address', 'hnt_invoices.hp_phone_number', 'hnt_invoices.hp_type_project', 'hnt_project_address_city.hp_city', 'hnt_project_address_state.hp_project_state', 'hnt_clients.hc_name')
                ->where('hnt_invoice_items.deleted_at', '=', Null)
                ->where('hnt_invoices.hp_Invoice_number', '!=', Null)
                ->where('hnt_invoice_items.hpo_status', '>', 4)
                ->where('hnt_invoices.hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hnt_invoices.hp_employer_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($order as $orders) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $orders->hp_Invoice_number . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hc_name . '",' . '"' . $orders->hop_due_date . '",' . '"' . $orders->hpo_order_id . '",' . '"' . $orders->id . '",' . '"' . $orders->hpo_status . '",' . '"' . $orders->hpo_description . '",' . '"' . $orders->hpo_count . '",' . '"' . $orders->hpo_verify_qc_date . '",' . '"' . $orders->hp_phone_number . '",' . '"' . $orders->hp_type_project . '",' . '"' . $orders->hp_contract_type . '",' . '"' . $orders->hp_owner_user . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_product_name . " " . $orders->hp_product_model . " " . $orders->hn_color_name . " " . $orders->hpp_property_name . '",' . '"' . $orders->hpo_verify_qc_date . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = OrderProduct::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }


    //fill data to repositories
    public function fill_repository_qc(Request $request)
    {
        $current_user = auth()->user()->id;
        $current_user_role_id = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->select('model_has_roles.role_id')
            ->where('users.id', '=', $current_user)
            ->get()
            ->last();

        $repository_user_role_id = DB::table('hnt_organizational_departments')
            ->select('hnt_organizational_departments.hod_name', 'hnt_organizational_departments.id')
            ->where('hnt_organizational_departments.hod_role_id', '=', $current_user_role_id->role_id)
            ->where('hnt_organizational_departments.deleted_at', '=', Null);

        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];

        if ($search == '') {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_provider', 'hnt_repository_product.hr_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->joinSub($repository_user_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
//                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_provider', 'hnt_repository_product.hr_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->joinSub($repository_user_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
//                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hp_product_name . " " . $repository_products->hp_product_model . " " . $repository_products->hn_color_name . " " . $repository_products->hpp_property_name . '",' . '"' . $repository_products->hr_product_stock . '",' . '"' . $repository_products->hp_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . $repository_products->hr_comment . '",' . '"' . $repository_products->hr_entry_date . '",' . '"' . $repository_products->hr_exit . '",' . '"' . $repository_products->hr_return_value . '",' . '"' . $repository_products->hr_contradiction . '",' . '"' . $repository_products->hr_status_return_part . '",' . '"' . $repository_products->hr_provider_code . '",' . '"' . $repository_products->hr_repository_id . '",' . '"' . $repository_products->hr_product_id . '",' . '"' . $repository_products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryProduct::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }

}
