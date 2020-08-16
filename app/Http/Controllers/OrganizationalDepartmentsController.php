<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\OrganizationalDepartments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationalDepartmentsController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('organizational_departments.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hod_name' => 'required',
            'hod_role_id' => 'required',
        ]);
            $department = new OrganizationalDepartments();
            $department->hod_name = $request->hod_name;
            $department->hod_role_id = $request->hod_role_id;
            $department->save();
        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hod_name' => 'required',
            'hod_role_id' => 'required',
        ]);
        $department = OrganizationalDepartments::find($id);
        $department->hod_name = $request->hod_name;
        $department->hod_role_id = $request->hod_role_id;
        $department->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $department = OrganizationalDepartments::find($id);
        $department->delete();
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
                    $department = DB::Table('hnt_organizational_departments')
                        ->join('roles', 'hnt_organizational_departments.hod_role_id', 'roles.id')
                        ->select('hnt_organizational_departments.id', 'hnt_organizational_departments.hod_role_id', 'hnt_organizational_departments.hod_name', 'roles.name')
                        ->where('hnt_organizational_departments.deleted_at', '=', Null)
                        ->orderBy('roles.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }

            } else {
                $department = DB::Table('hnt_organizational_departments')
                    ->join('roles', 'hnt_organizational_departments.hod_role_id', 'roles.id')
                    ->select('hnt_organizational_departments.id', 'hnt_organizational_departments.hod_role_id', 'hnt_organizational_departments.hod_name', 'roles.name')
                    ->where('hnt_organizational_departments.deleted_at', '=', Null)
                    ->skip($start)
                    ->take($length)
                    ->get();
            }
        } else {
            $department =DB::Table('hnt_organizational_departments')
                ->join('roles', 'hnt_organizational_departments.hhd_role_id_send_massage', 'roles.id')
                ->select('hnt_organizational_departments.id', 'hnt_organizational_departments.hod_role_id', 'hnt_organizational_departments.hod_name', 'roles.name')
                ->where('hnt_organizational_departments.deleted_at', '=', Null)
                ->where('roles.name', 'LIKE', "%$search%")
                ->orwhere('hnt_organizational_departments.hod_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($department as $limits) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $limits->hod_name . '",' . '"' . $limits->name . '",' . '"' . $limits->hod_role_id . '",' . '"' . $limits->id . '"],';
        }
        $data = substr($data, 0, -1);
        $department_count = OrganizationalDepartments::all()->count();
        return response('{ "recordsTotal":' . $department_count . ',"recordsFiltered":' . $department_count . ',"data": [' . $data . ']}');
    }
    //fill select to
    public function json_data_fill_department(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $receiver = OrganizationalDepartments::select('hod_name as text', 'id')->where('hod_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $receiver]);
    }
}
