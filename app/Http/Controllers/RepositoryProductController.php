<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Client;
use App\MiddlePart;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\Provider;
use App\RepositoryMiddlePart;
use App\RepositoryProduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use carbon\carbon;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Part;
use App\RepositoryCreate;
use App\RepositoryPart;

class RepositoryProductController extends Controller
{

    public function index()
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_product = RepositoryProduct:: all();
        $product = Product::select('id', 'hp_product_name')->get();
        $repository=RepositoryPart::select('id','hrp_part_id','hrp_repository_id','hrp_part_count')->get();
        $repository_name=RepositoryCreate::select('id','hr_name')->get();
        $part = Part::select('id','hp_name')->get();
        $repository_middle_part=RepositoryMiddlePart::select('id','hrm_count','hrm_comment','hrm_middle_part_id')->get();
        $middle_part=MiddlePart::Select('id','hmp_name')->get();

        return view('Repository.index', compact('repository_middle_part','part','repository_name','repository','user', 'repository_product', 'product', 'help_desk', 'priority', 'type','middle_part'));

    }



//    charge product count in repository
    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $provider = Provider::select('id', 'hp_name')->get();
        $repository_name=RepositoryCreate::all();
        return view('Repository.create', compact('repository_name','type', 'priority', 'help_desk', 'user', 'product', 'provider'));
    }

    public function order_state(Request $request, $id)
    {
        $product = $request->product;
        OrderProduct::where('hpo_order_id', $id)
            ->where('hpo_product_id', $product)
            ->update(['hpo_status' => '4']);
        $count = OrderProduct::where('hpo_order_id', $id)->get();
        $number = 0;
        foreach ($count as $counts) {
            if ($counts->hpo_status == '4') {
                $number++;
            }
            if (OrderProduct::where('hpo_order_id', $id)->count() == $number) {
                OrderState::where('order_id', $id)
                    ->update(['ho_process_id' => $request->state]);
                $order = Order::find($id);
                $current_date = Carbon::now();
                $agreement_number = $current_date->year . $current_date->month . $current_date->day;
                $agrement = new Agreement();
                $agrement->hg_agreement_number = $agreement_number;
                $agrement->hg_invoice = $order->hp_Invoice_number;
                $agrement->hg_client = $order->ho_client;
                $agrement->save();
            }
        }
        RepositoryProduct::where('hr_product_id', $product)
            ->update(['hr_product_stock' => $request->computing_repository_requirement]);

        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);


    }

    public
    function store(Request $request)
    {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_product_stock' => 'required',
            'hr_comment' => 'required',
        ]);

        $repository_product = new RepositoryProduct();
        $repository_product->hr_product_id = $request->hr_product_id;
        $repository_product->hr_product_stock = $request->hr_product_stock;
        $repository_product->hr_comment = $request->hr_comment;
        $repository_product->hr_entry_date = $request->hr_entry_date;
        $repository_product->hr_exit = $request->hr_exit;
        $repository_product->hr_contradiction = $request->hr_contradiction;
        $repository_product->hr_provider_code = $request->hr_provider_code;
        $repository_product->hr_return_value = $request->hr_return_value;
        $repository_product->hr_status_return_part = $request->hr_status_return_part;
        $repository_product->hr_repository_id = $request->hr_repository_id;
        $repository_product->save();
        return json_encode(["response" => "OK"]);

    }

    public
    function edit($id)
    {
        $current_user=auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name','id')->get();
        $priority = HDpriority::select('id','hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $Repositories = RepositoryProduct::find($id);
        return view('Repository . edit', compact('Repositories', 'type', 'priority', 'help_desk', 'user'));
    }


    public
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_product_stock' => 'required',
            'hr_comment' => 'required',
        ]);
        $repository_products = RepositoryProduct::find($id);
        $repository_products->hr_product_id = $request->hr_product_id;
        $repository_products->hr_product_stock = $request->hr_product_stock;
        $repository_products->hr_comment = $request->hr_comment;
        $repository_products->hr_entry_date = $request->hr_entry_date;
        $repository_products->hr_exit = $request->hr_exit;
        $repository_products->hr_contradiction = $request->hr_contradiction;
        $repository_products->hr_provider_code = $request->hr_provider_code;
        $repository_products->hr_return_value = $request->hr_return_value;
        $repository_products->hr_status_return_part = $request->hr_status_return_part;
        $repository_products->hr_repository_id = $request->hr_repository_id;
        $repository_products->save();
        return json_encode(["response" => "OK"]);

    }

    public
    function destroy($id)
    {
        $repository_products = RepositoryProduct::find($id);
        $repository_products->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد . ');
    }

    //    end charging


    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }

    public function fill_data_repository_middle_part(Request $request)
    {
        $search = $request->search;
        if ($search != "") {
            $middle_part = MiddlePart::select('hmp_name as text', 'id', 'hmp_middle_part_model', 'hmp_serial_number', 'hmp_image')->where('hmp_name', 'LIKE', "%$search%")->orwhere('hmp_serial_number', 'LIKE', "%$search%")->get();
        }
        return json_encode(["results" => $middle_part]);
    }

    public function fill_data_repository_product(Request $request)
    {
        $search = $request->search;
        if ($search != "") {

            $product = DB::table('hnt_products')
                ->join('hnt_product_color', 'hnt_products.hp_product_color_id', '=', 'hnt_product_color.id')
                ->join('hnt_product_property', 'hnt_products.hp_product_property', '=', 'hnt_product_property.id')
                ->join('hnt_product_property_items', 'hnt_product_property.hpp_property_items', 'hnt_product_property_items.id')
                ->select('hnt_products.id', 'hnt_products.hp_product_image', 'hnt_products.hp_product_name as text', 'hnt_products.hp_product_price', 'hnt_product_color.hn_color_name', 'hnt_product_property.hpp_property_name', 'hnt_product_property_items.hppi_items_name')
                ->where('hnt_products.id', 'LIKE', "%$search%")
                ->orwhere('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }
        return json_encode(["results" => $product]);
    }
}
