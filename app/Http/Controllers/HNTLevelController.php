<?php

namespace App\Http\Controllers;

use App\HNTLevel;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class HNTLevelController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $level=HNTLevel::all();
        return view('hnt-level.index',compact('level','help_desk','priority','type','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hnt-level.create');
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
            'hp_process_name'=>'required',
            'hp_process_id'=>'required'
        ]);
        $level=New HNTLevel();
        $level->hp_process_name = $request->hp_process_name;
        $level->hp_process_id = $request->hp_process_id;
        $level->save();
        return json_encode(["response"=>"OK"]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $level=HNTLevel::find($id);
        return view('hnt-level.edit',compact('level','type','priority','help_desk','user'));
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
            'hp_process_name'=>'required',
            'hp_process_id'=>'required'
        ]);
        $level=HNTLevel :: find($id);
        $level->hp_process_name = $request->hp_process_name;
        $level->hp_process_id = $request->hp_process_id;
        $level->save();
        return json_encode(["response"=>"ok"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority  $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = HNTLevel::find($id);
        $level->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
