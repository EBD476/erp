<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\User;
use Illuminate\Http\Request;
use carbon\carbon;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class MiddlePartController extends Controller
{

    public function index()
    {
        $status =DB::table('hnt_product_status_create_serial_number')->select('hpscsn_activation')->get()->last();
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('middle_part.index', compact('type', 'help_desk', 'priority', 'user','status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hmp_name' => 'required',
            'hmp_middle_part_model' => 'required',
        ]);
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $code = "hnt_middle_prt_" . $current_date;
        $part = new MiddlePart();
        $part->hmp_name = $request->hmp_name;
        $part->hmp_image = $request->part_image;
        $part->hmp_middle_part_model = $request->hmp_middle_part_model;
        $part->hmp_middle_part_color = $request->hmp_middle_part_color;
        $part->hmp_middle_part_property = $request->hmp_middle_part_property;
        $part->hmp_voltage = $request->hmp_voltage;
        $part->hmp_description = $request->hmp_description;
        if($request->hmp_part_number != ""){
            $part->hmp_part_number = $request->hmp_part_number;
        }else{
            $part->hmp_part_number = $code;
        }
        if($request->hmp_serial_number != ""){
            $part->hmp_serial_number = $request->hmp_serial_number;
        }else{
            $part->hmp_serial_number = $code;
        }
        $part->save();

        return json_encode(["response" => "OK"]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hmp_name' => 'required',
            'hmp_middle_part_model' => 'required',
        ]);
        $part = MiddlePart::find($id);
        $part->hmp_name = $request->hmp_name;
        $part->hmp_image = $request->part_image1;
        $part->hmp_middle_part_model = $request->hmp_middle_part_model;
        $part->hmp_middle_part_color = $request->hmp_middle_part_color;
        $part->hmp_middle_part_property = $request->hmp_middle_part_property;
        $part->hmp_description = $request->hmp_description;
        $part->hmp_serial_number = $request->hmp_serial_number;
        $part->hmp_voltage = $request->hmp_voltage;
        $part->hmp_image = $request->part_image1;
        $part->hmp_middle_part_model = $request->hmp_middle_part_model;
        $part->hmp_middle_part_color = $request->hmp_middle_part_color;
        $part->hmp_middle_part_property = $request->hmp_middle_part_property;
        $part->hmp_description = $request->hmp_description;
        $part->hmp_serial_number = $request->hmp_serial_number;
        $part->save();
        return json_encode(["response" => "OK"]);


    }

    public function destroy($id)
    {
        $part = MiddlePart::find($id);
        $part->delete();
        $filename = "img/middle_parts/" . $part->hmp_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }
    }

    public function destroy_image($id)
    {
        $part = MiddlePart::find($id);
        $filename = "img/middle_parts/" . $part->hmp_image;
        if (file_exists($filename)) {
            unlink($filename);
            return json_encode(["response" => "OK"]);
        }
    }

    public function upload(Request $request)
    {
        $image = $request->file('file');
        $filename = $_FILES['file']['name'];

        if (isset($image)) {
//            $current_date = Carbon::now()->todatestring();
//          $image_name = $current_date . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('img/middle_parts')) {
                mkdir('img/middle_parts', 0777, true);
            }
            $image->move('img/middle_parts', $filename);
        } else {
            $image_name = 'default.png';
        }

        return response()->json([
            'link' => '/img/middle_parts/' . $filename
        ]);
    }

//    fill table
    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $part = $part = DB::table('hnt_middle_part')
                ->join('hnt_product_color', 'hnt_middle_part.hmp_middle_part_color', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_middle_part.hmp_middle_part_property', '=', 'hnt_product_property.id')
                ->select('hnt_middle_part.id', 'hnt_middle_part.hmp_name', 'hnt_middle_part.hmp_serial_number', 'hnt_middle_part.hmp_middle_part_model', 'hnt_middle_part.hmp_middle_part_property', 'hnt_middle_part.hmp_middle_part_color', 'hnt_middle_part.hmp_description', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_middle_part.hmp_image', 'hnt_middle_part.hmp_voltage')
                ->where('hnt_middle_part.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $part = DB::table('hnt_middle_part')
                ->join('hnt_product_color', 'hnt_middle_part.hmp_middle_part_color', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_middle_part.hmp_middle_part_property', '=', 'hnt_product_property.id')
                ->select('hnt_middle_part.id', 'hnt_middle_part.hmp_name', 'hnt_middle_part.hmp_serial_number', 'hnt_middle_part.hmp_middle_part_model', 'hnt_middle_part.hmp_middle_part_property', 'hnt_middle_part.hmp_middle_part_color', 'hnt_middle_part.hmp_description', 'hnt_product_property.hpp_property_name', 'hnt_product_color.hn_color_name', 'hnt_middle_part.hmp_image', 'hnt_middle_part.hmp_voltage')
                ->where('hnt_middle_part.deleted_at', '=', Null)
                ->where('hnt_middle_part.hmp_name', 'LIKE', "%$search%")
                ->orwhere('hnt_middle_part.hmp_serial_number', 'LIKE', "%$search%")
                ->orwhere('hnt_product_color.hn_color_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($part as $parts) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $parts->hmp_name . '",' . '"' . $parts->hmp_serial_number . '",' . '"' . $parts->hmp_middle_part_model . '",' . '"' . $parts->hpp_property_name . '",' . '"' . $parts->hn_color_name . '",' . '"' . $parts->hmp_voltage . '",' . '"' . $parts->hmp_middle_part_color . '",' . '"' . $parts->hmp_middle_part_property . '",' . '"' . $parts->hmp_description . '",' . '"' . $parts->hmp_image . '",' . '"' . $parts->id . '"],';
        }
        $data = substr($data, 0, -1);
        $part_count = MiddlePart::all()->count();
        return response('{ "recordsTotal":' . $part_count . ',"recordsFiltered":' . $part_count . ',"data": [' . $data . ']}');
    }


//fill select to
    public function fill_data_middle_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $middle_part = MiddlePart::select('hmp_name as text', 'id', 'hmp_middle_part_model', 'hmp_serial_number', 'hmp_image')
                ->where('hmp_name', 'LIKE', "%$search%")
                ->orwhere('hmp_serial_number', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $middle_part]);
    }

}
