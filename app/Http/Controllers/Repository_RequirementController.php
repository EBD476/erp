<?php

namespace App\Http\Controllers;

use App\Repository_Requirement;
use Illuminate\Http\Request;

class Repository_RequirementController extends Controller
{
    public function index()
    {
        $Repositories_Requirement = Repository_Requirement:: all();
        return view('Repository_Requirement.index',compact('Repositories_Requirement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Repository_Requirement.create');
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
            'Product_Id' => 'required' ,
            'Product_Count' => 'required' ,
            'Comment' => 'required' ,
        ]);

        $Repositories_Requirement = new Repository_Requirement();
        $Repositories_Requirement->Product_Id= $request->Product_Id;
        $Repositories_Requirement->Product_Count= $request->Product_Count;
        $Repositories_Requirement->Comment= $request->Comment;
        $Repositories_Requirement->save();
        return json_encode(["response"=>"OK"]);

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
        $Repositories_Requirement = Repository_Requirement::find($id);
        return view('Repository_Requirement.edit',compact('Repositories_Requirement'));
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
            'Product_Id' => 'required' ,
            'Product_Count' => 'required' ,
            'Comment' => 'required' ,
        ]);
        $Repositories_Requirement=Repository_Requirement::find($id);
        $Repositories_Requirement->Product_Id= $request->Product_Id;
        $Repositories_Requirement->Product_Count= $request->Product_Count;
        $Repositories_Requirement->Comment= $request->Comment;
        $Repositories_Requirement->save();
        return redirect()->route('repository_requirement.index')->with('successMSG','عملیات ویرایش اطلاعات با موفقیت انجام شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Repositories_Requirement = Repository_Requirement::find($id);
        $Repositories_Requirement->delete();
        return redirect()->back()->with('successMSG','Repository_Requirement Successfully Delete');
    }
}
