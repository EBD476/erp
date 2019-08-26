<?php

namespace App\Http\Controllers;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return view('client.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->validate($request,[
            'hc_user_id' => 'required' ,
            'hc_account_id' => 'required' ,
            'hc_currency_id' => 'required' ,
            'hc_name' => 'required' ,
            'hc_address' => 'required' ,
            'hc_city' => 'required' ,
            'hc_state' => 'required' ,
            'hc_postal_code' => 'required' ,
            'hc_country_id' => 'required' ,
            'hc_private_notes' => 'required' ,
            'hc_balance' => 'required' ,
            'hc_paid_to_date' => 'required' ,
            'hc_last_login' => 'required' ,
            'hc_website' => 'required' ,
        ]);

        $client = new Client();
        $client->hc_user_id= $request->hc_user_id;
        $client->hc_currency_id= $request->hc_currency_id;
        $client->hc_name= $request->hc_name;
        $client->hc_address= $request->hc_address;
        $client->hc_city= $request->hc_city;
        $client->hc_state= $request->hc_state;
        $client->hc_postal_code= $request->hc_postal_code;
        $client->hc_country_id= $request->hc_country_id;
        $client->hc_private_notes= $request->hc_private_notes;
        $client->hc_balance= $request->hc_balance;
        $client->hc_paid_to_date= $request->hc_paid_to_date;
        $client->hc_last_login= $request->hc_last_login;
        $client->hc_website= $request->hc_website;
        $client->save();
        return redirect()->route('client.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         *
         */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'hc_user_id' => 'required' ,
            'hc_account_id' => 'required' ,
            'hc_currency_id' => 'required' ,
            'hc_name' => 'required' ,
            'hc_address' => 'required' ,
            'hc_city' => 'required' ,
            'hc_state' => 'required' ,
            'hc_postal_code' => 'required' ,
            'hc_country_id' => 'required' ,
            'hc_private_notes' => 'required' ,
            'hc_balance' => 'required' ,
            'hc_paid_to_date' => 'required' ,
            'hc_last_login' => 'required' ,
            'hc_website' => 'required' ,
        ]);
        $client=Client::find($id);
        $client->hc_user_id= $request->hc_user_id;
        $client->hc_currency_id= $request->hc_currency_id;
        $client->hc_name= $request->hc_name;
        $client->hc_address= $request->hc_address;
        $client->hc_city= $request->hc_city;
        $client->hc_state= $request->hc_state;
        $client->hc_postal_code= $request->hc_postal_code;
        $client->hc_country_id= $request->hc_country_id;
        $client->hc_private_notes= $request->hc_private_notes;
        $client->hc_balance= $request->hc_balance;
        $client->hc_paid_to_date= $request->hc_paid_to_date;
        $client->hc_last_login= $request->hc_last_login;
        $client->hc_website= $request->hc_website;
        $client->save();
        return redirect()->route('client.index')->with('successMSG','عملیات ویرایش اطلاعات با موفقیت انجام شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with('successMSG','عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
