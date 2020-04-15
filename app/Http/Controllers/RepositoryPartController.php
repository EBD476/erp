<?php

namespace App\Http\Controllers;

use App\Part;
use App\Provider;
use App\RepositoryCreate;
use App\RepositoryPart;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class RepositoryPartController extends Controller
{
    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository=RepositoryPart::select('id','hrp_part_id','hrp_repository_id','hrp_part_count')->get();
        $repository_name=RepositoryCreate::select('id','hr_name')->get();
        $part = Part::select('id','hp_name')->get();
        return view('repository_part.index',compact('repository_name','part','repository','help_desk','priority','type','user'));
    }

    public function create()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_name=RepositoryCreate::all();
        return view('repository_part.create',compact('repository_name','help_desk','priority','type','user'));
    }

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
        $repository->save();
        return json_encode(["response"=>"OK"]);

    }

    public function edit($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_part=RepositoryPart::find($id);
        $part_name=Part::select('id','hp_name')->where('id',$repository_part->hrp_part_id)->get()->last();
        $repository_name=RepositoryCreate::select('id','hr_name')->where('id',$repository_part->hrp_repository_id)->get()->last();
        $repository_all_name=RepositoryCreate::select('id','hr_name')->get();
        $provider = Provider::select('id', 'hp_name')->get();
        return view('repository_part.edit',compact('provider','repository_name','repository_all_name','part_name','repository_part','help_desk','priority','type','user'));


    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'hrp_part_id' => 'required',
            'hrp_repository_id' => 'required',
            'hrp_part_count' => 'required',
        ]);
        $repository =RepositoryPart::find($id);
        $repository->hrp_part_id = $request->hrp_part_id;
        $repository->hrp_repository_id = $request->hrp_repository_id;
        $repository->hrp_part_count = $request->hrp_part_count;
        $repository->save();
        return json_encode(["response"=>"OK"]);

    }

    public function destroy($id)
    {
        $repository = RepositoryPart::find($id);
        $repository->delete();
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

    public function fill_data_repository_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $part = Part::select('hp_name as text', 'id', 'hp_serial_number', 'hp_part_model', 'hp_part_image')->where('hp_name', 'LIKE', "%$search%")->orwhere('hp_part_model', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $part]);
    }


}
