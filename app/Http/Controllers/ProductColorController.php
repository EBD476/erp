<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductColor;
use App\User;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{

    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('products.product_color.index',compact('color','user','type','priority','help_desk'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hn_color_name' => 'required',
        ]);
        $color = New ProductColor();
        $color->hn_color_name = $request->hn_color_name;
        $color->save();
        return json_encode(["response" => "Done","name"=>$color->hn_color_name,"id"=>$color->id]);
    }


    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'hn_color_name' => 'required',
        ]);
        $color = ProductColor :: find($id);
        $color->hn_color_name = $request->hn_color_name;
        $color->save();
        return json_encode(["response" => "Done"]);

    }

    public function destroy($id)
    {
        $color = ProductColor :: find($id);
        $color->delete();
        return redirect()->back();
    }

    public function fill(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $color = ProductColor::select('id','hn_color_name')->skip($start)->take($length)->get();
        } else {
            $color = ProductColor::select('id','hn_color_name')->where('hn_color_name', 'LIKE', "%$search%")->get();
        }

        $data = '';
        $key = 0;
        foreach ($color as $colors) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $colors->hn_color_name . '",' . '"' . $colors->id . '"],';
        }
        $data = substr($data, 0, -1);
        $color_count = ProductColor::all()->count();
        return response('{ "recordsTotal":' . $color_count . ',"recordsFiltered":' . $color_count . ',"data": [' . $data . ']}');
    }
}
