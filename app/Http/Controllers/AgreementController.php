<?php

namespace App\Http\Controllers;

use App\Agreement;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $agreement = Agreement::all();
        return view('agreement.index',compact('agreement','help_desk','priority','type'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Part::find($id);
        $checkbox->hp_statuse=$request->checkbox;
        $checkbox->save();
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
        $agreement = Agreement::find($id);
        return view('agreement.edit',compact('agreement','help_desk','priority','type'));


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
            'hg_agreement_number' => 'required',
            'hg_invoice' => 'required',
            'hg_client' => 'required',
            'hg_description' => 'required',
        ]);
        $agreement = Agreement($id);
        $agreement->hg_agreement_number = $request->hg_agreement_number;
        $agreement->hg_invoice = $request->hg_invoice;
        $agreement->hg_client = $request->hg_client;
        $agreement->hg_description = $request->hg_description;
        $agreement->save();
        return view('agreement.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
