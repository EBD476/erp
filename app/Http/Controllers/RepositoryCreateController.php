<?php

namespace App\Http\Controllers;

use App\RepositoryCreate;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class RepositoryCreateController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('repository_create.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hr_priority_id' => 'required',
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository = new RepositoryCreate();
        $repository->hr_priority_id = $request->hr_priority_id;
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
        $repository->hr_department_id = $request->hr_department_id;
        $repository->save();
        return json_encode(["response" => "Done"]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hr_priority_id' => 'required',
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository = RepositoryCreate::find($id);
        $repository->hr_priority_id = $request->hr_priority_id;
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
        $repository->hr_department_id = $request->hr_department_id;
        $repository->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $repository = RepositoryCreate::find($id);
        $repository->delete();
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
            $repository = DB::table('hnt_repository')
                ->join('hnt_organizational_departments','hnt_repository.hr_department_id','hnt_organizational_departments.id')
                ->select('hnt_repository.id', 'hnt_repository.hr_name', 'hnt_repository.hr_description','hnt_repository.hr_priority_id','hnt_repository.hr_department_id','hnt_organizational_departments.hod_name')
               ->where('hnt_repository.deleted_at','=',Null)
                ->orderBy('hnt_repository.hr_priority_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository =DB::table('hnt_repository')
                ->join('hnt_organizational_departments','hnt_repository.hr_department_id','hnt_organizational_departments.id')
                ->select('hnt_repository.id', 'hnt_repository.hr_name', 'hnt_repository.hr_description','hnt_repository.hr_priority_id','hnt_repository.hr_department_id','hnt_organizational_departments.hod_name')
                ->where('hnt_repository.deleted_at','=',Null)
                ->orderBy('hnt_repository.hr_priority_id')
                ->where('hnt_organizational_departments.hod_name', 'LIKE', "%$search%")
                ->orwhere('hnt_repository.hr_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository as $repositories) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repositories->hr_name . '",' . '"' . $repositories->hr_description . '",' . '"' . $repositories->hod_name . '",' . '"' . $repositories->id . '",' . '"' . $repositories->hr_priority_id . '",' . '"' . $repositories->hr_department_id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_count = RepositoryCreate::all()->count();
        return response('{ "recordsTotal":' . $repository_count . ',"recordsFiltered":' . $repository_count . ',"data": [' . $data . ']}');
    }


    //fill select to
    public function fill_repository_name(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $repository = RepositoryCreate::select('hr_name as text', 'hr_priority_id as id')->where('hr_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $repository]);
    }
}
