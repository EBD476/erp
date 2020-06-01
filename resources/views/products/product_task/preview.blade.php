@extends('layouts.app')

@section('title',__('Preview'))

@section('content')
    <!------ Include the above in your HEAD tag ---------->
    @role('Admin|order')
    <div class="content persian">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left"><h4
                                                                    style="margin-top:30px; margin-right: 0">{{__('Factor Report List:')}}{{$data_invoices->hpt_invoice_number}}</h4>
                                                        </td>
                                                        <td><img align="left" width="170" height="170"
                                                                 src="{{asset('assets/images/g.png')}}">
                                                        </td>

                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center"><strong>{{__('Row')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Product Name')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Count')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Report')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Comment')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Zone')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Level')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Registrant')}}</strong>
                                                            </th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        {{--                                                        @if($collect == 1)--}}

                                                        @foreach($data as $key => $data_report)
                                                            <tr>
                                                                <td class="text-center">{{$key + 1}}</td>
                                                                <td class="text-center">{{$data_report->hp_product_name . " " . $data_report->hp_product_model . " " .$data_report->hn_color_name  . " " . $data_report->hp_product_size . " " . $data_report->hpp_property_name}}</td>
                                                                <td class="text-center">{{$data_report->hpt_count}}</td>
                                                                <td class="text-center">{{$data_report->hpt_report}}</td>
                                                                <td class="text-center">{{$data_report->hpt_comment}}</td>
                                                                <td class="text-center">{{$data_report->hpt_product_zone_name}}</td>
                                                                <td class="text-center">{{$data_report->hps_name}}</td>
                                                                <td class="text-center">{{$data_report->name}}</td>
                                                            </tr>
                                                        @endforeach
                                                        <td class="thick-line"></td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endrole
@endsection
@push('script')
@endpush


