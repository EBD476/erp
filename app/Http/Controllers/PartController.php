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
class PartController extends Controller
{
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $product=Product::all();
        $product_part=ProductPart::all();
        $part = Part::all();
        return view('part.index',compact('part','product','product_part','type','help_desk','priority','user'));
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
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $provider= Provider::select('id','hp_name')->get();
        return view('part.create',compact('type','help_desk','priority','user','provider'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_part_model' => 'required',
            'hp_category_id' => 'required',
            'hp_produce_date' => 'required',
        ]);
        $current_date = Carbon::now();
        $current_date = $current_date->year . $current_date->month . $current_date->day;
        $code = "hnt_prt_" . $current_date ;
        $part = new Part();
        $part->hp_name = $request->hp_name;
        $part->hp_part_image = $request->part_image;
        $part->hp_serial_number	 = $code;
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_provider = $request->hp_provider;
        $part->hp_category_id = $request->hp_category_id;
//        $part->hp_produce_date = new Date();
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
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $part=Part::find($id);
        return view('part.edit',compact('part','user','type','priority','help_desk'));


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
            'hp_name' => 'required',
            'hp_code' => 'required',
            'hp_part_model' => 'required',
            'hp_provider' => 'required',
//            'hp_category_id' => 'required',
            'hp_produce_date' => 'required',
        ]);
        $part =Part::find($id);
        $part->hp_name = $request->hp_name;
        $part->hp_serial_number	 = $request->hp_code;
        $part->hp_part_model = $request->hp_part_model;
        $part->hp_part_image = $request->part_image;
        $part->hp_provider = $request->hp_provider;
        $part->hp_category_id = $request->hp_category_id;
        $part->hp_produce_date = $request->hp_produce_date;
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
        $part = Part::find($id);
        $part->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
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

}
