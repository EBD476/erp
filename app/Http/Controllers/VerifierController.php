<?php

namespace App\Http\Controllers;

use App\DataUser;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Process;
use App\ProcessLevel;
use App\User;
use App\Verifier;
use Illuminate\Http\Request;

class VerifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $verifier = Verifier::ALL();
        return view('verifier.index', compact('verifier','help_desk','priority','type','user'));
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
        $process=ProcessLevel::all();
        $verifier_id=DataUser::all();
        return view('verifier.create',compact('verifier_id','process','help_desk','priority','type','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'process_id' => 'required',
                'hp_priority' => 'required',
                'hp_verifier_id' => 'required',

            ]);
        $verifier = new Verifier();
        $verifier->process_id = $request->process_id;
        $verifier->hp_priority = $request->hp_priority;
        $verifier->hp_verifier_id = $request->hp_verifier_id;
        $verifier->save();
        $verifier = Verifier::ALL();
        return json_encode(["response"=>"OK"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $verifier = Verifier::find($id);
        return view('verifier.edit', compact('verifier','help_desk','priority','type','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'process_id' => 'required',
            'hp_priority' => 'required',
            'hp_verifier_id' => 'required',

        ]);
        $verifier = Verifier::find($id);
        $verifier->process_id = $request->process_id;
        $verifier->hp_priority = $request->hp_priority;
        $verifier->hp_verifier_id = $request->hp_verifier_id;
        $verifier->save();
        return redirect()->route('verifier.index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $verifier = Verifier::find($id);
        $verifier->delete();
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
}