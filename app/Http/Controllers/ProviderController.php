<?php

namespace App\Http\Controllers;

use App\Provider;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class ProviderController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('provider.index', compact('type', 'priority', 'help_desk', 'user'));
    }

    public function checkbox(Request $request, $id)
    {
        $checkbox = Provider::find($id);
        $checkbox->hp_statuse = $request->checkbox;
        $checkbox->save();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hp_name' => 'required',
            'hp_phone' => 'required',
            'hp_address' => 'required',
//            'hp_account_number' => 'required',
        ]);
        $provider = new Provider();
        $provider->hp_name = $request->hp_name;
        $provider->hp_phone = $request->hp_phone;
        $provider->hp_address = $request->hp_address;
        $provider->hp_account_number = $request->hp_account_number;
        $provider->save();

        return json_encode(["response" => "OK", "provider" => $provider->hp_name]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
//            'hp_name' => 'required',
//            'hp_phone' => 'required',
//            'hp_address' => 'required',
        ]);
        $provider = Provider::find($id);
        $provider->hp_name = $request->hp_name;
        $provider->hp_phone = $request->hp_phone;
        $provider->hp_address = $request->hp_address;
//        $provider->hp_account_number = $request->hp_account_number;
        $provider->save();
        return json_encode(["response" => "Done"]);


    }

    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return json_encode(["response" => "Done"]);
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $providers = Provider::select('id', 'hp_name', 'hp_phone', 'hp_address')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $providers = Provider::select('id', 'hp_name', 'hp_phone', 'hp_address')
                ->where('hp_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($providers as $provider) {
            $data .= '["' . $provider->id . '",' . '"' . $provider->hp_name . '",' . '"' . $provider->hp_phone . '",' . '"' . $provider->hp_address . '",' . '"' . $provider->hp_account_number . '"],';
        }
        $data = substr($data, 0, -1);
        $providers_count = Provider::all()->count();
        return response('{ "recordsTotal":' . $providers_count . ',"recordsFiltered":' . $providers_count . ',"data": [' . $data . ']}');
    }

//fill select to
    public function fill_data_provider(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $provider = Provider::select('hp_name as text', 'id')->where('hp_name', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $provider]);
    }
}
