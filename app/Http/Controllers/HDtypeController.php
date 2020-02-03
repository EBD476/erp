<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HelpDesk;
use App\HDtype;
use App\User;
use Illuminate\Http\Request;

class HDtypeController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $types=HDtype::all();
        return view('hd_type.index',compact('type','help_desk','priority','type','types','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hd_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'th_name'=>'required'
        ]);
        $type=New HDtype();
        $type->th_name = $request->th_name;
        $type->save();
        return json_encode(["response"=>"Done"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function show(HDpriority $hDpriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function edit(HDpriority $hDpriority)
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $priority=HDtype::find($hDpriority);
        return view('priority.index',compact('priority','type','types','help_desk','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'th_name'=>'required'
        ]);
        $type=HDtype :: find($id);
        $type->th_name = $request->th_name;
        $type->save();
        return json_encode(["response"=>"Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy(HDpriority $hDpriority)
    {
        $type = HDtype::find($hDpriority);
        $type->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
