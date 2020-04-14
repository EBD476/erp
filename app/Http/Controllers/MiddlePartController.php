<?php

namespace App\Http\Controllers;

use App\MiddlePart;
use App\Part;
use App\User;
use Illuminate\Http\Request;
use carbon\carbon;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
class MiddlePartController extends Controller
{
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $middle_part = MiddlePart::all();
        return view('middle_part.index',compact('middle_part','product','product_part','type','help_desk','priority','user'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Part::find($id);
        $checkbox->hp_statuse=$request->checkbox;
        $checkbox->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('middle_part.create',compact('type','help_desk','priority','user','provider'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hmp_name' => 'required',
            'hmp_middle_part_model' => 'required',
//            'hmp_produce_date' => 'required',
        ]);
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $code = "hnt_middle_prt_" . $current_date ;
        $part = new MiddlePart();
        $part->hmp_name = $request->hmp_name;
        $part->hmp_image = $request->part_image;
        $part->hmp_middle_part_model = $request->hmp_middle_part_model;
        $part->hmp_description = $request->hmp_description;
        $part->hmp_serial_number=$code;
        $part->save();

        return json_encode(["response"=>"OK"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $part=MiddlePart::find($id);
        return view('middle_part.edit',compact('part','user','type','priority','help_desk'));


    }


    public function show(){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'hmp_name' => 'required',
            'hmp_middle_part_model' => 'required',
        ]);
        $part =MiddlePart::find($id);
        $part->hmp_name = $request->hmp_name;
        $part->hmp_image = $request->part_image;
        $part->hmp_middle_part_model = $request->hmp_middle_part_model;
        $part->hmp_description = $request->hmp_description;
        $part->save();
        return json_encode(["response"=>"OK"]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = MiddlePart::find($id);
        $part->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
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
}
