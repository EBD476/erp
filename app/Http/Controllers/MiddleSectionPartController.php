<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\MiddleSectionPart;
use App\Part;
use App\ProductMiddlePart;
use App\ProductPart;
use App\RepositoryPart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class MiddleSectionPartController extends Controller
{
    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        return view('middle_section_part.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hpp_part_id' => 'required',
            'hpp_middle_part_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = new MiddleSectionPart();
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_middle_part_id = $request->hpp_middle_part_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();

        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hpp_part_id' => 'required',
            'hpp_middle_part_id' => 'required',
            'hpp_part_count' => 'required',
        ]);
        $product_part = MiddleSectionPart::find($id);
        $product_part->hpp_part_id = $request->hpp_part_id;
        $product_part->hpp_middle_part_id = $request->hpp_middle_part_id;
        $product_part->hpp_part_count = $request->hpp_part_count;
        $product_part->save();
        return json_encode(["response" => "OK"]);


    }

    public function destroy($id)
    {
        $product_part = MiddleSectionPart::find($id);
        $product_part->delete();
        return json_encode(["response" => "OK"]);
    }

    public function fill_data_middle_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $middle_part = MiddlePart::select('hmp_name as text', 'id', 'hmp_middle_part_model', 'hmp_serial_number', 'hmp_image')->where('hmp_name', 'LIKE', "%$search%")->orwhere('hmp_serial_number', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $middle_part]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $product_part = DB::table('hnt_middle_section_part')
                ->join('hnt_parts', 'hnt_middle_section_part.hpp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', '=', 'hnt_middle_part.id')
                ->select('hnt_middle_section_part.id', 'hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_parts.hp_name', 'hnt_middle_part.hmp_name')
                ->where('hnt_middle_section_part.deleted_at', '=', Null)
                ->skip($start)->take($length)->get();
        } else {
            $product_part = DB::table('hnt_middle_section_part')
                ->join('hnt_parts', 'hnt_middle_section_part.hpp_part_id', '=', 'hnt_parts.id')
                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', '=', 'hnt_middle_part.id')
                ->select('hnt_middle_section_part.id', 'hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_parts.hp_name', 'hnt_middle_part.hmp_name')
                ->where('hnt_middle_section_part.deleted_at', '=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($product_part as $product_parts) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $product_parts->hmp_name . '",' . '"' . $product_parts->hp_name . '",' . '"' . $product_parts->hpp_part_count . '",' . '"' . $product_parts->hpp_middle_part_id . '",' . '"' . $product_parts->hpp_part_id . '",' . '"' . $product_parts->id . '"],';
        }
        $data = substr($data, 0, -1);
        $product_parts = MiddleSectionPart::all()->count();
        return response('{ "recordsTotal":' . $product_parts . ',"recordsFiltered":' . $product_parts . ',"data": [' . $data . ']}');
    }

    public function computing_middle_part(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {

            $middle_part =  DB::Table('hnt_middle_section_part')
                ->Join('hnt_repository_part', 'hnt_middle_section_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_part.id')
                ->select('hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_middle_part.hmp_name')
                ->where('hnt_middle_section_part.deleted_at', '=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orderBy('hnt_middle_section_part.hpp_middle_part_id', 'DESC')
                ->groupBy('hnt_middle_section_part.hpp_middle_part_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
//            $middle_part = DB::Table('hnt_middle_section_part')
//                ->Join('hnt_repository_part', 'hnt_middle_section_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
//                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_part.id')
//                ->selectRaw('hnt_middle_section_part.hpp_part_id', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_middle_part.hmp_name','*,(hnt_repository_part.hrp_part_count/hnt_middle_section_part.hpp_part_count) as c')
//                ->where('hnt_middle_section_part.deleted_at', '=', Null)
//                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
//                ->orderBy('c', 'DESC')
//                ->orderBy('hnt_middle_section_part.hpp_middle_part_id', 'DESC')
//                ->groupBy('hnt_middle_section_part.hpp_middle_part_id')
//                ->get();
        }
        $computing = '';
        $key = 0;
        foreach ($middle_part as $m) {
            $key++;
            $comp = round($m->hrp_part_count / $m->hpp_part_count);
            $computing .= '["' . $key . '","' . $m->hmp_name . '",' . '"' . $comp . '",' . '"' . $m->hpp_middle_part_id . '"],';
        }
        $computing = substr($computing, 0, -1);
        $middle_parts = MiddleSectionPart::ALL()->count();
        return response('{ "recordsTotal":' . $middle_parts . ',"recordsFiltered":' . $middle_parts . ',"data": [' . $computing . ']}');

    }

    public function computing_middle_part_detail(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $middle_part_id = $request->columns[4];
        if ($search == '') {

            $middle_part = DB::Table('hnt_middle_section_part')
                ->join('hnt_repository_part', 'hnt_middle_section_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_part.id')
                ->join('hnt_parts', 'hnt_middle_section_part.hpp_part_id', 'hnt_parts.id')
                ->select('hnt_parts.id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_parts.hp_name')
                ->where('hnt_middle_section_part.hpp_middle_part_id', '=', $middle_part_id)
                ->latest('hnt_repository_part.hrp_part_count')
                ->orderBy('hnt_middle_section_part.hpp_middle_part_id')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $middle_part = DB::Table('hnt_middle_section_part')
                ->join('hnt_repository_part', 'hnt_middle_section_part.hpp_part_id', 'hnt_repository_part.hrp_part_id')
                ->join('hnt_middle_part', 'hnt_middle_section_part.hpp_middle_part_id', 'hnt_middle_part.id')
                ->join('hnt_parts', 'hnt_middle_section_part.hpp_part_id', 'hnt_parts.id')
                ->select('hnt_parts.id', 'hnt_middle_section_part.hpp_part_count', 'hnt_repository_part.hrp_part_count', 'hnt_parts.hp_name')
                ->where('hnt_middle_section_part.hpp_middle_part_id', '=', $middle_part_id)
                ->orwhere('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->get();
        }
        $computing = '';
        $key = 0;
        foreach ($middle_part as $m) {
            $comp = round($m->hrp_part_count / $m->hpp_part_count);
            $key++;
            $computing .= '["' . $key . '",' . '"' . $m->hp_name . '",' . '"' . $comp . '",' . '"' . $m->hrp_part_count . '",' . '"' . $m->id . '"],';
        }
        $computing = substr($computing, 0, -1);
        $middle_parts = MiddleSectionPart::ALL()->count();
        return response('{ "recordsTotal":' . $middle_parts . ',"recordsFiltered":' . $middle_parts . ',"data": [' . $computing . ']}');

    }
}
