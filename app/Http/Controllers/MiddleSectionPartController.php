<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\MiddleSectionPart;
use App\Part;
use App\ProductMiddlePart;
use App\ProductPart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class MiddleSectionPartController extends Controller
{
    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $product_part = MiddleSectionPart::select('id','hpp_part_id','hpp_middle_part_id','hpp_middle_part_id','hpp_part_id')->get();
        foreach ($product_part as $counter) {
            $parts = Part::select('hp_name','id')->where('id', $counter->hpp_part_id)->get();
        }
        foreach ($product_part as $counter) {
            $middle_part = MiddlePart::select('hmp_name','id')->where('id', $counter->hpp_middle_part_id)->get();
        }
        return view('middle_section_part.index', compact('middle_part','parts', 'product_part', 'product', 'part', 'type', 'priority', 'help_desk', 'user'));
    }


    public function checkbox(Request $request, $id)
    {
        $checkbox = ProductPart::find($id);
        $checkbox->hp_statuse = $request->checkbox;
        $checkbox->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('middle_section_part.create', compact('part_id', 'product_id', 'type', 'priority', 'help_desk', 'user'));
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

    public function edit($id)
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $product_part = MiddleSectionPart::find($id);
//        $part_id = Part::select('id', 'hp_name')->where('id', $product_part->hpp_part_id)->get();
//        $product_id = Part::select('id', 'hmp_name')->where('id', $product_part->hpp_middle_part_id)->get();
        return view('middle_section_part.edit', compact('product_id', 'product_part', 'part_id', 'type', 'priority', 'help_desk', 'user'));


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
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }

    public function fill_data_middle_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $middle_part = MiddlePart::select('hmp_name as text', 'id', 'hmp_middle_part_model', 'hmp_serial_number', 'hmp_image')->where('hmp_name', 'LIKE', "%$search%")->orwhere('hmp_serial_number', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $middle_part]);
    }

    public function fill_data_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $part = Part::select('hp_name as text', 'id', 'hp_serial_number', 'hp_part_model', 'hp_part_image')->where('hp_name', 'LIKE', "%$search%")->orwhere('hp_part_model', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $part]);
    }
}
