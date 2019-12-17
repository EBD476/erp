<?php

namespace App\Http\Controllers;

use App\SupportStatus;
use Illuminate\Http\Request;

class SupportStatusController extends Controller
{
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $status=SupportStatus::all();
        return view('support_status.index',compact('status','help_desk','priority','type'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('support_status.create',compact('help_desk','priority','type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hss_name' => 'required',
        ]);
        $status = new SupportStatus();
        $status->hss_name = $request->hss_name;
        $status->save();

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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $status=SupportStatus::find($id);
        return view('support_status.edit',compact('status','help_desk','priority','type'));


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
            'hss_name' => 'required',
        ]);
        $status =SupportStatus::find($id);
        $status->hss_name = $request->hss_name;
        $status->save();
        return view('support_status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status =SupportStatus::find($id);
        $status->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
