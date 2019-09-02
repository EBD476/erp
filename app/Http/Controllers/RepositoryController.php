<?php

namespace App\Http\Controllers;
use App\Repository;
use Illuminate\Http\Request;


class RepositoryController extends Controller
{
    public function index()
    {
//        IF($this->authorize('view',Repository::class))
//        {
        $Repositories = Repository:: all();
        return view('Repository.index',compact('Repositories'));
//        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if ($this->authorize('create',Repository::class)) {
            return view('Repository.create');
//        }
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
            'Product_Stock' => 'required' ,
            'Comment' => 'required' ,
        ]);

        $Repositories = new Repository();
        $Repositories->Product_Id= $request->Product_Id;
        $Repositories->Product_Stock= $request->Product_Stock;
        $Repositories->Comment= $request->Comment;
        $Repositories->save();
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
        $Repositories = Repository::find($id);
        return view('Repository.edit',compact('Repositories'));
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
//        if($this->authorize('update',Repository::class))
//        {
            $this->validate($request, [
                'Product_Id' => 'required',
                'Product_Stock' => 'required',
                'Comment' => 'required',
            ]);
            $Repositories = Repository::find($id);
            $Repositories->Product_Id = $request->Product_Id;
            $Repositories->Product_Stock = $request->Product_Stock;
            $Repositories->Comment = $request->Comment;
            $Repositories->save();
            return redirect()->route('repository.index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد.');
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        IF($this->authorize('delete',Repository::class))
//        {
            $Repositories = Repository::find($id);
            $Repositories->delete();
            return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
//        }
    }
}
