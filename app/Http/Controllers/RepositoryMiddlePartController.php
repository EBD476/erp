<?php

namespace App\Http\Controllers;

use App\RepositoryMiddlePart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class RepositoryMiddlePartController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'hrm_middle_part_id' => 'required',
            'hrm_count' => 'required',
            'hrm_comment' => 'required',
        ]);

        $repository_middle_part = new RepositoryMiddlePart();
        $repository_middle_part->hrm_middle_part_id = $request->hrm_middle_part_id;
        $repository_middle_part->hrm_count = $request->hrm_count;
        $repository_middle_part->hrm_comment = $request->hrm_comment;
        $repository_middle_part->hrm_entry_date = $request->hrm_entry_date;
        $repository_middle_part->hrm_provider_code = $request->hrm_provider_code;
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hrm_middle_part_id' => 'required',
            'hrm_count' => 'required',
            'hrm_comment' => 'required',
        ]);
        $repository_middle_part = RepositoryMiddlePart::find($id);
        $repository_middle_part->hrm_middle_part_id = $request->hrm_middle_part_id;
        $repository_middle_part->hrm_count = $request->hrm_count;
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

    public function destroy($id)
    {
        $repository_products = RepositoryMiddlePart::find($id);
        $repository_products->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد . ');
    }
}
