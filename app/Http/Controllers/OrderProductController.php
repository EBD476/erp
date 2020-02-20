<?php

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use Spatie\Browsershot\Browsershot;
use VerumConsilium\Browsershot\Facades\PDF;

class OrderProductController extends Controller
{

//    store invoices item
    public function store(Request $request)
    {
        $size_name = count(collect($request)->get('total'));
        if ($size_name == 1) {
            $product = new OrderProduct();
            $product->hpo_product_id = $request->name;
            $product->hpo_count = $request->invoice_items_qty;
            $product->hpo_order_id = $request->hpo_order_id;
            $product->hpo_client_id = $request->hpo_client_id;
            $product->hop_due_date = $request->hop_due_date;
            $product->hpo_discount = $request->hpo_discount;
            $product->hpo_description = $request->invoice_items;
            $product->hpo_total = $request->total;
            $product->hpo_total_all = $request->all_tot;
            $product->hpo_total_discount = $request->all_dis;
            $product->hpo_status = '1';
            $product->save();
        } else {
            $user = User::all();
            $type = HDtype::all();
            $priority = HDpriority::ALL();
            $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
            $order = Order::ALL();
            $progress = OrderState::all();
            $items = $request->name;
            $index = 0;
            foreach ($items as $item) {
                if ($item != "") {
                    $product = new OrderProduct();
                    $product->hpo_product_id = $request->name[$index];
                    $product->hpo_count = $request->invoice_items_qty[$index];
                    $product->hpo_order_id = $request->hpo_order_id;
                    $product->hpo_client_id = $request->hpo_client_id;
                    $product->hop_due_date = $request->hop_due_date;
                    $product->hpo_discount = $request->hpo_discount;
                    $product->hpo_description = $request->invoice_items[$index];
                    $product->hpo_total = $request->total[$index];
                    $product->hpo_total_all = $request->all_tot;
                    $product->hpo_total_discount = $request->all_dis;
                    $product->hpo_status = '1';
                    $product->save();
                    $index++;
                }
            }
//        return json_encode(["response" => "OK"]);
            return view('order.index', compact('order', 'user', 'type', 'priority', 'help_desk', 'progress'));
        }
    }

//    update invoices item
    public function update(Request $request, $id)
    {
        $items = $request->name;
        $index = 0;
//        $size_name = count(collect($request)->get('total')) - 1;
//        $size_pid = count(collect($request)->get('pid'));
//        if ($size_pid == $size_name) {
        foreach ($items as $item) {
            if ($item != "") {
                $product = OrderProduct::where('hpo_order_id', $id)->where('id', $request->pid[$index])->first();
                $product->hpo_product_id = $request->name[$index];
                $product->hpo_count = $request->invoice_items_qty[$index];
                $product->hpo_order_id = $request->hpo_order_id;
                $product->hpo_client_id = $request->hpo_client_id;
                $product->hop_due_date = $request->hop_due_date;
                $product->hpo_discount = $request->hpo_discount;
                $product->hpo_total = $request->total[$index];
                $product->hpo_description = $request->invoice_items[$index];
                $product->hpo_total_all = $request->all_tot;
                $product->hpo_total_discount = $request->all_dis;
                $product->hpo_status = '1';
                $product->save();
                $index++;
            }
        }
//        }

//            return json_encode(["response" => "OK"]);
        return redirect()->back();
    }

//    delete invoice items

    public
    function destroy($id)
    {
        $item = OrderProduct::find($id);
        $item->delete();
        return json_encode(["response" => "OK"]);

    }

    public function createpdf(){
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
        Browsershot ::url('https://example.com')->save($pathToImage);
    }
}
