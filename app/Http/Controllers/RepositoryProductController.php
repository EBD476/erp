<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\MiddlePart;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
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
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_product = RepositoryProduct:: all();
        $product = Product::select('id', 'hp_product_name')->get();
        $repository = RepositoryPart::select('id', 'hrp_part_id', 'hrp_repository_id', 'hrp_part_count')->get();
        $repository_name = RepositoryCreate::select('id', 'hr_name')->get();
        $part = Part::select('id', 'hp_name')->get();
        $repository_middle_part = RepositoryMiddlePart::select('id', 'hrm_count', 'hrm_comment', 'hrm_middle_part_id')->get();
        $middle_part = MiddlePart::Select('id', 'hmp_name')->get();

        return view('Repository.index', compact('repository_middle_part', 'part', 'repository_name', 'repository', 'user', 'repository_product', 'product', 'help_desk', 'priority', 'type', 'middle_part'));

    }

//    charge product count in repository
    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $repository_name = RepositoryCreate::select('id', 'hr_name')->get();
        return view('Repository.create', compact('repository_name', 'type', 'priority', 'help_desk', 'user', 'product'));
    }

    public function order_state(Request $request, $id)
    {
        $product = $request->product;
        OrderProduct::where('id', $id)
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

    public function store(Request $request)
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

    public function destroy($id)
    {
        $repository_products = RepositoryProduct::find($id);
        $repository_products->delete();
        return json_encode(["response" => "OK"]);
    }

    //    end charging


    //fill data to repositories
    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_provider', 'hnt_repository_product.hr_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_provider', 'hnt_repository_product.hr_provider_code', '=', 'hnt_provider.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_id', 'hnt_repository_product.hr_product_stock', 'hnt_repository_product.hr_entry_date', 'hnt_repository_product.hr_exit', 'hnt_repository_product.hr_provider_code', 'hnt_repository_product.hr_return_value', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_repository_id', 'hnt_repository_product.hr_status_return_part', 'hnt_repository_product.hr_comment', 'hnt_repository_product.hr_contradiction', 'hnt_products.hp_product_name', 'hnt_provider.hp_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
//                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
//                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0 ;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' .$key . '",' . '"' . $repository_products->hp_product_name . '",' . '"' . $repository_products->hr_product_stock . '",' . '"' . $repository_products->hp_name . '",' . '"' . $repository_products->hr_name . '",' . '"' . $repository_products->hr_entry_date . '",' . '"' . $repository_products->hr_exit . '",' . '"' . $repository_products->hr_return_value . '",' . '"' . $repository_products->hr_contradiction . '",' . '"' . $repository_products->hr_status_return_part . '",' . '"' . $repository_products->hr_comment . '",' . '"' . $repository_products->hr_provider_code . '",' . '"' . $repository_products->hr_repository_id . '",' . '"' . $repository_products->hr_product_id . '",' . '"' . $repository_products->id . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = Order::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }

    //    fill data to repositories
    public function fill_p(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_stock','hnt_products.hp_product_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $repository_product = DB::table('hnt_repository_product')
                ->join('hnt_products', 'hnt_repository_product.hr_product_id', '=', 'hnt_products.id')
                ->join('hnt_repository', 'hnt_repository_product.hr_repository_id', '=', 'hnt_repository.id')
                ->select('hnt_repository_product.id', 'hnt_repository_product.hr_product_stock','hnt_products.hp_product_name', 'hnt_repository.hr_name')
                ->where('hnt_repository_product.deleted_at', '=', Null)
                ->where('hnt_products.hp_product_name', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        $key = 0 ;
        foreach ($repository_product as $repository_products) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $repository_products->hp_product_name . '",' . '"' . $repository_products->hr_product_stock . '",' . '"' . $repository_products->hr_name . '"],';
        }
        $data = substr($data, 0, -1);
        $repository_products_count = Order::all()->count();
        return response('{ "recordsTotal":' . $repository_products_count . ',"recordsFiltered":' . $repository_products_count . ',"data": [' . $data . ']}');
    }
}
