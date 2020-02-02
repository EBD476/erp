<?php

namespace App\Http\Controllers;

use App\RepositoryCreate;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class RepositoryCreateController extends Controller
{
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $repository =RepositoryCreate::all();
        return view('repository_create.index',compact('repository','type','priority','help_desk'));
    }



    public function checkbox(Request $request , $id)
    {
        $checkbox=Product::find($id);
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
        return view('repository_create.create',compact('type','priority','help_desk'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository = new RepositoryCreate();
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
        $repository->save();

        return redirect()->route('repositorycreate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

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
        $repository=RepositoryCreate::find($id);
        return view('repository_create.edit',compact('repository','type','priority','help_desk'));


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
            'hr_name' => 'required',
            'hr_description' => 'required',
        ]);
        $repository =RepositoryCreate::find($id);
        $repository->hr_name = $request->hr_name;
        $repository->hr_description = $request->hr_description;
        $repository->save();
        return view('repository_create.index',compact('repository'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repository = RepositoryCreate::find($id);
        $repository->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
