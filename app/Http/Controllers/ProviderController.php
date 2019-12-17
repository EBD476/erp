<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $provider = Provider::all();
        return view('provider.index',compact('provider'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Provider::find($id);
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('provider.create');
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
        $provider=Provider::find($id);
        return view('provider.edit',compact('provider'));


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
            'hp_phone' => 'required',
            'hp_address' => 'required',
//            'hp_account_number' => 'required',
        ]);
        $provider =Provider::find($id);
        $provider->hp_name = $request->hp_name;
        $provider->hp_phone = $request->hp_phone;
        $provider->hp_address = $request->hp_address;
        $provider->hp_account_number = $request->hp_account_number;
        $provider->save();
        return view('part.index',compact('provider'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
