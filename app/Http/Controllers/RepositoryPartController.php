<?php

namespace App\Http\Controllers;

use App\RepositoryPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepositoryPartController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'hrp_part_id' => 'required',
            'hrp_repository_id' => 'required',
            'hrp_part_count' => 'required',
        ]);
        $repository = new RepositoryPart();
        $repository->hrp_part_id = $request->hrp_part_id;
        $repository->hrp_repository_id = $request->hrp_repository_id;
        $repository->hrp_part_count = $request->hrp_part_count;
        $repository->hrp_part_count = $request->hrp_part_count;
        $repository->hrp_comment = $request->hrp_comment;
        $repository->hrp_exit = $request->hrp_exit;
        $repository->hrp_contradiction = $request->hrp_contradiction;
        $repository->hrp_return_value = $request->hrp_return_value;
        $repository->hrp_status_return_part = $request->hrp_status_return_part;
        $repository->hrp_provider_code = $request->hrp_provider_code;
        $repository->hrp_entry_date = $request->hrp_entry_date;
        $repository->save();
        return json_encode(["response" => "OK"]);

    }

    public function destroy($id)
    {
        $repository = RepositoryPart::find($id);
        $repository->delete();
        return json_encode(["response" => "OK"]);
    }

    //fill data table index repository
    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository = DB::table('hnt_repository_part')
                ->join('hnt_parts', 'hnt_repository_part.hrp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_provider', 'hnt_repository_part.hrp_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_part.hrp_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_part.id', 'hnt_repository_part.hrp_part_id', 'hnt_repository_part.hrp_part_count', 'hnt_repository_part.hrp_entry_date', 'hnt_repository_part.hrp_exit', 'hnt_repository_part.hrp_provider_code', 'hnt_repository_part.hrp_return_value', 'hnt_repository_part.hrp_comment', 'hnt_repository_part.hrp_repository_id', 'hnt_repository_part.hrp_status_return_part', 'hnt_repository_part.hrp_contradiction', 'hnt_parts.hp_name', 'hnt_provider.hp_name as name', 'hnt_repository.hr_name')
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository = DB::table('hnt_repository_part')
                ->join('hnt_parts', 'hnt_repository_part.hrp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_provider', 'hnt_repository_part.hrp_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_part.hrp_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_part.id', 'hnt_repository_part.hrp_part_id', 'hnt_repository_part.hrp_part_count', 'hnt_repository_part.hrp_entry_date', 'hnt_repository_part.hrp_exit', 'hnt_repository_part.hrp_provider_code', 'hnt_repository_part.hrp_return_value', 'hnt_repository_part.hrp_comment', 'hnt_repository_part.hrp_repository_id', 'hnt_repository_part.hrp_status_return_part', 'hnt_repository_part.hrp_contradiction', 'hnt_parts.hp_name', 'hnt_provider.hp_name as name', 'hnt_repository.hr_name')
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->where('hnt_parts.hp_name', 'LIKE', "%$search%")
//                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
//                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository as $repositories) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repositories->hp_name . '",' . '"' . $repositories->hrp_part_count . '",' . '"' . $repositories->name . '",' . '"' . $repositories->hr_name . '",' . '"' . $repositories->hrp_entry_date . '",' . '"' . $repositories->hrp_exit . '",' . '"' . $repositories->hrp_return_value . '",' . '"' . $repositories->hrp_contradiction . '",' . '"' . $repositories->hrp_status_return_part . '",' . '"' . $repositories->hrp_comment . '",' . '"' . $repositories->hrp_provider_code . '",' . '"' . $repositories->hrp_repository_id . '",' . '"' . $repositories->hrp_part_id . '",' . '"' . $repositories->id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_count = RepositoryPart::all()->count();
        return response('{ "recordsTotal":' . $repository_count . ',"recordsFiltered":' . $repository_count . ',"data": [' . $data . ']}');
    }

    //fill data table index invoices list product
    public function fill_p(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository = DB::table('hnt_repository_part')
                ->join('hnt_parts', 'hnt_repository_part.hrp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_repository', 'hnt_repository_part.hrp_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_part.id', 'hnt_repository_part.hrp_part_count', 'hnt_parts.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository = DB::table('hnt_repository_part')
                ->join('hnt_parts', 'hnt_repository_part.hrp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_provider', 'hnt_repository_part.hrp_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_part.hrp_repository_id', '=', 'hnt_repository.id')
                ->where('hnt_repository_part.deleted_at', '=', Null)
                ->where('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($repository as $repositories) {
            $key++;
            $data .= '["' . $key. '",' . '"' . $repositories->hp_name . '",' . '"' . $repositories->hrp_part_count . '",' . '"' . $repositories->hr_name . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_count = RepositoryPart::all()->count();
        return response('{ "recordsTotal":' . $repository_count . ',"recordsFiltered":' . $repository_count . ',"data": [' . $data . ']}');
    }

}
