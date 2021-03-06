<?php

namespace App\Http\Controllers;

use App\RepositoryMiddlePart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class RepositoryMiddlePartController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'hrm_middle_part_id' => 'required',
            'hrm_comment' => 'required',
        ]);

        //      deleted last rows of this product
        $repository_middle_part_latest = RepositoryMiddlePart::select('id')->where('hrm_middle_part_id', $request->hrm_middle_part_id)->where('hrm_repository_id', $request->hrm_repository_id)->get();
        foreach ($repository_middle_part_latest as $delete_latest_row) {
            $repository_middle_part = RepositoryMiddlePart::find($delete_latest_row->id);
            $repository_middle_part->delete();
        }


        //change invertory of returns value
        if ($request->hrm_repository_id_goal != '') {
            $repository_middle_part_goal = RepositoryMiddlePart::select('*')->where('hrm_middle_part_id', $request->hrm_middle_part_id)->where('hrm_repository_id', $request->hrm_repository_id_goal)->get();
            foreach ($repository_middle_part_goal as $delete_latest_row) {
                $repository_middle_part = RepositoryMiddlePart::find($delete_latest_row->id);
                $repository_middle_part->delete();
            }
            foreach ($repository_middle_part_goal as $add_row) {
                if ($add_row->hrm_count != '') {
                    $compute = $add_row->hrm_count + $request->hrm_return_value;
                    $repository_middle_part_goal_n = new RepositoryMiddlePart();
                    $repository_middle_part_goal_n->hrm_middle_part_id = $add_row->hrm_middle_part_id;
                    $repository_middle_part_goal_n->hrm_comment = $request->hrm_status_return_part;
                    $repository_middle_part_goal_n->hrm_entry_date = $request->hrm_exit;
                    $repository_middle_part_goal_n->hrm_provider_code = $request->hrm_provider_code;
                    $repository_middle_part_goal_n->hrm_return_value = $request->hrm_return_value;
                    $repository_middle_part_goal_n->hrm_status_return_part = $request->hrm_status_return_part;
                    $repository_middle_part_goal_n->hrm_repository_id = $request->hrm_repository_id_goal;
                    $repository_middle_part_goal_n->hrm_count = $compute;
                    $repository_middle_part_goal_n->save();
                }

            }
//            if (empty($repository_middle_part_goal->id)) {
//                $repository_middle_part_goal_n = new RepositoryMiddlePart();
//                $repository_middle_part_goal_n->hrm_middle_part_id = $request->hrm_middle_part_id;
//                $repository_middle_part_goal_n->hrm_comment = $request->hrm_status_return_part;
//                $repository_middle_part_goal_n->hrm_entry_date = $request->hrm_exit;
//                $repository_middle_part_goal_n->hrm_provider_code = $request->hrm_provider_code;
//                $repository_middle_part_goal_n->hrm_return_value = $request->hrm_return_value;
//                $repository_middle_part_goal_n->hrm_status_return_part = $request->hrm_status_return_part;
//                $repository_middle_part_goal_n->hrm_repository_id = $request->hrm_repository_id_goal;
//                $repository_middle_part_goal_n->hrm_count = $request->hrm_return_value;
//                $repository_middle_part_goal_n->save();
//            }
        }
        //end


        $repository_middle_part = new RepositoryMiddlePart();
        $repository_middle_part->hrm_middle_part_id = $request->hrm_middle_part_id;

        if ($request->hrm_entry_date != '') {
            $repository_middle_part->hrm_count = $request->hrm_count + $request->hrm_product_stock;
        }
        if ($request->hrm_exit != '') {
            $repository_middle_part->hrm_count = $request->hrm_count - $request->hrm_product_stock;
        }
        if ($request->hrm_count_base != '') {
            $repository_middle_part->hrm_count = $request->hrm_count_base;
        }
        $repository_middle_part->hrm_comment = $request->hrm_comment;
        $repository_middle_part->hrm_entry_date = $request->hrm_entry_date;
        $repository_middle_part->hrm_exit = $request->hrm_exit;
        $repository_middle_part->hrm_contradiction = $request->hrm_contradiction;
        $repository_middle_part->hrm_provider_code = $request->hrm_provider_code;
        $repository_middle_part->hrm_return_value = $request->hrm_return_value;
        $repository_middle_part->hrm_status_return_part = $request->hrm_status_return_part;
        $repository_middle_part->hrm_repository_id = $request->hrm_repository_id;
        $repository_middle_part->save();
        return json_encode(["response" => "OK"]);

    }

    public function edit($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_middle_part = RepositoryMiddlePart::find($id);
        return view('Repository . edit', compact('repository_middle_part', 'type', 'priority', 'help_desk', 'user'));
    }

    public function destroy($id)
    {
        $repository_products = RepositoryMiddlePart::find($id);
        $repository_products->delete();
        return json_encode(["response" => "OK"]);
    }


    //    fill data table index repository
    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_provider', 'hnt_repository_middle_part.hrm_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_middle_part_id', 'hnt_repository_middle_part.hrm_count', 'hnt_repository_middle_part.hrm_entry_date', 'hnt_repository_middle_part.hrm_exit', 'hnt_repository_middle_part.hrm_provider_code', 'hnt_repository_middle_part.hrm_return_value', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_repository_id', 'hnt_repository_middle_part.hrm_status_return_part', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_contradiction', 'hnt_middle_part.hmp_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_middle_part.deleted_at', '=', null)
                ->orderBy('hnt_repository_middle_part.id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_provider', 'hnt_repository_middle_part.hrm_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_middle_part_id', 'hnt_repository_middle_part.hrm_count', 'hnt_repository_middle_part.hrm_entry_date', 'hnt_repository_middle_part.hrm_exit', 'hnt_repository_middle_part.hrm_provider_code', 'hnt_repository_middle_part.hrm_return_value', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_repository_id', 'hnt_repository_middle_part.hrm_status_return_part', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_contradiction', 'hnt_middle_part.hmp_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->where('hnt_repository_middle_part.deleted_at', '=', null)
                ->orderBy('hnt_repository_middle_part.id', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hmp_name . '",' . '"' . $repository_products->hrm_count . '",' . '"' . $repository_products->hp_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . $repository_products->hrm_comment . '",' . '"' . $repository_products->hrm_entry_date . '",' . '"' . $repository_products->hrm_exit . '",' . '"' . $repository_products->hrm_return_value . '",' . '"' . $repository_products->hrm_contradiction . '",' . '"' . $repository_products->hrm_status_return_part . '",' . '"' . $repository_products->hrm_provider_code . '",' . '"' . $repository_products->hrm_repository_id . '",' . '"' . $repository_products->hrm_middle_part_id . '",' . '"' . $repository_products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryMiddlePart::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }

//    fill all data table index repository
    public function fill_all(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_provider', 'hnt_repository_middle_part.hrm_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_middle_part_id', 'hnt_repository_middle_part.hrm_count', 'hnt_repository_middle_part.hrm_entry_date', 'hnt_repository_middle_part.hrm_exit', 'hnt_repository_middle_part.hrm_provider_code', 'hnt_repository_middle_part.hrm_return_value', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_repository_id', 'hnt_repository_middle_part.hrm_status_return_part', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_contradiction', 'hnt_middle_part.hmp_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->orderBy('hnt_repository_middle_part.id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_provider', 'hnt_repository_middle_part.hrm_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.hr_priority_id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_middle_part_id', 'hnt_repository_middle_part.hrm_count', 'hnt_repository_middle_part.hrm_entry_date', 'hnt_repository_middle_part.hrm_exit', 'hnt_repository_middle_part.hrm_provider_code', 'hnt_repository_middle_part.hrm_return_value', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_repository_id', 'hnt_repository_middle_part.hrm_status_return_part', 'hnt_repository_middle_part.hrm_comment', 'hnt_repository_middle_part.hrm_contradiction', 'hnt_middle_part.hmp_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->orderBy('hnt_repository_middle_part.id', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hmp_name . '",' . '"' . $repository_products->hrm_count . '",' . '"' . $repository_products->hp_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . $repository_products->hrm_comment . '",' . '"' . $repository_products->hrm_entry_date . '",' . '"' . $repository_products->hrm_exit . '",' . '"' . $repository_products->hrm_return_value . '",' . '"' . $repository_products->hrm_contradiction . '",' . '"' . $repository_products->hrm_status_return_part . '",' . '"' . $repository_products->hrm_provider_code . '",' . '"' . $repository_products->hrm_repository_id . '",' . '"' . $repository_products->hrm_middle_part_id . '",' . '"' . $repository_products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryMiddlePart::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }

//    fil data table index invoices list product
    public function fill_p(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_count', 'hnt_middle_part.hmp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_middle_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_middle_part')
                ->join('hnt_middle_part', 'hnt_repository_middle_part.hrm_middle_part_id', '=', 'hnt_middle_part.id')
                ->join('hnt_repository', 'hnt_repository_middle_part.hrm_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_middle_part.id', 'hnt_repository_middle_part.hrm_count', 'hnt_middle_part.hmp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_middle_part.deleted_at', '=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hmp_name . '",' . '"' . $repository_products->hrm_count . '",' . '"' . $repository_products->hr_name . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = RepositoryMiddlePart::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }


}
