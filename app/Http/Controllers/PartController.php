<?php

namespace App\Http\Controllers;

use App\Part;
use App\Product;
use App\ProductPart;
use App\Provider;
use App\User;
use Illuminate\Http\Request;
use carbon\carbon;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    public function index()
    {
        $status =DB::table('hnt_product_status_create_serial_number')->select('hpscsn_activation')->get()->last();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('part.index', compact('type', 'help_desk', 'priority', 'user','status'));
    }


    public function checkbox(Request $request, $id)
    {
        $checkbox = Part::find($id);
        $checkbox->hp_statuse = $request->checkbox;
        $checkbox->save();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_part_model' => 'required',

        ]);
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $code = "hnt_prt_" . $current_date;
        $part = new Part();
        $part->hp_name = $request->hp_name;
        $part->hp_size = $request->hp_size;
        $part->hp_part_image = $request->part_image;
        if($request->hp_part_number != ""){
            $part->hp_part_number = $request->hp_part_number;
        }else{
            $part->hp_part_number = $code;
        }
        if($request->hp_serial_number != ""){
            $part->hp_serial_number = $request->hp_serial_number;
        }else{
            $part->hp_serial_number = $code;
        }
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_main_unit = $request->hp_main_unit;
        $part->hp_category_id = $request->hp_category_id;
        $part->hp_description = $request->hp_description;
        $part->save();

        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_code' => 'required',
            'hp_part_model' => 'required',
        ]);
        $part = Part::find($id);
        $part->hp_name = $request->hp_name;
        $part->hp_size = $request->hp_size;
        $part->hp_serial_number = $request->hp_code;
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_part_image = $request->part_image1;
        $part->hp_category_id = $request->hp_category_id;
        $part->hp_description = $request->hp_description;
        $part->hp_main_unit = $request->hp_main_unit;
        $part->save();
        return json_encode(["response" => "OK"]);


    }

    public function destroy($id)
    {
        $part = Part::find($id);
        $part->delete();
        $filename = "img/parts/" . $part->hp_part_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }
    }

    public function destroy_image($id)
    {
        $part = Part::find($id);
        $filename = "img/parts/" . $part->hp_part_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $part = DB::table('hnt_parts')
                ->select( 'hnt_parts.id', 'hnt_parts.hp_name as name', 'hnt_parts.hp_serial_number','hnt_parts.hp_size', 'hnt_parts.hp_description', 'hnt_parts.hp_part_model', 'hnt_parts.hp_part_image', 'hnt_parts.hp_main_unit')
                ->where('hnt_parts.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $part = DB::table('hnt_parts')
                ->select( 'hnt_parts.id', 'hnt_parts.hp_name as name', 'hnt_parts.hp_serial_number','hnt_parts.hp_size', 'hnt_parts.hp_description', 'hnt_parts.hp_part_model', 'hnt_parts.hp_part_image', 'hnt_parts.hp_main_unit')
                ->where('hnt_parts.deleted_at', '=', Null)
                ->where('hnt_parts.hp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_parts.hp_serial_number', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($part as $parts) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $parts->name . '",' . '"' . $parts->hp_serial_number . '",' . '"' . $parts->hp_part_model . '",' . '"' . $parts->hp_size . '",' . '"' . $parts->hp_description . '",' . '"' . $parts->hp_part_image . '",' . '"' . $parts->id . '",' . '"' . $parts->hp_main_unit . '"],';
        }
        $data = substr($data, 0, -1);
        $parts_count = Part::all()->count();
        return response('{ "recordsTotal":' . $parts_count . ',"recordsFiltered":' . $parts_count . ',"data": [' . $data . ']}');
    }

    public function upload(Request $request)
    {
        $image = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($image)) {
//            $current_date = Carbon::now()->todatestring();
//          $image_name = $current_date . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('img/parts')) {
                mkdir('img/parts', 0777, true);
            }
            $image->move('img/parts', $filename);
        } else {
            $image_name = 'default.png';
        }

        return response()->json([
            'link' => '/img/parts/' . $filename
        ]);
    }

//    fill select to
    public function fill_data_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $part = Part::select('hp_name as text', 'id', 'hp_serial_number', 'hp_part_model', 'hp_part_image')->where('hp_name', 'LIKE', "%$search%")->orwhere('hp_part_model', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $part]);
    }
}
