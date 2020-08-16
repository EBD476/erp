<?php

namespace App\Http\Controllers;

use App\InventoryProduct;
use App\RepositoryCreate;
use App\RepositoryProduct;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Support\Facades\DB;

class InventoryProductController extends Controller
{


    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('verify_return_product_qc.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    //submit request verify inventory product and store in repository product
    public function store(Request $request)
    {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_comment' => 'required',
        ]);
        $repository_product = new InventoryProduct();
        $repository_product->hr_product_id = $request->hr_product_id;
        $repository_product->hr_repository_goal_id = $request->hr_repository_id_goal;
        $repository_product->hr_comment = $request->hr_comment;
        $repository_product->hr_exit = $request->hr_exit;
        $repository_product->hr_contradiction = $request->hr_contradiction;
        $repository_product->hr_return_value = $request->hr_return_value;
        $repository_product->hr_status_return_part = $request->hr_status_return_part;
        $repository_product->hr_repository_id = $request->hr_repository_id;
        $repository_product->hr_count = $request->hr_count;
        $repository_product->save();


        return json_encode(["response" => "OK"]);
    }


    //submit verify inventory product and store in repository product
    public function update(Request $request, $id)
    {

//        update verify
        InventoryProduct::where('id', $id)->update(['hr_verify_repository_goal' => $request->hr_verify_repository_goal]);

        //APPLY in data of  source repository product
        //deleted last rows of this product
        $repository_product_latest = RepositoryProduct::select('id', 'hr_product_stock','hr_provider_code')->where('hr_product_id', $request->hr_product_id)->where('hr_repository_id', $request->hr_repository_id)->get()->last();
        $repository_products = RepositoryProduct::find($repository_product_latest->id);
        $repository_products->delete();

        //change inventory of returns value
        if ($request->hr_repository_goal_id != '') {
            $repository_product_goal = RepositoryProduct::select('*')->where('hr_product_id', $request->hr_product_id)->where('hr_repository_id', $request->hr_repository_goal_id)->get();
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
                    $repository_product_goal_n->hr_repository_id = $request->hr_repository_goal_id;
                    $repository_product_goal_n->hr_product_stock = $compute;
                    $repository_product_goal_n->save();
                }
            }
