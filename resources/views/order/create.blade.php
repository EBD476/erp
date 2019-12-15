@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Add New Order')}}</h4>
                        <p class="card-category"></p>
                        <div class="row pull-left">
                            <div class="col-md-12 pull-left">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{__('Order ID:')}}</label>
                                    <label class="bmd-label-floating" id="order_id_show"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills" style="float: none">
                            <li class="nav-item" style="width: 33.3333%;">
                                <a class="nav-link active" href="#tab1" data-toggle="tab" role="tab">
                                    {{__('Order')}}
                                </a>
                            </li>
                            <li class="nav-item" style="width: 33.3333%;">
                                <a class="nav-link" href="#tab2" data-toggle="tab" role="tab">
                                    {{__('List of Material')}}
                                </a>
                            </li>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <form id="form1"
                                      class="tab-content setting-tab" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Project Name')}}</label>
                                                <input type="text" class="form-control" required=""
                                                       aria-invalid="false" name="hp_project_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Employer Name')}}</label>
                                                <input type="text" class="form-control" required="" aria-invalid="false"
                                                       name="hp_employer_name">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Client Name')}}</label>
                                                <select id="client_name" name="ho_client" class="form-control">
                                                    @foreach($client as $clients)
                                                        <option>{{$clients->hc_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-light">
                                                    <a class="pointer" href="#" data-toggle="modal"
                                                       data-target="#modalRegisterForm">
                                                        {{__('Add New Client')}}</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Connector')}}</label>
                                                <input type="text" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_connector">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Owner User')}}</label>
                                                <select type="text" class="form-control" name="hp_owner_user">
                                                    <option>{{__('Residential')}}</option>
                                                    <option>{{__('Commercial')}}</option>
                                                    <option>{{__('edari')}}</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Phone Number')}}</label>
                                                <input type="number" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_phone_number">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Project Area')}}</label>
                                                <input type="number" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_project_area">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Number Of Units')}}</label>
                                                <input type="number" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_number_of_units">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Type Project')}}</label>
                                                <select class="form-control" name="hp_type_project">
                                                    @foreach($project_type as $type)
                                                        <option>{{$type->hp_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Contract Type')}}</label>
                                                <select class="form-control" type="text"
                                                        name="hp_contract_type">
                                                    <option>
                                                        {{__('Delivery')}}
                                                    </option>
                                                    <option>
                                                        {{__('Install In Place')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('State')}}</label>
                                                <select class="form-control" type="text"
                                                        name="hp_address_state_id">
                                                    @foreach($state as $code)
                                                        <option value="{{$code->id}}">
                                                            {{$code->hp_project_state}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('City')}}</label>
                                                <select class="form-control" type="text"
                                                        name="hp_address_city_id">
                                                    @foreach($address as $city)
                                                        <option value="{{$city->id}}">
                                                            {{$city->hp_city}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Project Location')}}</label>
                                                <div id="map"
                                                     style="width: 100%; height: 300px;direction: ltr;z-index:0"></div>
                                                <input name="hp_project_location" type="hidden"
                                                       id="location" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Address')}}</label>
                                                <textarea type="text" class="form-control" name="hp_address" required=""
                                                          aria-invalid="false"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="tab2" data-lang="{{app()->getLocale()}}">
                                <form id="form2"
                                      class="tab-content setting-tab" enctype="multipart/form-data">
                                    <table class="table invoice-table product-table" style="direction: ltr" id="table2">
                                        <thead>
                                        <tr>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                            <th style="min-width:120px;width:25%">{{__('Item')}}</th>
                                            <th style="width:100%">{{__('Description')}}</th>
                                            <th style="min-width:120px">{{__('Unit Cost')}}</th>
                                            <th style="min-width:120px;display:table-cell">{{__('Quantity')}}</th>
                                            <th style="min-width:120px;display:none">{{__('Discount')}}</th>
                                            <th style="min-width:120px;display:none;"
                                                data-bind="visible: $root.invoice_item_taxes.show">Tax
                                            </th>
                                            <th style="min-width:120px;">{{__('Line Total')}}</th>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody data-bind="sortable: { data: invoice_items_without_tasks, allowDrop: false, afterMove: onDragged} "
                                               class="ui-sortable">
                                        <tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"
                                            class="sortable-row ui-sortable-handle" style="">
                                            <td class="hide-border td-icon">
                                                <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;
                $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>
                                            </td>
                                            <td>
                                                <select name="name[]" class="select-item combobox-container">
                                                    <option value=""></option>
                                                    @foreach($product as $product_item)
                                                        <option value="{{$product_item->id}}"
                                                                data-price="{{$product_item->hp_product_price}}">
                                                            {{$product_item->hp_product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <textarea
                                                        data-bind="value: notes, valueUpdate: 'afterkeydown', attr: {name: 'invoice_items[' + $index() + '][notes]'}"
                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"
                                                        class="form-control word-wrap"
                                                        name="invoice_items[0][notes]"></textarea>

                                            </td>
                                            <td>
                                                <input disabled type="text" id="unit" class="form-control"
                                                       name="hp_product_price[]">
                                            </td>
                                            <td style="display:table-cell">
                                                <input
                                                        style="text-align: right" class="form-control invoice-item qty"
                                                        name="invoice_items_qty[]">
                                            </td>
                                            <td style="display:none">
                                                <input data-bind="value: discount, valueUpdate: 'afterkeydown', attr: {name: 'invoice_items[' + $index() + '][discount]'}"
                                                       style="text-align: right" class="form-control invoice-item"
                                                       name="invoice_items[0][discount]">
                                            </td>
                                            <td style="display:none;"
                                                data-bind="visible: $root.invoice_item_taxes.show">
                                                <select class="form-control"
                                                        data-bind="value: tax1, event:{change:onTax1Change}" id=""
                                                        name="">
                                                    <option value=""></option>
                                                </select>
                                                <input type="text"
                                                       data-bind="value: tax_name1, attr: {name: 'invoice_items[' + $index() + '][tax_name1]'}"
                                                       style="display:none" name="invoice_items[0][tax_name1]">
                                                <input type="text"
                                                       data-bind="value: tax_rate1, attr: {name: 'invoice_items[' + $index() + '][tax_rate1]'}"
                                                       style="display:none" name="invoice_items[0][tax_rate1]">
                                                <div data-bind="visible: $root.invoice().account.enable_second_tax_rate == '1'"
                                                     style="display: none;">
                                                    <select class="form-control tax-select"
                                                            data-bind="value: tax2, event:{change:onTax2Change}" id="-2"
                                                            name="">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <input type="text"
                                                       data-bind="value: tax_name2, attr: {name: 'invoice_items[' + $index() + '][tax_name2]'}"
                                                       style="display:none" name="invoice_items[0][tax_name2]">
                                                <input type="text"
                                                       data-bind="value: tax_rate2, attr: {name: 'invoice_items[' + $index() + '][tax_rate2]'}"
                                                       style="display:none" name="invoice_items[0][tax_rate2]">
                                            </td>
                                            <td style="text-align:right;padding-top:9px !important" nowrap="">
                                                <div class="line-total sub-total" name="total[]"></div>
                                                <input name="price" id="price" type="hidden">
                                            </td>
                                            <td style="cursor:pointer" class="hide-border td-icon">
                                                <i class="tim-icons icon-simple-remove remove" title="Remove item"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    {{--Box2--}}
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Discount')}}
                                                        :</label>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-lg-6 col-sm-6">
                                                                <div class="input-group"><input class="form-control"
                                                                                                {{--data-bind="value: discount, valueUpdate: 'afterkeydown'"--}}
                                                                                                {{--min="0" step="any"--}}
                                                                                                id="discount"
                                                                                                type="number"
                                                                                                name="hpo_discount">
                                                                    {{--<select--}}
                                                                    {{--class="form-control"--}}
                                                                    {{--data-bind="value: is_amount_discount, event:{ change: isAmountDiscountChanged}"--}}
                                                                    {{--id="is_amount_discount">--}}
                                                                    {{--<option--}}
                                                                    {{--id="0" value="0">Percent--}}
                                                                    {{--</option>--}}
                                                                    {{--<option--}}
                                                                    {{--id="1" value="1">Amount--}}
                                                                    {{--</option>--}}
                                                                    {{--</select>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Paid to Date:')}}</label>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-lg-6 col-sm-6">
                                                                <input class="form-control"
                                                                       id="test-date-id"
                                                                       type="text"
                                                                       name="hop_due_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Total:')}}</label>
                                                    <div class="col-md-12 ">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input class="form-control"
                                                                           type="text"
                                                                           name="total"
                                                                           id="total">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Total including discount:')}}</label>
                                                    <div class="col-md-12 ">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input class="form-control"
                                                                           type="text"
                                                                           name="total_discount"
                                                                           id="total_discount">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @role('admin')
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Statuses:')}}</label>
                                                    <div class="col-md-12 ">
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="form-group">

                                                                <select name="hpo_status" class="form-control">
                                                                    @foreach($invoice_statuses as $invoice_status)
                                                                        <option>
                                                                            {{$invoice_status->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endrole
                                            </div>
                                        </div>
                                    </div>
                                    {{--End Box2--}}

                                    {{--Hidden Object--}}
                                    <input type="hidden" id="client_id" name="hpo_client_id">
                                    <input type="hidden" id="order_id" name="hpo_order_id">
                                    {{--End Hidden Object--}}

                                    <a href="{{route('order.index')}}"
                                       class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn btn-primary"
                                            id="btn-submit2">{{__('Send')}}</button>
                                    <button type="submit" class="btn btn-primary"
                                            id="preview">{{__('Preview Factor')}}</button>
                                </form>
                            </div>
                        </div>
                        {{--//client modal//--}}
                        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold">{{__('Add New Client')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" id="modal_form" enctype="multipart/form-data">
                                        <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                                {{--<i class="fas fa-user prefix grey-text"></i>--}}
                                                <label class="bmd-label-floating" data-error="wrong"
                                                       data-success="right"
                                                       for="orangeForm-name">{{__('Name')}}</label>
                                                <input type="text" id="orangeForm-name" class="form-control validate"
                                                       name="hc_name">
                                            </div>
                                            <div class="md-form mb-5">
                                                {{--<i class="fas fa-envelope prefix grey-text"></i>--}}
                                                <label class="bmd-label-floating" data-error="wrong"
                                                       data-success="right">{{__('Phone')}}</label>
                                                <input type="number" required class="form-control validate"
                                                       name="hc_phone">
                                            </div>

                                            <div class="md-form mb-4">
                                                {{--<i class="fas fa-lock prefix grey-text"></i>--}}
                                                <label class="bmd-label-floating" data-error="wrong"
                                                       data-success="right">{{__('Address')}}</label>
                                                <input type="text" class="form-control validate" name="hc_address">
                                            </div>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="submit" class="btn btn-deep-orange">{{__('Send')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--//End client modal//--}}
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{--@endcan--}}
@endsection

@push('scripts')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script>
        var total;
        var discount;
        var total_discount;
        var remove  = 0;

        $(document).ready(function () {
            var client_id;
            var order_id;

            $("#modal_form").submit(function (event) {
                var data = $("#modal_form").serialize();
                event.preventDefault();
                $.blockUI();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                $.ajax({
                    url: '/client',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI);
                        $("#modalRegisterForm").find("input").val("");
                        $("#modalRegisterForm").modal('hide');
                        $("#client_name").append('<option selected>' + data.client_name + '</option>');
                    },
                    cache: false,
                });
            });
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                $.blockUI();
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
                    url: '/order',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        alert(data.response);
                        setTimeout($.unblockUI, 2000);
                        client_id = data.client_id;
                        order_id = data.order_id;
                        $("#order_id").val(order_id);
                        $("#client_id").val(client_id);
                        $("#order_id_show").text(order_id);
                    },
                    cache: false,
                });
            });
            $("#form2").submit(function (event) {
                var data = $("#form2").serialize();
                event.preventDefault();
                $.blockUI();
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
                        alert(data.response);
                        setTimeout($.unblockUI, 2000);
                    },
                    cache: false,
                });
            });

            var locale = $("#tab2").data('lang');

            $(".select-item").select2({
                theme: "bootstrap",
                placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                // allowClear: true

            });
        });


        $(".select-item").on('change', function (event) {
            // event.preventDefault();
            $("#unit").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
            $('.qty').val('1');

            unit_count = $("#unit").val();
            unit_qty = $(".qty").val();
            $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);

            // $('#total').text(unit_count * unit_qty);

            $('.sub-total').each(function () {

                total = $(this).text();
                if (total != "") {
                    $("#total").val(total);
                    $("#price").val(total);
                }

            });
            append_item();

            $(".qty").on('change', function (event) {
                unit_qty = $(this).val();
                $('#total').text(1000 * unit_qty);

                total = 0;
                $('.sub-total').each(function () {

                    current = $(this).text();
                    if (current != "") {
                        total = total + parseInt(current);
                        $("#total").val(total);
                    }

                });
            });

            $("#discount").on('change', function (event) {
                discount = $(this).val();
                total_discount = parseInt(discount) * parseInt(total) / 100;
                $('#total_discount').val(parseInt(total) - parseInt(total_discount));
            })

            function append_item() {

                $('.table').append('<tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"\n' +
                    '                                        class="sortable-row ui-sortable-handle" style="">\n' +
                    '                                        <td class="hide-border td-icon">\n' +
                    '                                            <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;\n' +
                    '                $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                                        <select name="name[]" class="select-item combobox-container">\n' +
                    '                                                            <option value=""></option>' +
                    '                                                            @foreach($product as $product_item)\n' +
                    '                                                                <option value="{{$product_item->id}}" data-price="{{$product_item->hp_product_price}}">\n' +
                    '                                                                    {{$product_item->hp_product_name }}\n' +
                    '                                                                </option>\n' +
                    '                                                            @endforeach\n' +
                    '                                                        </select>\n' +
                    '\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                                <textarea\n' +
                    '                                                        data-bind="value: notes, valueUpdate: \'afterkeydown\', attr: {name: \'invoice_items[\' + $index() + \'][notes]\'}"\n' +
                    '                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"\n' +
                    '                                                        class="form-control word-wrap"\n' +
                    '                                                        name="invoice_items[0][notes]"></textarea>\n' +
                    '\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                            <input disabled type="text" id="unit" class="form-control"\n' +
                    '                                                   name="hp_product_price[]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="display:table-cell">\n' +
                    '                                            <input \n' +
                    '                                                   style="text-align: right" class="form-control invoice-item qty"\n' +
                    '                                                   name="invoice_items_qty[]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="display:none">\n' +
                    '                                            <input data-bind="value: discount, valueUpdate: \'afterkeydown\', attr: {name: \'invoice_items[\' + $index() + \'][discount]\'}"\n' +
                    '                                                   style="text-align: right" class="form-control invoice-item"\n' +
                    '                                                   name="invoice_items[0][discount]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="display:none;"\n' +
                    '                                            data-bind="visible: $root.invoice_item_taxes.show">\n' +
                    '                                            <select class="form-control"\n' +
                    '                                                    data-bind="value: tax1, event:{change:onTax1Change}" id=""\n' +
                    '                                                    name="">\n' +
                    '                                                <option value=""></option>\n' +
                    '                                            </select>\n' +
                    '                                            <input type="text"\n' +
                    '                                                   data-bind="value: tax_name1, attr: {name: \'invoice_items[\' + $index() + \'][tax_name1]\'}"\n' +
                    '                                                   style="display:none" name="invoice_items[0][tax_name1]">\n' +
                    '                                            <input type="text"\n' +
                    '                                                   data-bind="value: tax_rate1, attr: {name: \'invoice_items[\' + $index() + \'][tax_rate1]\'}"\n' +
                    '                                                   style="display:none" name="invoice_items[0][tax_rate1]">\n' +
                    '                                            <div data-bind="visible: $root.invoice().account.enable_second_tax_rate == \'1\'"\n' +
                    '                                                 style="display: none;">\n' +
                    '                                                <select class="form-control tax-select"\n' +
                    '                                                        data-bind="value: tax2, event:{change:onTax2Change}" id="-2"\n' +
                    '                                                        name="">\n' +
                    '                                                    <option value=""></option>\n' +
                    '                                                </select>\n' +
                    '                                            </div>\n' +
                    '                                            <input type="text"\n' +
                    '                                                   data-bind="value: tax_name2, attr: {name: \'invoice_items[\' + $index() + \'][tax_name2]\'}"\n' +
                    '                                                   style="display:none" name="invoice_items[0][tax_name2]">\n' +
                    '                                            <input type="text"\n' +
                    '                                                   data-bind="value: tax_rate2, attr: {name: \'invoice_items[\' + $index() + \'][tax_rate2]\'}"\n' +
                    '                                                   style="display:none" name="invoice_items[0][tax_rate2]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="text-align:right;padding-top:9px !important" nowrap="">\n' +
                    '                                            <div name="total[]" class="line-total sub-total"></div>\n' +
                    '                                        </td>\n' +
                    '                                        <td style="cursor:pointer" class="hide-border td-icon">\n' +
                    '                                            <i \n' +
                    '                                               \n' +
                    '                                               class="tim-icons icon-simple-remove remove"  title="Remove item">\n' +
                    '                                            </i></td>\n' +
                    '                                    </tr>');


                var locale = $("#tab2").data('lang');

                $(".select-item").select2({
                    theme: "bootstrap",
                    placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                    // allowClear: true

                });


                $(".remove").click(function () {


                    // alert(3)


                    var rowCount = $('#table2 tr').length;
                    if (rowCount > 2) {
                        // $('.sub-total').each(function () {
                        //     current = $(this).text();
                        //     if (current != "") {
                        //         total = total - parseInt(current);
                        //         $("#total").val(total);
                        //     }
                        // });



                        if (remove == 0) {
                            total = total - parseInt($(this).parent().parent().find('.sub-total').text());
                            $("#total").val(total);
                            remove += 1;

                        }
                         $(this).parent().parent().remove();
                        remove = 0;

                    }
                });

                $(".select-item").on('change', function (event) {

                    $(this).parent().parent().find("input[name='hp_product_price[]']").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
                    $(this).parent().parent().find("input[name='invoice_items_qty[]']").val('1');
                    // event.preventDefault();

                    unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                    unit_qty = $(this).parent().parent().find("input[name='invoice_items_qty[]']").val();
                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);


                    append_item();
                });

                total = 0;
                $('.sub-total').each(function () {

                    current = $(this).text();
                    if (current != "") {
                        total = total + parseInt(current);
                        $("#total").val(total);
                    }
                });

                $(".qty").on('change', function (event) {

                    unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                    unit_qty = $(this).val();
                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);

                    total = 0;
                    $('.sub-total').each(function () {

                        current = $(this).text();
                        if (current != "") {
                            total = total + parseInt(current);
                            $("#total").val(total);
                        }
                    });

                });

            }
        });


    </script>
    <script>
        $('#preview').on('click', function () {
            $('#form1').attr('action', '{{route('order.preview')}}');
        })
    </script>
    <script type="text/javascript">
        var loc;
        var greenIcon = L.icon({
            iconUrl: '../../assets/images/marker-icon-x48.png',
            shadowUrl: 'leaf-shadow.png',

            iconSize: [48, 48], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [25, 44], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var map = L.map('map').setView([35.7736, 51.4631], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        function onMapClick(e) {

            var jsonLoc = JSON.parse(JSON.stringify(e.latlng));
            $("#location").val(jsonLoc.lat + ',' + jsonLoc.lng);

            if (loc != undefined) {
                loc.remove();
            }
            loc = L.marker([jsonLoc.lat, jsonLoc.lng], {icon: greenIcon}).addTo(map);
        }

        $(".remove").click(function () {
            var rowCount = $('#table2 tr').length;
            if (rowCount > 2) {
                $('.sub-total').each(function () {
                    current = $(this).text();
                    if (current != "") {
                        total = total - parseInt(current);
                        $("#total").val(total);
                    }
                });
                $(this).parent().parent().remove();
            }
        });


        map.on('click', onMapClick);
    </script>
    {{--datapicker--}}
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
@endpush