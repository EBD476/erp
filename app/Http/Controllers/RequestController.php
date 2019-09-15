<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Request;
use App\User;

class RequestController extends Controller
{
    public function index()
    {
        $Request = Request::paginate(10);
        return view('Request.index', compact('Request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::ALL();
        return view('Request.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
//            'goods' => 'required' ,
//            'goods_count' => 'required' ,
//            'description' => 'required' ,
//            'user_id' => 'required' ,
////            'request_date' => 'required' ,
//            'accept_level' => 'required' ,
//        ]);

        $Request = new Request();
        $Request->goods = $request->goods;
        $Request->goods_count = $request->goods_count;
        $Request->description = $request->description;
        $Request->user_id = $request->user_id;
//        $Request->request_date= $request->request_date;
        $Request->accept_level = $request->accept_level;
        $Request->save();
        return redirect()->route('request.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Request = Request::find($id);
        return view('Request.edit', compact('Request'));
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
            'goods' => 'required',
            'goods_count' => 'required',
            'description' => 'required',
            'user_id' => 'required',
//            'request_date' => 'required' ,
            'accept_level' => 'required',
        ]);
        $Request = Request::find($id);
        $Request->goods = $request->goods;
        $Request->goods_count = $request->goods_count;
        $Request->description = $request->description;
        $Request->user_id = $request->user_id;
//        $Request->request_date= $request->request_date;
        $Request->accept_level = $request->accept_level;
        $Request->save();
        return redirect()->route('request.index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Request = Request::find($id);
        $Request->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }

}