//            if (empty($repository_product_goal)) {
//                $repository_product_goal_n = new RepositoryProduct();
//                $repository_product_goal_n->hr_product_id = $request->hr_product_id;
//                $repository_product_goal_n->hr_comment = $request->hr_status_return_part;
//                $repository_product_goal_n->hr_entry_date = $request->hr_exit;
//                $repository_product_goal_n->hr_provider_code = $request->hr_provider_code;
//                $repository_product_goal_n->hr_return_value = $request->hr_return_value;
//                $repository_product_goal_n->hr_status_return_part = $request->hr_status_return_part;
//                $repository_product_goal_n->hr_repository_id = $request->hr_repository_goal_id;
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
        $repository_product->hr_provider_code = $repository_product_latest->hr_provider_code;
        $repository_product->hr_return_value = $request->hr_return_value;
        $repository_product->hr_status_return_part = $request->hr_status_return_part;
        $repository_product->hr_repository_id = $request->hr_repository_id;
        $repository_product->hr_product_stock = $repository_product_latest->hr_product_stock - $request->hr_count;
        $repository_product->save();

        return json_encode(["response" => "OK"]);

    }

    //fill data to repositories inventory
    public function fill(Request $request)
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
            $repository_product = DB::table('hnt_repository_product_inventory_verify')
                ->join('hnt_products', 'hnt_repository_product_inventory_verify.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->joinSub($repository_user_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->select('hnt_repository_product_inventory_verify.id', 'hnt_repository_product_inventory_verify.hr_product_id', 'hnt_repository_product_inventory_verify.created_at', 'hnt_repository_product_inventory_verify.hr_verify_repository_goal', 'hnt_repository_product_inventory_verify.hr_entry_date', 'hnt_repository_product_inventory_verify.hr_exit', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', 'hnt_repository_product_inventory_verify.hr_return_value', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_repository_id', 'hnt_repository_product_inventory_verify.hr_status_return_part', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_repository.hr_name', 'hnt_repository_product_inventory_verify.hr_count')
                ->where('hnt_repository_product_inventory_verify.hr_verify_repository_goal','=' ,Null)
                ->orderBy('hnt_repository_product_inventory_verify.id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_product_inventory_verify')
                ->join('hnt_products', 'hnt_repository_product_inventory_verify.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->joinSub($repository_user_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->select('hnt_repository_product_inventory_verify.id', 'hnt_repository_product_inventory_verify.hr_product_id', 'hnt_repository_product_inventory_verify.hr_count', 'hnt_repository_product_inventory_verify.created_at', 'hnt_repository_product_inventory_verify.hr_verify_repository_goal', 'hnt_repository_product_inventory_verify.hr_entry_date', 'hnt_repository_product_inventory_verify.hr_exit', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', 'hnt_repository_product_inventory_verify.hr_return_value', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_repository_id', 'hnt_repository_product_inventory_verify.hr_status_return_part', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_repository.hr_name')
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository_product_inventory_verify.created_at', 'LIKE', "%$search%")
                ->where('hnt_repository_product_inventory_verify.hr_verify_repository_goal','=' ,Null)
                ->orderBy('hnt_repository_product_inventory_verify.id', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $repo_name = RepositoryCreate::select('hr_name')->where('hr_priority_id', $repository_products->hr_repository_id)->get()->last();
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hp_product_name . " " . $repository_products->hp_product_model . " " . $repository_products->hn_color_name . " " . $repository_products->hpp_property_name . '",' . '"' . $repository_products->hr_return_value . '",' . '"' . $repo_name->hr_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . verta($repository_products->created_at) . '",' . '"' . $repository_products->hr_entry_date . '",' . '"' . $repository_products->hr_exit . '",' . '"' . $repository_products->hr_contradiction . '",' . '"' . $repository_products->hr_status_return_part . '",' . '"' . $repository_products->hr_verify_repository_goal . '",' . '"' . $repository_products->hr_repository_id . '",' . '"' . $repository_products->hr_product_id . '",' . '"' . $repository_products->id . '",' . '"' . $repository_products->hr_repository_goal_id . '",' . '"' . $repository_products->hr_comment . '",' . '"' . $repository_products->hr_count . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryProduct::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    } //fill data to repositories inventory

    public function fill_all(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_product_inventory_verify')
                ->join('hnt_products', 'hnt_repository_product_inventory_verify.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->select('hnt_repository_product_inventory_verify.id', 'hnt_repository_product_inventory_verify.hr_product_id', 'hnt_repository_product_inventory_verify.created_at', 'hnt_repository_product_inventory_verify.hr_verify_repository_goal', 'hnt_repository_product_inventory_verify.hr_entry_date', 'hnt_repository_product_inventory_verify.hr_exit', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', 'hnt_repository_product_inventory_verify.hr_return_value', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_repository_id', 'hnt_repository_product_inventory_verify.hr_status_return_part', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_repository.hr_name', 'hnt_repository_product_inventory_verify.hr_count')
                ->orderBy('hnt_repository_product_inventory_verify.id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_product_inventory_verify')
                ->join('hnt_products', 'hnt_repository_product_inventory_verify.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', '=', 'hnt_repository.hr_priority_id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->select('hnt_repository_product_inventory_verify.id', 'hnt_repository_product_inventory_verify.hr_product_id', 'hnt_repository_product_inventory_verify.hr_count', 'hnt_repository_product_inventory_verify.created_at', 'hnt_repository_product_inventory_verify.hr_verify_repository_goal', 'hnt_repository_product_inventory_verify.hr_entry_date', 'hnt_repository_product_inventory_verify.hr_exit', 'hnt_repository_product_inventory_verify.hr_repository_goal_id', 'hnt_repository_product_inventory_verify.hr_return_value', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_repository_id', 'hnt_repository_product_inventory_verify.hr_status_return_part', 'hnt_repository_product_inventory_verify.hr_comment', 'hnt_repository_product_inventory_verify.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_repository.hr_name', 'hnt_products.hp_product_model', 'hnt_products.hp_product_property', 'hnt_products.hp_product_size', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_repository.hr_name')
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository_product_inventory_verify.created_at', 'LIKE', "%$search%")
                ->orderBy('hnt_repository_product_inventory_verify.id', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $repo_name = RepositoryCreate::select('hr_name')->where('hr_priority_id', $repository_products->hr_repository_id)->get()->last();
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hp_product_name . " " . $repository_products->hp_product_model . " " . $repository_products->hn_color_name . " " . $repository_products->hpp_property_name . '",' . '"' . $repository_products->hr_return_value . '",' . '"' . $repo_name->hr_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . verta($repository_products->created_at) . '",' . '"' . $repository_products->hr_entry_date . '",' . '"' . $repository_products->hr_exit . '",' . '"' . $repository_products->hr_contradiction . '",' . '"' . $repository_products->hr_status_return_part . '",' . '"' . $repository_products->hr_verify_repository_goal . '",' . '"' . $repository_products->hr_repository_id . '",' . '"' . $repository_products->hr_product_id . '",' . '"' . $repository_products->id . '",' . '"' . $repository_products->hr_repository_goal_id . '",' . '"' . $repository_products->hr_comment . '",' . '"' . $repository_products->hr_count . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryProduct::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }
}
