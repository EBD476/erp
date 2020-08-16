<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HDTypeRole;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HDTypeRoleController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('help_desk.hd_type_role.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hhd_type_id' => 'required',
            'hhd_role_id' => 'required',
        ]);
        $size_name = count(collect($request)->get('hhd_role_id'));
        if ($size_name == 1) {
            $receiver = new HDTypeRole();
            $receiver->hhd_type_id = $request->hhd_type_id;
            $receiver->hhd_role_id = $request->hhd_role_id[0];
            $receiver->save();
        } else {
            $item = $request->hhd_role_id;
            $index = 0;
            foreach ($item as $items) {
                $receiver = new HDTypeRole();
                $receiver->hhd_type_id = $request->hhd_type_id;
                $receiver->hhd_role_id = $request->hhd_role_id[$index];
                $receiver->save();
                $index++;
            }
        }
        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hhd_type_id' => 'required',
            'hhd_role_id' => 'required',
        ]);
        $receiver = HDTypeRole::find($id);
        $receiver->hhd_type_id = $request->hhd_type_id;
        $receiver->hhd_role_id = $request->hhd_role_id;
        $receiver->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $receiver = HDTypeRole::find($id);
        $receiver->delete();
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
                    $receiver = DB::Table('hnt_hhd_help_desk_type_role')
                        ->join('hnt_th_type', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.id')
                        ->join('roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'roles.id')
                        ->select('hnt_hhd_help_desk_type_role.id', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.th_name', 'roles.name')
                        ->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)
                        ->orderBy('roles.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if ($sort == 2) {
                    $receiver = DB::Table('hnt_hhd_help_desk_type_role')
                        ->join('hnt_th_type', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.id')
                        ->join('roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'roles.id')
                        ->select('hnt_hhd_help_desk_type_role.id', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.th_name', 'roles.name')
                        ->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)
                        ->orderBy('hnt_th_type.th_name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if ($sort == 3) {
                    $receiver = DB::Table('hnt_hhd_help_desk_type_role')
                        ->join('hnt_th_type', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.id')
                        ->join('roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'roles.id')
                        ->select('hnt_hhd_help_desk_type_role.id', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.th_name', 'roles.name')
                        ->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)
                        ->orderBy('hnt_hd_receiver_user.hhru_name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
            } else {
                $receiver = DB::Table('hnt_hhd_help_desk_type_role')
                    ->join('hnt_th_type', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.id')
                    ->join('roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'roles.id')
                    ->select('hnt_hhd_help_desk_type_role.id', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.th_name', 'roles.name')
                    ->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)
                    ->skip($start)
                    ->take($length)
                    ->get();
            }
        } else {
            $receiver = DB::Table('hnt_hhd_help_desk_type_role')
                ->join('hnt_th_type', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.id')
                ->join('roles', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'roles.id')
                ->select('hnt_hhd_help_desk_type_role.id', 'hnt_hhd_help_desk_type_role.hhd_role_id', 'hnt_hhd_help_desk_type_role.hhd_type_id', 'hnt_th_type.th_name', 'roles.name')
                ->where('th_name', 'LIKE', "%$search%")
                ->orwhere('name', 'LIKE', "%$search%")
                ->where('hnt_hhd_help_desk_type_role.deleted_at', '=', Null)
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($receiver as $receivers) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $receivers->th_name . '",' . '"' . $receivers->name . '",' . '"' . $receivers->hhd_role_id . '",' . '"' . $receivers->hhd_type_id . '",' . '"' . $receivers->id . '"],';
        }
        $data = substr($data, 0, -1);
        $receivers_count = HDTypeRole::all()->count();
        return response('{ "recordsTotal":' . $receivers_count . ',"recordsFiltered":' . $receivers_count . ',"data": [' . $data . ']}');
    }


    //fill select to
    public function fill_type_ticket(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $receiver = HDtype::select('th_name as text', 'id')->where('th_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $receiver]);
    }

    //fill select to
    public function select_receiver_role(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $role = Role::select('name as text', 'id')->where('name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $role]);
    }
}
