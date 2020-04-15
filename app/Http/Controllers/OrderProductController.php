<?php

namespace App\Http\Controllers;


use App\Order;
use App\OrderProduct;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use VerumConsilium\Browsershot\Facades\PDF;

class OrderProductController extends Controller
{

//    store invoices item
    public function store(Request $request)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $size_name = count(collect($request)->get('total'));

        if ($size_name == 1) {
            if ($request->name != "") {
                $product = new OrderProduct();
                $product->hpo_product_id = $request->name[0];
                $product->hpo_count = 1;
                $product->hpo_order_id = $request->hpo_order_id;
                $product->hop_due_date = $create_due_date;
                $product->hpo_description = $request->invoice_items[0];
                $product->hpo_total = $request->total[0];
                $product->hpo_status = '1';
                $product->save();

            }
        } else {
            $items = $request->name;
            $index = 0;
            foreach ($items as $item) {
                if ($item != "") {
                    $product = new OrderProduct();
                    $product->hpo_product_id = $request->name[$index];
                    $product->hpo_count = $request->invoice_items_qty[$index];
                    $product->hpo_order_id = $request->hpo_order_id;
                    $product->hop_due_date = $create_due_date;
                    $product->hpo_description = $request->invoice_items[$index];
                    $product->hpo_total = $request->total[$index];
                    $product->hpo_status = '1';
                    $product->save();
                    $index++;
                }


            }
        }

//      update invoice tb
//      Tax Pr
        $tax = Tax::select('hpx_tax')->get()->last();
        $process = $tax->hpx_tax * $request->all_tot / 100;
        $all_tot = $request->all_tot - $process;
        $process_dis = $tax->hpx_tax * $request->all_dis / 100;
        $all_dis = $request->all_dis - $process_dis;
        $product_order = Order::find($request->hpo_order_id);
        $product_order->hp_total_all = $request->all_tot;
        if ($request->all_dis == "") {
            $product_order->hp_total_discount = $all_tot;
        } else {
            $product_order->hp_total_discount = $all_dis;
        }        $product_order->hp_discount = $request->hpo_discount;
        $product_order->save();

        return json_encode(["response" => "OK"]);
    }

//    update invoices item
    public function update(Request $request, $id)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $items = $request->pid;
        $index = 0;
        foreach ($items as $item) {
            if ($item != "") {
                $product = OrderProduct::where('hpo_order_id', $id)->where('id', $request->pid[$index])->first();
                $product->hpo_product_id = $request->name[$index];
                $product->hpo_count = $request->invoice_items_qty[$index];
                $product->hpo_order_id = $request->hpo_order_id;
                if ($request->hop_due_date != "") {
                    $product->hop_due_date = $request->hop_due_date;
                } else {
                    $product->hop_due_date = $create_due_date;
                }
                $product->hpo_total = $request->total[$index];
                $product->hpo_description = $request->invoice_items[$index];
                $product->hpo_status = '1';
                $product->save();
                $index++;
            }
        }

//      update invoice tb
        //      update invoice tb
//      Tax Pr
        $tax = Tax::select('hpx_tax')->get()->last();
        $process = $tax->hpx_tax * $request->all_tot / 100;
        $process_dis = $tax->hpx_tax * $request->all_dis / 100;
        $all_tot = $request->all_tot - $process;
        $all_dis = $request->all_dis - $process_dis;
        $product_order = Order::find($request->hpo_order_id);
//        $product_order->hp_total_all = $all_tot;
        $product_order->hp_total_all = $request->all_tot;
        if ($request->all_dis == "") {
            $product_order->hp_total_discount = $all_tot;
        } else {
            $product_order->hp_total_discount = $all_dis;
        }
        $product_order->hp_discount = $request->hpo_discount;
        $product_order->save();

        return json_encode(["response" => "OK"]);
    }

//    delete invoice items

    public
    function destroy($id)
    {
        $item = OrderProduct::find($id);
        $item->delete();
        return json_encode(["response" => "OK"]);

    }

    public function createpdf()
    {
//
//        $client = Client::all();
//        $product = Product::all();
//        $user = User::all();
//        $type = HDtype::all();
//        $priority = HDpriority::ALL();
//        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
//        $data = $request;
////        $order = Order:: where('id', $request->hpo_order_id)->get()->last();
//        $city = address:: where('id', $order->hp_address_city_id)->get()->last();
//        $state = Project_State:: where('id', $order->hp_address_state_id)->get()->last();


//        Browsershot::url('https://example.com')
//            ->fullPage()
//            ->save(url('../../assets/images'));
//
//        $browser = new Browsershot();
//        $browser =  new \Spatie\Browsershot\Browsershot();
//
//        $browser
//            ->setURL('https://example.com')
//            ->setWidth('1024')
//            ->setHeight('768')
//            ->save('../../assets/images.'.'.jpg');
//
//        return view('pages.teste2');


        return PDF::loadView('view.name', $data)
            ->margins(20, 0, 0, 20)
            ->download();
        Browsershot::url('https://example.com')->save($pathToImage);
    }

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

    public function add(Request $request)
    {
        $date = Carbon::now();
//        deu date time for exit from product level
        $create_due_date = date('Y-m-d', strtotime($date . ' + 60 days'));
        $size_name = count(collect($request)->get('total'));

        if ($size_name == 1) {
            if ($request->name != "") {
                $product = new OrderProduct();
                $product->hpo_product_id = $request->name;
                $product->hpo_count = 1;
                $product->hpo_order_id = $request->hpo_order_id;
                $product->hop_due_date = $create_due_date;
                $product->hpo_description = $request->invoice_items;
                $product->hpo_total = $request->total;
                $product->hpo_status = '1';
                $product->save();
            }
        }
    }
}
