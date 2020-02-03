<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repository_Requirement;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class Repository_RequirementController extends Controller
{
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $Repositories_Requirement = Repository_Requirement:: all();
        return view('Repository_Requirement.index',compact('Repositories_Requirement','type','priority','help_desk','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $product = Product::all();
        return view('Repository_Requirement.create',compact('product','type','priority','help_desk','user'));
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
//            'Product_Id' => 'required' ,
//            'Product_Count' => 'required' ,
////            'Comment' => 'required' ,
        ]);

        $Repositories_Requirement = new Repository_Requirement();
        $Repositories_Requirement->Product_Id= $request->Product_Id;
        $Repositories_Requirement->Product_Count= $request->Product_Count;
        $Repositories_Requirement->Inventory_deficit= $request->Inventory_deficit;
        $Repositories_Requirement->Comment= $request->Comment;
        $Repositories_Requirement->save();
        return json_encode(["response" => "Done"]);

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
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $Repositories_Requirement = Repository_Requirement::find($id);
        return view('Repository_Requirement.edit',compact('Repositories_Requirement','type','priority','help_desk','user'));
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
