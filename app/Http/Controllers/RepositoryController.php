<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Client;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\Product;
use App\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use carbon\carbon;
class RepositoryController extends Controller
{
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $Repositories = Repository:: all();
        $repository_product_count = DB::select("SELECT sum(hr_product_stock) as sum_hpo FROM hnt_repositories");
        $orders = OrderProduct::all();
        $product = Product::ALL();
        $client = Client::all();

        $query_order_product = DB::select("SELECT sum(hpo_count) as sum_hpo , hpo_status , hpo_product_id FROM hnt_products,hnt_invoice_items WHERE hnt_products.id =hnt_invoice_items.hpo_product_id group by hnt_invoice_items.hpo_product_id , hpo_status ");
        $query_order_product_all = DB::select("SELECT sum(hpo_count) as sum_hpo FROM hnt_invoice_items where hpo_status != 'Approved'");


        return view('Repository.index',['repository_product_count'=>$repository_product_count,'query' => $query_order_product, 'client' => $client, 'order_all' => $query_order_product_all], compact('Repositories', 'product', 'orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Repository.create');
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
                $order=Order::find($id);
                $current_date = Carbon::now();
                $agreement_number = $current_date->year . $current_date->month . $current_date->day;
                $agrement=new Agreement();
                $agrement->hg_agreement_number=$agreement_number;
                $agrement->hg_invoice=$order->hp_Invoice_number;
                $agrement->hg_client=$order->ho_client;
                $agrement->save();
            }
        }
        Repository::where('hr_product_id', $product)
            ->update(['hr_product_stock' => $request->computing_repository_requirement]);

        return json_encode(["response" => "عملیات با موفقیت ثبت شد"]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_product_stock' => 'required',
            'hr_comment' => 'required',
        ]);

        $Repositories = new Repository();
        $Repositories->hr_product_id = $request->hr_product_id;
        $Repositories->hr_product_stock = $request->hr_product_stock;
        $Repositories->hr_comment = $request->hr_comment;
        $Repositories->hr_entry_date = $request->hr_entry_date;
        $Repositories->hr_exit = $request->hr_exit;
        $Repositories->hr_contradiction = $request->hr_contradiction;
        $Repositories->hr_provider_code = $request->hr_provider_code;
        $Repositories->hr_return_value = $request->hr_return_value;
        $Repositories->hr_status_return_part = $request->hr_status_return_part;
        $Repositories->save();
        return json_encode(["response" => "OK"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
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
    public
    function edit($id)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $Repositories = Repository::find($id);
        return view('Repository . edit', compact('Repositories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
//        if($this->authorize('update',Repository::class))
//        {
        $this->validate($request, [
            'hr_product_id' => 'required',
            'hr_product_stock' => 'required',
            'hr_comment' => 'required',
        ]);
        $Repositories = Repository::find($id);
        $Repositories->hr_product_id = $request->hr_product_id;
        $Repositories->hr_product_stock = $request->hr_product_stock;
        $Repositories->hr_comment = $request->hr_comment;
        $Repositories->hr_entry_date = $request->hr_entry_date;
        $Repositories->hr_exit = $request->hr_exit;
        $Repositories->hr_contradiction = $request->hr_contradiction;
        $Repositories->hr_provider_code = $request->hr_provider_code;
        $Repositories->hr_return_value = $request->hr_return_value;
        $Repositories->hr_status_return_part = $request->hr_status_return_part;
        $Repositories->save();
        return redirect()->route('repository . index')->with('successMSG', 'عملیات ویرایش اطلاعات با موفقیت انجام شد . ');
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
//        IF($this->authorize('delete',Repository::class))
//        {
        $Repositories = Repository::find($id);
        $Repositories->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد . ');
//        }
    }
}
