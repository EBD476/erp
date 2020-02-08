<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductProperty;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ProductPropertyItems::all();
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $properties = ProductProperty::all();
        return view('products.product_property.index',compact('properties','user','type','priority','help_desk','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = ProductPropertyItems::all();
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('products.product_property.create',compact('user','type','priority','help_desk','items'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'hpp_property_name' => 'required',
        ]);
        $properties = New ProductProperty();
        $properties->hpp_property_name = $request->hpp_property_name;
        $properties->hpp_property_items = $request->hpp_property_items;
        $properties->save();
        return json_encode(["response" => "Done"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = ProductPropertyItems::all();
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $properties = ProductProperty::find($id);
        return view('products.product_property.edit',compact('properties','user','type','priority','help_desk','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'hpp_property_name' => 'required',
        ]);
        $properties =ProductProperty::find($id);
        $properties->hpp_property_name = $request->hpp_property_name;
        $properties->hpp_property_items = $request->hpp_property_items;
        $properties->save();
        return json_encode(["response" => "Done"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $properties = ProductProperty :: find($id);
        $properties->delete();
        return redirect()->back();

    }
}
