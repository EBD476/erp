<?php

namespace App\Http\Controllers;

use App\Project_State;
use Illuminate\Http\Request;

class Project_StateController extends Controller
{
    public function index()
    {
        if($this->authorize('view',Project_State::class))
        {
            $Projects_State = Project_State:: all();
            return view('Project.index',compact('Projects_State'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->authorize('create',Project_State::class))
        {
            return view('Project.create');
        }
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
            'Name' => 'required' ,
        ]);

        $Projects_State = new Project_State();
        $Projects_State->Name= $request->Name;
        $Projects_State->save();
        return redirect()->route('project.index');

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
        $Projects_State = Project_State::find($id);
        return view('Project.edit',compact('Projects_State'));
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
        if($this->authorize('update',Project_State::class))
        {
            $this->validate($request, [
                'Name' => 'required',
            ]);
            $Projects_State = Project_State::find($id);
            $Projects_State->Name = $request->Name;
            $Projects_State->save();
            return redirect()->route('project.index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->authorize('delete',Project_State::class))
        {
            $Projects_State = Project_State::find($id);
            $Projects_State->delete();
            return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
        }
    }
}
