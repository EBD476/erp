<?php

namespace App\Http\Controllers;

use App\Part;
use App\RepositoryCreate;
use App\RepositoryPart;
use Illuminate\Http\Request;

class RepositoryPartController extends Controller
{
    public function index()
    {
        $repository=RepositoryPart::ALL();
        return view('repository_part.index',compact('repository'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $part_name=Part::all();
        $repository_name=RepositoryCreate::all();
        return view('repository_part.create',compact('part_name','repository_name'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hrp_part_id' => 'required',
            'hrp_repository_id' => 'required',
            'hrp_part_count' => 'required',
        ]);
        $repository = new RepositoryPart();
        $repository->hrp_part_id = $request->hrp_part_id;
        $repository->hrp_repository_id = $request->hrp_repository_id;
        $repository->hrp_part_count = $request->hrp_part_count;
        $repository->save();
        return json_encode(["response"=>"OK"]);

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
        $repository=RepositoryPart::find($id);
        return view('repository_part.edit',compact('repository'));


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
            'hrp_part_id' => 'required',
            'hrp_repository_id' => 'required',
            'hrp_part_count' => 'required',
        ]);
        $repository =RepositoryPart::find($id);
        $repository->hrp_part_id = $request->hrp_part_id;
        $repository->hrp_repository_id = $request->hrp_repository_id;
        $repository->hrp_part_count = $request->hrp_part_count;
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
        $repository = RepositoryPart::find($id);
        $repository->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }

}
