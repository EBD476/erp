<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\MiddlePart;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\ProductPart;
use App\RepositoryMiddlePart;
use App\RepositoryProduct;
use App\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use carbon\carbon;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Part;
use App\RepositoryCreate;
use App\RepositoryPart;

class RepositoryProductController extends Controller
{

    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_product = RepositoryProduct:: all();
        $product = Product::select('id', 'hp_product_name')->get();
        $repository = RepositoryPart::select('id', 'hrp_part_id', 'hrp_repository_id', 'hrp_part_count')->get();
        $repository_name = RepositoryCreate::select('id', 'hr_name')->get();
        $part = Part::select('id', 'hp_name')->get();
        $repository_middle_part = RepositoryMiddlePart::select('id', 'hrm_count', 'hrm_comment', 'hrm_middle_part_id')->get();
        $middle_part = MiddlePart::Select('id', 'hmp_name')->get();

        return view('Repository.index', compact('repository_middle_part', 'part', 'repository_name', 'repository', 'user', 'repository_product', 'product', 'help_desk', 'priority', 'type', 'middle_part'));

    }

//    charge product count in repository
    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_name = RepositoryCreate::select('id', 'hr_name', 'hr_priority_id')->get();
        return view('Repository.create', compact('repository_name', 'type', 'priority', 'help_desk', 'user', 'product'));
    }

    public function order_state(Request $request, $id)
    {
        $product = $request->product;
        OrderProduct::where('id', $id)
            ->where('hpo_product_id', $product)
            ->update(['hpo_status' => '4']);
        $count = OrderProduct::where('hpo_order_id', $id)->get();
        $number = 0;
        foreach ($count as $counts) {
            if ($counts->hpo_status == '4') {
                $number++;
            }
            if (OrderProduct::where('hpo_order_id', $id)->count() == $number) {
                OrderState::where('order_id', $id)
                    ->update(['ho_process_id' => $request->state]);
                $order = Order::find($id);
                $current_date = Verta::now();
                $agreement = new Agreement();
                $agreement->hg_agreement_number = $current_date;
                $agreement->hg_invoice = $order->hp_Invoice_number;
                $agreement->hg_client = $order->ho_client;
                $agreement->save();
            }
        }

        if ($request->computing_repository_requirement < 0) {

            $product_middle_part = DB::table('hnt_product_middle_part')
                ->join('hnt_repository_middle_part', 'hnt_product_middle_part.hpp_middle_part_id', 'hnt_repository_middle_part.hrm_middle_part_id')
                ->select('hnt_product_middle_part.hpp_middle_part_id', 'hnt_product_middle_part.hpp_part_count', 'hnt_repository_middle_part.hrm_count')
                ->where('hnt_product_middle_part.hpp_product_id', $request->product)
                ->where('hnt_product_middle_part.deleted_at', '=', null)
                ->get();

            $index = 0;
            foreach ($product_middle_part as $items) {
                $count_middle_part = $items->hrm_count - ($items->hpp_part_count * $request->count);
                RepositoryMiddlePart::where('hrm_middle_part_id', $items->hpp_middle_part_id)
                    ->update(['hrm_count' => $count_middle_part]);
                $index++;
            }

            $product_part = DB::table('hnt_product_part')
                ->join('hnt_repository_part', 'hnt_product_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->select('hnt_product_part.hpp_part_id', 'hnt_product_part.hpp_part_count', 'hnt_repository_part.hrp_part_count')
                ->where('hnt_product_part.hpp_product_id', $request->product)
                ->where('hnt_product_part.deleted_at', '=', null)
                ->get();

            $index1 = 0;
            foreach ($product_part as $items) {
                $count_part = $items->hrp_part_count - ($items->hpp_part_count * $request->count);
                RepositoryPart::where('hrp_part_id', $items->hpp_part_id)
                    ->update(['hrp_part_count' => $count_part]);
                $index1++;
            }


        } else {
            RepositoryProduct::where('hr_product_id', $product)
                ->update(['hr_product_stock' => $request->computing_repository_requirement]);
        }


        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);


    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_comment' => 'required',
        ]);

        //      deleted last rows of this product
        $repository_product_latest = RepositoryProduct::select('id')->where('hr_product_id', $request->hr_product_id)->where('hr_repository_id', $request->hr_repository_id)->get();
        foreach ($repository_product_latest as $delete_latest_row) {
            $repository_products = RepositoryProduct::find($delete_latest_row->id);
            $repository_products->delete();
        }

        //change invertory of returns value
        if ($request->hr_repository_id_goal != '') {
            $repository_product_goal = RepositoryProduct::select('*')->where('hr_product_id', $request->hr_product_id)->where('hr_repository_id', $request->hr_repository_id_goal)->get();
            foreach ($repository_product_goal as $delete_latest_row) {
                $repository_products = RepositoryProduct::find($delete_latest_row->id);
                $repository_products->delete();
            }
            foreach ($repository_product_goal as $add_row) {
                if ($add_row->hr_product_stock != '') {
                    $compute = $add_row->hr_product_stock + $request->hr_return_value;
                    $repository_product_goal_n = new RepositoryProduct();
                    $repository_product_goal_n->hr_product_id = $add_row->hr_product_id;
                    $repository_product_goal_n->hr_comment = $request->hr_status_return_part;
                    $repository_product_goal_n->hr_entry_date = $request->hr_exit;
                    $repository_product_goal_n->hr_provider_code = $add_row->hr_provider_code;
                    $repository_product_goal_n->hr_return_value = $request->hr_return_value;
                    $repository_product_goal_n->hr_status_return_part = $request->hr_status_return_part;
                    $repository_product_goal_n->hr_repository_id = $request->hr_repository_id_goal;
                    $repository_product_goal_n->hr_product_stock = $compute;
                    $repository_product_goal_n->save();
                }
            }
//            if (empty($repository_product_goal->id)) {
//                $repository_product_goal_n = new RepositoryProduct();
//                $repository_product_goal_n->hr_product_id = $request->hr_product_id;
//                $repository_product_goal_n->hr_comment = $request->hr_status_return_part;
//                $repository_product_goal_n->hr_entry_date = $request->hr_exit;
//                $repository_product_goal_n->hr_provider_code = $request->hr_provider_code;
//                $repository_product_goal_n->hr_return_value = $request->hr_return_value;
//                $repository_product_goal_n->hr_status_return_part = $request->hr_status_return_part;
//                $repository_product_goal_n->hr_repository_id = $request->hr_repository_id_goal;
//                $repository_product_goal_n->hr_product_stock = $request->hr_return_value;
//                $repository_product_goal_n->save();
//            }
        }
        //end

        $repository_product = new RepositoryProduct();
        $repository_product->hr_product_id = $request->hr_product_id;
        $repository_product->hr_product_stock = $request->hr_product_stock;
        $repository_product->hr_comment = $request->hr_comment;
        $repository_product->hr_entry_date = $request->hr_entry_date;
        $repository_product->hr_exit = $request->hr_exit;
        $repository_product->hr_contradiction = $request->hr_contradiction;
        $repository_product->hr_provider_code = $request->hr_provider_code;
        $repository_product->hr_return_value = $request->hr_return_value;
        $repository_product->hr_status_return_part = $request->hr_status_return_part;
        $repository_product->hr_repository_id = $request->hr_repository_id;
        if ($request->hr_entry_date != '') {
            $repository_product->hr_product_stock = $request->hr_product_stock + $request->hr_count;
        }
        if ($request->hr_exit != '') {
            $repository_product->hr_product_stock = $request->hr_product_stock - $request->hr_count;
        }
        if ($request->hr_product_stock_base != '') {
            $repository_product->hr_product_stock = $request->hr_product_stock_base;
        }
        $repository_product->save();


        return json_encode(["response" => "OK"]);
    }

    public
    function destroy($id)
    {
        $repository_products = RepositoryProduct::find($id);
        $repository_products->delete();
        return json_encode(["response" => "OK"]);
    }

    //    end charging

    //fill data to repositories
    public function fill(Request $request)
    {
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
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_product.deleted_at', '=', null)
                ->orderBy('hnt_repository_product.id','desc')
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
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository_product.created_at', 'LIKE', "%$search%")
                ->where('hnt_repository_product.deleted_at', '=', null)
                ->orderBy('hnt_repository_product.id','desc')
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

    //    fill data to repositories
    public
    function fill_p(Request $request)
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
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->orderBy('hnt_repository_product.id','desc')
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
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository_product.created_at', 'LIKE', "%$search%")
                ->orderBy('hnt_repository_product.id','desc')
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
    //end filling


    //fill data to repositories
    public function fill_all(Request $request)
    {
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
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->orderBy('hnt_repository_product.id','desc')
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
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository_product.created_at', 'LIKE', "%$search%")
                ->orderBy('hnt_repository_product.id','desc')
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
