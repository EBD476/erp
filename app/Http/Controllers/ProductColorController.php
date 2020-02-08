<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\ProductColor;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductColorController extends Controller
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
        $color = ProductColor::all();
        return view('products.product_color.index',compact('color','user','type','priority','help_desk'));
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
        return view('products.product_color.create',compact('user','type','priority','help_desk'));

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
            'hn_color_name' => 'required',
        ]);
        $color = New ProductColor();
        $color->hn_color_name = $request->hn_color_name;
        $color->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductColor $productColor
     * @return \Illuminate\Http\Response
     */
    public function show(ProductColor $productColor)
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
        $color = ProductColor::find($id);
        return view('products.product_color.edit',compact('color','user','type','priority','help_desk'));
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
            'hn_color_name' => 'required',
        ]);
        $color = ProductColor :: find($id);
        $color->hn_color_name = $request->hn_color_name;
        $color->save();
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
        $color = ProductColor :: find($id);
        $color->delete();
        return redirect()->back();
    }
}
