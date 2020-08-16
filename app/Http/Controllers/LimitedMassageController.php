<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\LimitedMassage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class LimitedMassageController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('conversation_view.limited_massage.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hhd_role_id_receive_massage' => 'required',
            'hhd_role_id_send_massage' => 'required',
        ]);
        $size_name = count(collect($request)->get('hhd_role_id_receive_massage'));
        if ($size_name == 1) {
            $limit = new LimitedMassage();
            $limit->hhd_role_id_send_massage = $request->hhd_role_id_send_massage;
            $limit->hhd_role_id_receive_massage = $request->hhd_role_id_receive_massage[0];
            $limit->save();
        } else {
            $item = $request->hhd_role_id_receive_massage;
            $index = 0;
            foreach ($item as $items) {
                $limit = new LimitedMassage();
                $limit->hhd_role_id_send_massage = $request->hhd_role_id_send_massage;
                $limit->hhd_role_id_receive_massage = $request->hhd_role_id_receive_massage[$index];
                $limit->save();
                $index++;
            }
        }
        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hhd_role_id_send_massage' => 'required',
            'hhd_role_id_receive_massage' => 'required',
        ]);
        $limit = LimitedMassage::find($id);
        $limit->hhd_role_id_send_massage = $request->hhd_role_id_send_massage;
        $limit->hhd_role_id_receive_massage = $request->hhd_role_id_receive_massage;
        $limit->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $limit = LimitedMassage::find($id);
        $limit->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            if ($sort && $orderable != '') {
                if ($sort == 1) {
                    $limit = DB::Table('hnt_limited_user_massage')
                        ->join('roles', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'roles.id')
                        ->select('hnt_limited_user_massage.id', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'hnt_limited_user_massage.hhd_role_id_receive_massage', 'roles.name')
                        ->where('hnt_limited_user_massage.deleted_at', '=', Null)
                        ->orderBy('roles.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if ($sort == 2) {
                    $limit = DB::Table('hnt_limited_user_massage')
                        ->join('roles', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'roles.id')
                        ->select('hnt_limited_user_massage.id', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'hnt_limited_user_massage.hhd_role_id_receive_massage', 'roles.name')
                        ->where('hnt_limited_user_massage.deleted_at', '=', Null)
                        ->orderBy('roles.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
            } else {
                $limit = DB::Table('hnt_limited_user_massage')
                    ->join('roles', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'roles.id')
                    ->select('hnt_limited_user_massage.id', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'hnt_limited_user_massage.hhd_role_id_receive_massage', 'roles.name')
                    ->where('hnt_limited_user_massage.deleted_at', '=', Null)
                    ->skip($start)
                    ->take($length)
                    ->get();
            }
        } else {
            $limit = DB::Table('hnt_limited_user_massage')
                ->join('roles', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'roles.id')
                ->select('hnt_limited_user_massage.id', 'hnt_limited_user_massage.hhd_role_id_send_massage', 'hnt_limited_user_massage.hhd_role_id_receive_massage', 'roles.name')
                ->where('hnt_limited_user_massage.deleted_at', '=', Null)
                ->orwhere('roles.name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($limit as $limits) {
            $receiver = Role::select('name')->where('id', $limits->hhd_role_id_receive_massage)->get()->last();
            $key++;
            $data .= '["' . $key . '",' . '"' . $limits->name . '",' . '"' . $receiver->name . '",' . '"' . $limits->hhd_role_id_send_massage . '",' . '"' . $limits->hhd_role_id_receive_massage . '",' . '"' . $limits->id . '"],';
        }
        $data = substr($data, 0, -1);
        $limits_count = LimitedMassage::all()->count();
        return response('{ "recordsTotal":' . $limits_count . ',"recordsFiltered":' . $limits_count . ',"data": [' . $data . ']}');
    }

    public function fill_data_limited_user(Request $request)
    {
        $current_user = auth()->user()->id;
        $current_user_role_id = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->select('model_has_roles.role_id')
            ->where('users.id', '=', $current_user)
            ->get()
            ->last();
        $receiver_user_role_id = DB::table('hnt_limited_user_massage')
            ->select('hnt_limited_user_massage.hhd_role_id_receive_massage')
            ->where('hnt_limited_user_massage.hhd_role_id_send_massage', '=', $current_user_role_id->role_id)
            ->where('hnt_limited_user_massage.deleted_at', '=', Null);
        $search = $request->search;
        if ($search != "") {
            $receiver = DB::table('users')
                ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->join('hnt_position_user', 'users.position', 'hnt_position_user.id')
                ->joinSub($receiver_user_role_id, 'latest_posts', function ($join) {
                    $join->on('model_has_roles.role_id', '=', 'latest_posts.hhd_role_id_receive_massage');
                })
                ->select('users.name as text', 'users.id', 'hnt_position_user.hpu_name as position')
                ->where('users.name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $receiver]);

    }
}




//$current_user = auth()->user()->id;
//$current_user_role_id = DB::table('users')
//    ->join('model_has_roles','users.id','model_has_roles.model_id')
//    ->select('model_has_roles.role_id')
//    ->where('users.id','=',$current_user)
//    ->get()
//    ->last();
//$receiver_user_role_id = DB::table('hnt_limited_user_massage')
//    ->select('hnt_limited_user_massage.hhd_role_id_receive_massage')
//    ->where('hnt_limited_user_massage.hhd_role_id_send_massage','=',$current_user_role_id->role_id)
//    ->where('hnt_limited_user_massage.deleted_at', '=', Null)
//    ->get();
//$search = $request->search;
//$data = '';
//foreach ($receiver_user_role_id as $model_id) {
//    if ($search != "") {
//        $receiver = DB::table('users')
//            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
//            ->join('hnt_position_user', 'users.position', 'hnt_position_user.id')
//            ->select('users.name as text', 'users.id', 'hnt_position_user.hpu_name as position')
//            ->where('model_has_roles.role_id','=',$model_id->hhd_role_id_receive_massage)
//            ->where('users.name', 'LIKE', "%$search%")
//            ->get();
//    }
//    $data .='["' . $receiver->text . '","' . $receiver->position . '","' . $receiver->id . '",]';
//}
//$data = substr($data, 0, -1);
//dd($data);
//return response('{"results": [' . $data . ']}');