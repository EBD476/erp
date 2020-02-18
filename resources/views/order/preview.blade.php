@extends('layouts.app')

@section('title',__('Order'))

@push('css')
@endpush

@section('content')
    <!------ Include the above in your HEAD tag ---------->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('order_product.store')}}" method="POST"
                                          ENCTYPE="multipart/form-data">
                                        @CSRF
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left"><h4
                                                                    style="margin-top:30px;">{{__('Date:')}} {{$data->hop_due_date}}</h4>
                                                            <input name="hop_due_date" value="{{$data->hop_due_date}}"
                                                                   type="hidden">
                                                        </td>
                                                        <td class="text-center"><h1
                                                                    style="margin-top:70px; margin-right: 150px ; margin-left: 150px">{{__('Pre Invoice Sales Of Product')}}</h1>
                                                        </td>
                                                        <td><img align="right" width="170" height="170"
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
                                                            <th class="text-center">
                                                                <strong>{{__('Owner profile')}}
                                                                    @foreach($client as $clients)
                                                                        @if($clients->id == $order->ho_client)
                                                                            &nbsp;{{$clients->hc_name}}
                                                                        @endif
                                                                    @endforeach
                                                                    &nbsp;{{$order->hp_phone_number}}</strong>
                                                                <input value="{{$order->ho_client}}"
                                                                       name="hpo_client_id"
                                                                       type="hidden">
                                                                <input value="{{$order->id}}" name="hpo_order_id"
                                                                       type="hidden">
                                                            </th>
                                                            <th class="text-center">
                                                                {{__('Employer Name:')}}
                                                                &nbsp;{{$order->hp_employer_name}}</th>
                                                            <th class="text-center">{{__('Project Name:')}}
                                                                &nbsp;{{$order->hp_project_name}}</th>
                                                            <th class="text-center">&nbsp;{{__('Type Project:')}}
                                                                &nbsp;{{$order->hp_type_project}}</th>
                                                            <th class="text-center">
                                                                {{__('Address:')}}
                                                                &nbsp;{{$state->hp_project_state}}{{$city->hp_city }}
                                                                &nbsp;{{$order->hp_address}}
                                                            </th>
                                                            <th class="text-center">
                                                                &nbsp;{{__('Create By:')}}
                                                                &nbsp;{{$order->hp_registrant}}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"><strong>{{__('Row')}}</strong></th>
                                                            <th class="text-center">
                                                                <strong>{{__('Product Name')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Description of Product')}}</strong></th>
                                                            <th class="text-center"><strong>{{__('Price')}}</strong>
                                                            </th>
                                                            <th class="text-center"><strong>{{__('Quantity')}}</strong>
                                                            </th>
                                                            <th class="text-center"><strong>{{__('Sub Total')}}</strong>
                                                            </th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        <div hidden>{{  $index = 0 }}</div>
                                                        @foreach($data->name as $key => $data_loop)
                                                            @foreach($product as $products)
                                                                @if($products->id == $data->name[$index])
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 1}}</td>
                                                                        <input type="hidden"
                                                                               value="{{$data->name[$index]}}"
                                                                               name="name[]">
                                                                        <td class="text-center">{{$products->hp_product_name . $products->hp_product_model . $products->hp_product_color_id . $products->hp_product_size . $products->hp_product_property . $products->hp_product_code_number}}</td>
                                                                        <td class="text-center">{{$data->invoice_items[$index]}}</td>
                                                                        <input value="{{$data->invoice_items[$index]}}"
                                                                               name="invoice_items[]" type="hidden">
                                                                        <td class="text-center">{{$products->hp_product_price}}</td>
                                                                        <td class="text-center">{{$data->invoice_items_qty[$index]}}</td>
                                                                        <input value="{{$data->invoice_items_qty[$index]}}"
                                                                               name="invoice_items_qty[]" type="hidden">
                                                                        <td class="text-center">{{$data->total[$index]}}</td>
                                                                        <input value="{{$data->total[$index]}}"
                                                                               name="total[]"
                                                                               type="hidden">
                                                                        <td hidden="hidden">{{$index++}}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        <td class="thick-line"></td>
                                                        </tbody>
                                                        <table>
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                <th class="no-line">
                                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Totals')}}</strong>&nbsp;{{$data->all_tot}}
                                                                    <input value="{{$data->all_tot}}" name="all_tot"
                                                                           type="hidden">
                                                                </th>

                                                            </tr>
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                <th class="no-line">
                                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Discount')}}
                                                                        %&nbsp;</strong>{{$data->hpo_discount}}&nbsp;&nbsp;
                                                                    <input value="{{$data->hpo_discount}}"
                                                                           name="hpo_discount"
                                                                           type="hidden">
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                <th class="no-line">
                                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Total including discount:')}}
                                                                        &nbsp;</strong>{{$data->all_dis}}</th>
                                                                <input value="{{$data->all_dis}}" name="all_dis"
                                                                       type="hidden">
                                                            </tr>
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                &nbsp;
                                                            </tr>
                                                        </table>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button type="submit"
                                                        class="btn btn-outline-light">{{__('Verify')}}</button>
                                                <a href="{{route('order.create')}}"
                                                   class="btn btn-outline-light">{{__('Back')}}</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        {{--$(document).ready(function () {--}}

        {{--$("#form1").submit('click', function (event) {--}}
        {{--var data = $("#form1").serialize();--}}
        {{--event.preventDefault();--}}
        {{--$.blockUI({--}}
        {{--message: '{{__('please wait...')}}', css: {--}}
        {{--border: 'none',--}}
        {{--padding: '15px',--}}
        {{--backgroundColor: '#000',--}}
        {{--'-webkit-border-radius': '10px',--}}
        {{--'-moz-border-radius': '10px',--}}
        {{--opacity: .5,--}}
        {{--color: '#fff'--}}
        {{--}--}}
        {{--});--}}
        {{--$.ajaxSetup({--}}
        {{--headers: {--}}
        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--}--}}
        {{--});--}}

        {{--$.ajax({--}}
        {{--url: '/order_product',--}}
        {{--type: 'POST',--}}
        {{--data: data,--}}
        {{--dataType: 'json',--}}
        {{--async: false,--}}
        {{--success: function (data) {--}}
        {{--setTimeout($.unblockUI, 2000);--}}
        {{--},--}}
        {{--cache: false,--}}
        {{--});--}}
        {{--});--}}
        {{--});--}}
    </script>
@endpush

