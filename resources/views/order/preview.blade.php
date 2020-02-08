<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            &nbsp;
            <div class="invoice-title" style="text-align: right">
                &nbsp;
                <h1 class="pull-right">{{__('Invoice Information')}}</h1>
                &nbsp;
            </div>
            &nbsp;
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                        <h3>{{$order->hp_registrant}}&nbsp;{{__('Create By:')}}  </h3>

                        <br>
                        <br>
                    </address>
                </div>
                <div class="col-xs-4 text-right">
                    <address>
                        <h4>{{__('Owner profile')}} &nbsp;{{$order->ho_client}}&nbsp;{{$order->hp_phone_number}}</h4><br>
                        <h4>{{__('Employer Name:')}}&nbsp;{{$order->hp_employer_name}}</h4><br>
                    </address>
                </div>
                <div class="col-xs-4 text-right">
                    <address>
                        {{--<h3>{{__('Data Of Project')}}</h3><br>--}}
                        <h4>{{__('Project Name:')}}&nbsp;{{$order->hp_project_name}}</h4><br>
                        <h4>{{$order->hp_type_project}}&nbsp;{{__('Type Project:')}}</h4><br>
                        <h4>{{__('Address:')}}&nbsp;{{$state->hp_project_state}}{{$city->hp_city }}&nbsp;{{$order->hp_address}}</h4><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td class="text-left"><h4
                                        style="margin-top:30px;">{{__('Date:')}} {{$data->hop_due_date}}</h4>
                            </td>
                            <td class="text-center"><h1
                                        style="margin-top:70px; margin-right: 150px ; margin-left: 150px">{{__('Pre Invoice Sales Of Product')}}</h1>
                            </td>
                            <td><img align="right" width="170" height="170" src="{{asset('assets/images/g.png')}}"></td>

                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td class="text-center"><strong>{{__('Sub Total')}}</strong></td>
                                <td class="text-center"><strong>{{__('Price')}}</strong></td>
                                <td class="text-center"><strong>{{__('Quantity')}}</strong></td>
                                <td class="text-center"><strong>{{__('Description of Product')}}</strong></td>
                                <td class="text-center"><strong>{{__('Row')}}</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                @foreach($data as $key => $data_loop)
                                    @foreach($product as $products)
                                        @if($products->name == $data_loop->name)
                                            <td class="text-center">{{$data_loop->invoice_items}}</td>
                                            <td class="text-center">{{$products->hp_product_price}}</td>
                                            <td class="text-center">{{$data_loop->invoice_items_qty}}</td>
                                            <td class="text-center">{{$products->hp_product_name . $products->hp_product_model . $products->hp_product_color_id . $products->hp_product_size . $products->hp_product_property . $products->hp_product_code_number}}</td>
                                            <td class="text-center">{{$key + 1}}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <td class="thick-line"></td>
                            </tbody>
                            <table>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-left">{{$data->invoice_items}}</td>
                                    <td class="thick-line text-right"><strong>{{__('Discount')}}</strong></td>

                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-left">{{$data->hpo_total_discount}}</td>
                                    <td class="no-line text-right"><strong>{{__('Total including discount')}}</strong>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-left">{{$data->total}}</td>
                                    <td class="no-line text-right"><strong>{{__('Totals')}}</strong></td>

                                </tr>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



