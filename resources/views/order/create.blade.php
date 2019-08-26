@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
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
                                    {{__('Product')}}
                                </a>
                            </li>
                        </ul>


                        <br>
                        {{--<ul id="myTab" class="nav nav-tabs setting-tab-list" role="tablist">--}}
                        {{--<li role="presentation" class="active">--}}
                        {{--<a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">{{__('Order')}}</a>--}}
                        {{--</li>--}}
                        {{--<li role="presentation">--}}
                        {{--<a href="#tab2" aria-controls="1" role="tab" data-toggle="tab">{{__('Product')}}</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        <form method="post" action="{{route('order.store')}}" id="myTabContent"
                              class="tab-content setting-tab" enctype="multipart/form-data">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Project Name')}}</label>
                                            <input type="text" class="form-control"
                                                   name="hp_project_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Employer Name')}}</label>
                                            <input type="text" class="form-control"
                                                   name="hp_employer_name">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Phone Number')}}</label>
                                            <input type="text" class="form-control"
                                                   name="hp_phone_number">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Connector')}}</label>
                                            <input type="text" class="form-control"
                                                   name="hp_connector">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Register By')}}</label>
                                            <input type="text" class="form-control"
                                                   value="{{auth()->user()->username}}"
                                                   name="hp_registrant">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Project Area')}}</label>
                                            <input type="text" class="form-control"
                                                   name="hp_project_area">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Number Of Units')}}</label>
                                            <input type="text" class="form-control"
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
                                            <textarea type="text" class="form-control" name="hp_address"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<button type="button" class="btn btn-info btn-lg"--}}
                                                    {{--data-toggle="modal"--}}
                                                    {{--data-target="#myModal">{{__('Product Selection')}}</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <a href="{{route('order.index')}}"
                                   class="btn badge-danger">{{__('Back')}}</a>

                                <button type="submit" class="btn badge-primary"
                                >{{__('Send')}}</button>
                                <button type="submit" class="btn btn-primary"
                                        id="preview">{{__('Preview Factor')}}</button>
                                <input type="hidden" name="hp_product_selection" id="hp_product_selection">
                            </div>

                            <div role="tabpanel" class="tab-pane" id="tab2">


                                <table class="table invoice-table product-table" style="direction: ltr">
                                    <thead>
                                    <tr>
                                        <th style="min-width:32px;" class="hide-border"></th>
                                        <th style="min-width:120px;width:25%">Item</th>
                                        <th style="width:100%">Description</th>
                                        <th style="min-width:120px">Unit Cost</th>
                                        <th style="min-width:120px;display:table-cell">Quantity</th>
                                        <th style="min-width:120px;display:none">Discount</th>
                                        <th style="min-width:120px;display:none;"
                                            data-bind="visible: $root.invoice_item_taxes.show">Tax
                                        </th>
                                        <th style="min-width:120px;">Line Total</th>
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
                                                        <select name="name" class="select-item form-control">
                                                            @foreach($product as $product_item)
                                                                <option value="{{$product_item->id}}" data-price="{{$product_item->hp_product_price}}">
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
                                            <input type="text" id="unit" class="form-control"
                                                   name="hp_product_price[]">
                                        </td>
                                        <td style="display:table-cell">
                                            <input id="qty"
                                                   style="text-align: right" class="form-control invoice-item"
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
                                            <div id="total" class="line-total" name="total[]"></div>
                                        </td>
                                        <td style="cursor:pointer" class="hide-border td-icon">
                                            <i style="padding-left:2px;display:none;"
                                               data-bind="click: $parent.removeItem, visible: actionsVisible() &amp;&amp; !isEmpty()"
                                               class="fa fa-minus-circle redlink" title="Remove item">
                                            </i></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{--@endcan--}}
@endsection

@push('scripts')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script>
        $(".select-item").select2({
            theme: "bootstrap"
        });

        $(".select-item").on('change',function(event){

            // event.preventDefault();
            $("#unit").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
            $('#qty').val('1');

            unit_count = $("#unit").val();
            unit_qty = $("#qty").val();
            $('#total').text( unit_count * unit_qty);
            append_item();

        });

        $("#qty").on('change',function (event) {
            unit_count = $("#unit").val();
            unit_qty = $("#qty").val();
            $('#total').text( unit_count * unit_qty);
        })

        $('#send').on('click', function (event) {
            event.preventDefault();
            jsondata = JSON.stringify($('#modal_form').serializeArray());
            $('#hp_product_selection').val(jsondata);
        });

        function append_item() {

                $('.table').append('<tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"\n' +
                    '                                        class="sortable-row ui-sortable-handle" style="">\n' +
                    '                                        <td class="hide-border td-icon">\n' +
                    '                                            <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;\n' +
                    '                $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                                        <select name="name" class="select-item form-control">\n' +
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
                    '                                            <input type="text" id="unit" class="form-control"\n' +
                    '                                                   name="hp_product_price[]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="display:table-cell">\n' +
                    '                                            <input id="qty"\n' +
                    '                                                   style="text-align: right" class="form-control invoice-item"\n' +
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
                    '                                            <div name="total[]" class="line-total"></div>\n' +
                    '                                        </td>\n' +
                    '                                        <td style="cursor:pointer" class="hide-border td-icon">\n' +
                    '                                            <i style="padding-left:2px;display:none;"\n' +
                    '                                               data-bind="click: $parent.removeItem, visible: actionsVisible() &amp;&amp; !isEmpty()"\n' +
                    '                                               class="fa fa-minus-circle redlink" title="Remove item">\n' +
                    '                                            </i></td>\n' +
                    '                                    </tr>');

                $(".select-item").select2({
                    theme: "bootstrap"
                });

               $(".select-item").on('change',function(event){

                   $(this).parent().parent().find("input[name='hp_product_price[]']").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
                   $(this).parent().parent().find("input[name='invoice_items_qty[]']").val('1');
                   // event.preventDefault();

                   unit_count =  $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                   unit_qty = $(this).parent().parent().find("input[name='invoice_items_qty[]']").val();
                  $(this).parent().parent().find("div[name='total[]']").text( unit_count * unit_qty);
                     append_item();
              });
        }
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

        $("#remove").click(function () {
            loc.remove();
        });

        map.on('click', onMapClick);
    </script>
@endpush