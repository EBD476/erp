<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductRequirement;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class ProductRequirementController extends Controller
{
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('product_requirement.index', compact('type', 'priority', 'help_desk', 'user'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'Product_Id' => 'required',
            'Product_Count' => 'required',
            'Comment' => 'required',
        ]);

        $product_requirement = new ProductRequirement();
        $product_requirement->Product_Id = $request->Product_Id;
        $product_requirement->Product_Count = $request->Product_Count;
        $product_requirement->Inventory_deficit = $request->Inventory_deficit;
        $product_requirement->Comment = $request->Comment;
        $product_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Product_Id' => 'required',
            'Product_Count' => 'required',
//            'Comment' => 'required' ,
        ]);
        $product_requirement = ProductRequirement::find($id);
        $product_requirement->Product_Id = $request->Product_Id;
        $product_requirement->Product_Count = $request->Product_Count;
        $product_requirement->Comment = $request->Comment;
        $product_requirement->save();
        return json_encode(["response" => "Done"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_requirement = ProductRequirement::find($id);
        $product_requirement->delete();
        return redirect()->back()->with('successMSG', 'product_requirement Successfully Delete');
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
//            $product_requirement = ProductRequirement::skip($start)->take($length)->get();
            $product_requirement = DB::table('hnt_product_requirements')->join('hnt_products', 'hnt_product_requirements.Product_Id', '=', 'hnt_products.id')
                ->select('hnt_product_requirements.Product_Id','hnt_product_requirements.id', 'hnt_product_requirements.Product_Count','hnt_products.hp_product_name','hnt_product_requirements.Comment')
                ->skip($start)->take($length)->get();
        } else {

            $product_requirement = DB::table('hnt_product_requirements')
                ->join('hnt_products', 'hnt_product_requirements.Product_Id', '=', 'hnt_products.id')
                ->select('hnt_product_requirements.id','hnt_product_requirements.Product_Id', 'hnt_product_requirements.Product_Count', 'hnt_product_requirements.Comment', 'hnt_products.hp_product_name')
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($product_requirement as $product_requirements) {
            $data .= '["' . $product_requirements->id . '",' . '"' . $product_requirements->hp_product_name . '",' . '"' . $product_requirements->Product_Count . '",' . '"' . $product_requirements->Comment . '",' . '"' . $product_requirements->Product_Id . '"],';
        }
        $data = substr($data, 0, -1);
        $product_requirements_count = ProductRequirement::all()->count();
        return response('{ "recordsTotal":' . $product_requirements_count . ',"recordsFiltered":' . $product_requirements_count . ',"data": [' . $data . ']}');
    }


}
