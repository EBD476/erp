<?php

namespace App\Http\Controllers;

use App\RepositoryCreate;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

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
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository = new RepositoryCreate();
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
        $repository->save();
        return json_encode(["response" => "Done"]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository = RepositoryCreate::find($id);
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
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
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository = RepositoryCreate::select('id', 'hr_name', 'hr_description')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository = RepositoryCreate::select('id', 'hr_name', 'hr_description')
                ->where('id', 'LIKE', "%$search%")
                ->orwhere('hr_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($repository as $repositories) {
            $data .= '["' . $repositories->id . '",' . '"' . $repositories->hr_name . '",' . '"' . $repositories->hr_description . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_count = RepositoryCreate::all()->count();
        return response('{ "recordsTotal":' . $repository_count . ',"recordsFiltered":' . $repository_count . ',"data": [' . $data . ']}');
    }
}
