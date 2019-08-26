<?php

namespace App\Http\Controllers;

use App\DataUser;
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
        $verifier = Verifier::ALL();
        return view('verifier.index', compact('verifier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $verifier_id=DataUser::all();
        return view('verifier.create',compact('verifier_id'));
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
        return view('verifier.index');
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
        $verifier = Verifier::find($id);
        return view('verifier.edit', compact('verifier'));
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
            'process_id	' => 'required',
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
}