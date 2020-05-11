@extends('layouts.app')

@section('title',__('Order'))

@push('css')
@endpush

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
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <table class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <td class="text-left"><h4
                                                                style="margin-top:30px;">{{__('Date:')}} {{$data_dis->hop_due_date}}</h4>
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
                                                    <th class="text-center"><strong>{{__('Owner profile')}}
                                                            &nbsp;{{$client->hc_name}}
                                                            &nbsp;{{$order->hp_phone_number}}</strong></th>
                                                    <th class="text-center">{{__('Employer Name:')}}
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
                                                        &nbsp;{{__('Create By:')}}&nbsp;
                                                        {{$order_registrant->name}}
                                                    </th>
                                                    </thead>
                                                    <thead>
                                                    <th class="text-center"><strong>{{__('Row')}}</strong></th>
                                                    <th class="text-center"><strong>{{__('Product Name')}}</strong></th>
                                                    <th class="text-center"><strong>{{__('Quantity')}}</strong></th>
                                                    <th class="text-center">
                                                        <strong>{{__('Description of Product')}}</strong></th>
                                                    @role('Admin||order')
                                                    <th class="text-center"><strong>{{__('Price')}}</strong></th>
                                                    <th class="text-center"><strong>{{__('Sub Total')}}</strong></th>
                                                    @endrole
                                                    </thead>
                                                    <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                    @foreach($data as $data_loop)
                                                        @foreach($product as $key => $products)
                                                            @if($products->id == $data_loop->hpo_product_id)
                                                                <tr>
                                                                    <td class="text-center">{{$key + 1}}</td>
                                                                    @foreach ($properties as $property)
                                                                        @foreach ($items as $item)
                                                                            @foreach ($color as $colors)
                                                                                @if($colors->id == $products->hp_product_color_id)
                                                                                    @if($property->id == $products->hp_product_property)
                                                                                        @if($item->id == $property->hpp_property_items)
                                                                                            <td class="text-center">{{$products->hp_product_name . " " . $products->hp_product_model . " " .$colors->hn_color_name  . " " . $products->hp_product_size . " " . $property->hpp_property_name . " " . $item->hppi_items_name}}</td>
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endforeach
                                                                    <td class="text-center">{{$data_loop->hpo_count}}</td>
                                                                    <td class="text-center">{{$data_loop->hpo_description}}</td>
                                                                    @role('Admin||order')
                                                                    <td class="text-center">{{$products->hp_product_price}}</td>
                                                                    <td class="text-center">{{$data_loop->hpo_total}}</td>
                                                                    @endrole
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    <td class="thick-line"></td>
                                                    </tbody>
                                                    @role('Admin||order')
                                                    <table>
                                                        <tr>
                                                            <th class="no-line"></th>
                                                            <th class="no-line"></th>
                                                            <th class="no-line">
                                                                <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Totals')}}</strong>&nbsp;{{$order->hp_total_all}}
                                                            </th>

                                                        </tr>
                                                        @if($order->hp_discount != "")
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                <th class="no-line">
                                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Discount')}}
                                                                        %&nbsp;</strong>{{$order->hp_discount}}&nbsp;&nbsp;
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="no-line"></th>
                                                                <th class="no-line"></th>
                                                                <th class="no-line">
                                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Total including discount:')}}
                                                                        &nbsp;</strong>{{$order->hp_total_discount}}
                                                                </th>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </table>
                                            </div>
                                            @if ($current_verified_order === null and $order->hp_status == 1)
                                                <form method="POST" action="{{route('verify_pre.update',$order->id)}}"
                                                      ENCTYPE="multipart/form-data">
                                                    @CSRF
                                                    @method('PUT')
                                                    <button class="btn btn-primary">{{__('Verify')}}</button>
                                                </form>
                                            @endif
                                            @endrole
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection



