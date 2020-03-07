<?php

namespace App\Http\Controllers;

use App\FundTangibleFixedAssets;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;

class FundTangibleFixedAssetsController extends Controller
{
    public function index()
    {
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        $fund_tangible_fixed_assets = FundTangibleFixedAssets::all();
        return view('finance_fund.fund_non_current.fund_tangible_fixed_assets.index', compact('priority', 'help_desk', 'type','fund_tangible_fixed_assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::all();
        $type = HDtype::all();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $priority = HDpriority::all();
        return view('finance_fund.fund_non_current.fund_tangible_fixed_assets.create',compact('priority', 'help_desk', 'type','user'));
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
            'hdp_name' => 'required'
        ]);
        $fund_tangible_fixed_assets = New FundTangibleFixedAssets();
        $fund_tangible_fixed_assets->hftfa_name = $request->hftfa_name;
        $fund_tangible_fixed_assets->hftfa_price =$request->hftfa_price;
        $fund_tangible_fixed_assets->hftfa_count =$request->hftfa_count;
        $fund_tangible_fixed_assets->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function show(HDpriority $hDpriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $fund_tangible_fixed_assets = FundTangibleFixedAssets:: find($id);
        return view('finance_fund.fund_non_current.fund_tangible_fixed_assets.edit', compact('priority', 'help_desk', 'priority', 'type', 'fund_tangible_fixed_assets','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hdp_name' => 'required'
        ]);
        $fund_tangible_fixed_assets = FundTangibleFixedAssets:: find($id);
        $fund_tangible_fixed_assets->hftfa_name = $request->hftfa_name;
        $fund_tangible_fixed_assets->hftfa_price =$request->hftfa_price;
        $fund_tangible_fixed_assets->hftfa_count =$request->hftfa_count;
        $fund_tangible_fixed_assets->save();
        return json_encode(["response" => "Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HDpriority $hDpriority
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fund_tangible_fixed_assets = FundTangibleFixedAssets:: find($id);
        $fund_tangible_fixed_assets->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
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
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project. '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
