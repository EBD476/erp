<?php

namespace App\Http\Controllers;

use App\HDpriority;
use Illuminate\Http\Request;

class HDpriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $priority=HDpriority::all();
       return view('priority.index',compact('priority'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('priority.create');
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
            'hdp_name'=>'required'
        ]);
        $priority=New HDpriority();
        $priority->hdp_name = $request->hdp_name;
        $priority->save();
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
        $priority=HDpriority::find($hDpriority);
        return view('priority.index',compact('priority'));
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
            'hdp_name'=>'required'
        ]);
        $priority=HDpriority :: find($id);
        $priority->hdp_name = $request->hdp_name;
        $priority->save();
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
        $priority = HDpriority::find($hDpriority);
        $priority->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
