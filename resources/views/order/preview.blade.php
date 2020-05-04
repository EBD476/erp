@extends('layouts.app')

@section('title',__('Order'))

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
                                    <form hidden="hidden" id="form1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left"><h4
                                                                    style="margin-top:30px;">{{__('Date:')}} {{$data->hop_due_date}}</h4>
                                                            <input name="hop_due_date"
                                                                   value="{{$data->hop_due_date}}"
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
                                                                    &nbsp;{{$client->hc_name}}
                                                                    &nbsp;{{$order->hp_phone_number}}</strong>
                                                                <input value="{{$order->ho_client}}"
                                                                       name="hpo_client_id"
                                                                       type="hidden">
                                                                <input value="{{$order->id}}" name="hpo_order_id"
                                                                       id="hpo_order_id"
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
                                                                {{$order_registrant->name}}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"><strong>{{__('Row')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Product Name')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Description of Product')}}</strong>
                                                            </th>
                                                            <th class="text-center"><strong>{{__('Price')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Quantity')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Sub Total')}}</strong>
                                                            </th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        @if($collect == 1)
                                                            <tr>
                                                                @foreach($product as $key => $products)
                                                                    <td class="text-center">{{$key + 1}}</td>
                                                                    <input type="hidden"
                                                                           value="{{$data->name[0]}}"
                                                                           name="name[]">
                                                                    @if($products->id == $data->name[0])
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
                                                                    @endif
                                                                    <td class="text-center">{{$data->invoice_items[0]}}</td>
                                                                    <input value="{{$data->invoice_items[0]}}"
                                                                           name="invoice_items[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$products->hp_product_price}}</td>
                                                                    <td class="text-center">{{$data->invoice_items_qty[0]}}</td>
                                                                    <input value="{{$data->invoice_items_qty[0]}}"
                                                                           name="invoice_items_qty[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$data->total[0]}}</td>
                                                                    <input value="{{$data->total[0]}}"
                                                                           name="total[]"
                                                                           type="hidden">
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                @foreach($product as $key => $products)
                                                                    <td class="text-center">{{$key + 1}}</td>
                                                                    <input type="hidden"
                                                                           value="{{$data->name[$loop->index]}}"
                                                                           name="name[]">
                                                                    @if($products->id == $data->name[$loop->index])
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
                                                                    @endif
                                                                    <td class="text-center">{{$data->invoice_items[$loop->index]}}</td>
                                                                    <input value="{{$data->invoice_items[$loop->index]}}"
                                                                           name="invoice_items[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$products->hp_product_price}}</td>
                                                                    <td class="text-center">{{$data->invoice_items_qty[$loop->index]}}</td>
                                                                    <input value="{{$data->invoice_items_qty[$loop->index]}}"
                                                                           name="invoice_items_qty[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$data->total[$loop->index]}}</td>
                                                                    <input value="{{$data->total[$loop->index]}}"
                                                                           name="total[]"
                                                                           type="hidden">
                                                            </tr>
                                                            @endforeach
                                                        @endif
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
                                                            @if($data->hpo_discount != "")
                                                                <tr>
                                                                    <th class="no-line"></th>
                                                                    <th class="no-line"></th>
                                                                    <th class="no-line">
                                                                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Discount')}}
                                                                            %&nbsp;</strong>{{$data->hpo_discount}}
                                                                        &nbsp;&nbsp;
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
                                                            @endif
                                                        </table>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{route('order.edit_pre',$order->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left"><h4
                                                                    style="margin-top:30px;">{{__('Date:')}} {{$data->hop_due_date}}</h4>
                                                            <input name="hop_due_date"
                                                                   value="{{$data->hop_due_date}}"
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
                                                                    &nbsp;{{$client->hc_name}}
                                                                    &nbsp;{{$order->hp_phone_number}}</strong>
                                                                <input value="{{$order->ho_client}}"
                                                                       name="hpo_client_id"
                                                                       type="hidden">
                                                                <input value="{{$order->id}}" name="hpo_order_id"
                                                                       id="hpo_order_id"
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
                                                                {{$order_registrant->name}}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"><strong>{{__('Row')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Product Name')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Description of Product')}}</strong>
                                                            </th>
                                                            <th class="text-center"><strong>{{__('Price')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Quantity')}}</strong>
                                                            </th>
                                                            <th class="text-center">
                                                                <strong>{{__('Sub Total')}}</strong>
                                                            </th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        @if($collect == 1)
                                                            <tr>
                                                                @foreach($product as $key => $products)
                                                                    <td class="text-center">{{$key + 1}}</td>
                                                                    <input type="hidden"
                                                                           value="{{$data->name[0]}}"
                                                                           name="name[]">
                                                                    @if($products->id == $data->name[0])
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
                                                                    @endif
                                                                    <td class="text-center">{{$data->invoice_items[0]}}</td>
                                                                    <input value="{{$data->invoice_items[0]}}"
                                                                           name="invoice_items[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$products->hp_product_price}}</td>
                                                                    <td class="text-center">{{$data->invoice_items_qty[0]}}</td>
                                                                    <input value="{{$data->invoice_items_qty[0]}}"
                                                                           name="invoice_items_qty[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$data->total[0]}}</td>
                                                                    <input value="{{$data->total[0]}}"
                                                                           name="total[]"
                                                                           type="hidden">
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                @foreach($product as $key => $products)
                                                                    <td class="text-center">{{$key + 1}}</td>
                                                                    <input type="hidden"
                                                                           value="{{$data->name[$loop->index]}}"
                                                                           name="name[]">
                                                                    @if($products->id == $data->name[$loop->index])
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
                                                                    @endif
                                                                    <td class="text-center">{{$data->invoice_items[$loop->index]}}</td>
                                                                    <input value="{{$data->invoice_items[$loop->index]}}"
                                                                           name="invoice_items[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$products->hp_product_price}}</td>
                                                                    <td class="text-center">{{$data->invoice_items_qty[$loop->index]}}</td>
                                                                    <input value="{{$data->invoice_items_qty[$loop->index]}}"
                                                                           name="invoice_items_qty[]"
                                                                           type="hidden">
                                                                    <td class="text-center">{{$data->total[$loop->index]}}</td>
                                                                    <input value="{{$data->total[$loop->index]}}"
                                                                           name="total[]"
                                                                           type="hidden">
                                                            </tr>
                                                            @endforeach
                                                        @endif
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
                                                            @if($data->hpo_discount != "")
                                                                <tr>
                                                                    <th class="no-line"></th>
                                                                    <th class="no-line"></th>
                                                                    <th class="no-line">
                                                                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{__('Discount')}}
                                                                            %&nbsp;</strong>{{$data->hpo_discount}}
                                                                        &nbsp;&nbsp;
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
                                                            @endif
                                                        </table>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <button id="edit_pre" type="submit"
                                                    class="btn btn-outline-light">{{__('Back')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit"
                                                id="btn-1" class="btn btn-outline-light">{{__('Verify')}}</button>
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
@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#btn-1").on('click', function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                $.blockUI({
                    message: '{{__('please wait...')}}', css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/order_product',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/order";
                    },
                    cache: false,
                });
            });
        });

    </script>

@endpush

