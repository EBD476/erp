<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductPropertyItems;
use App\User;
use Illuminate\Http\Request;

class ProductPropertyItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $items = ProductPropertyItems::all();
        return view('products.product_items.index',compact('items','user','type','priority','help_desk'));
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
        return view('products.product_items.create',compact('user','type','priority','help_desk'));

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
            'hppi_items_name' => 'required',
        ]);
        $items = New ProductPropertyItems();
        $items->hppi_items_name = $request->hppi_items_name;
        $items->save();
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
        $user=User::all();
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $items = ProductPropertyItems::find($id);
        return view('products.product_items.edit',compact('items','user','type','priority','help_desk'));
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
            'hppi_items_name' => 'required',
        ]);
        $items = ProductPropertyItems :: find($id);
        $items->hppi_items_name = $request->hppi_items_name;
        $items->save();
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
        $items = ProductPropertyItems :: find($id);
        $items->delete();
        return redirect()->back();

    }
}