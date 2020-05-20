@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|order')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Order')}}&nbsp;{{$project->hp_employer_name}}</h4>
                        <p class="card-category"></p>
                        <div class="row pull-left">
                            <div class="col-md-12 pull-left">
                                <div class="form-group">
                                    <input id="hpo_order_id" value="{{$project->id}}" type="hidden">
                                    <label class="bmd-label-floating">{{__('Order ID:')}}</label>
                                    <label class="bmd-label-floating" id="order_id_show" data-id="{{$project->id}}"
                                           data-client="{{$project->ho_client}}">{{$project->id}}</label>
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
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Project Name')}}</label>
                                                <input type="text" class="form-control" required=""
                                                       aria-invalid="false" name="hp_project_name" id="hp_project_name"
                                                       data-id="{{$project->id}}" value="{{$project->hp_project_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Employer Name')}}</label>
                                                <input type="text" class="form-control" required="" aria-invalid="false"
                                                       name="hp_employer_name" id="hp_employer_name"
                                                       value="{{$project->hp_employer_name}}">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="margin-top: -20px"
                                                       class="bmd-label-floating">{{__('Client Name')}}</label>
                                                <select class="select-client form-control" name="ho_client"
                                                        id="ho_client">
                                                    <option value="{{$client->id}}">
                                                        {{$client->hc_name}}
                                                    </option>
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
                                                       name="hp_connector" id="hp_connector"
                                                       value="{{$project->hp_connector}}">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Owner User')}}</label>
                                                <select type="text" class="form-control" name="hp_owner_user"
                                                        id="hp_owner_user">
                                                    <option>{{$project->hp_owner_user}}</option>
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
                                                       name="hp_phone_number" id="hp_phone_number"
                                                       value="{{$project->hp_phone_number}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Project Area')}}</label>
                                                <input type="number" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_project_area" id="hp_project_area"
                                                       value="{{$project->hp_project_area}}">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Number Of Units')}}</label>
                                                <input type="number" class="form-control" required=""
                                                       aria-invalid="false"
                                                       name="hp_number_of_units" id="hp_number_of_units"
                                                       value="{{$project->hp_number_of_units}}">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Type Project')}}</label>
                                                <select class="form-control" name="hp_type_project"
                                                        id="hp_type_project">
                                                    <option>{{$project->hp_type_project}}</option>
                                                    @foreach($project_type as $type_project)
                                                        <option>{{$type_project->hp_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Contract Type')}}</label>
                                                <select class="form-control" type="text"
                                                        name="hp_contract_type" id="hp_contract_type">
                                                    <option>
                                                        {{$project->hp_contract_type}}
                                                    </option>
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
                                                <label class="bmd-label-floating"
                                                       style="margin-top: -20px">{{__('State')}}</label>
                                                <select class="select-state form-control" type="text"
                                                        name="hp_address_state_id" id="hp_address_state_id">
                                                    <option value="{{$invoice_state->id}}">
                                                        {{$invoice_state->hp_project_state}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"
                                                       style="margin-top: -20px">{{__('City')}}</label>
                                                <select class="select-city form-control" type="text"
                                                        name="hp_address_city_id" id="hp_address_city_id">
                                                    <option value="{{$invoice_city->id}}">
                                                        {{$invoice_city->hp_city}}
                                                    </option>
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
                                                <textarea type="text" class="form-control" id="hp_address"
                                                          name="hp_address" required=""
                                                          aria-invalid="false"
                                                >{{$project->hp_address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="tab2" data-lang="{{app()->getLocale()}}">
                                <form id="form2"
                                      class="tab-content setting-tab" enctype="multipart/form-data">
                                    <table class="table invoice-table product-table" style="direction: rtl" id="table2">
                                        <thead>
                                        <tr>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                            <th></th>
                                            <th style="min-width:120px;width:25%">{{__('Item')}}</th>
                                            <th style="width:100%">{{__('Description')}}</th>
                                            <th style="min-width:120px">{{__('Unit Cost')}}</th>
                                            <th style="min-width:120px;display:table-cell">{{__('Quantity')}}</th>
                                            <th style="min-width:120px;display:none">{{__('Discount')}}</th>
                                            <th style="min-width:120px;">{{__('Line Total')}}</th>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody data-bind="sortable: { data: invoice_items_without_tasks, allowDrop: false, afterMove: onDragged} "
                                               class="ui-sortable">
                                        @foreach($invoices_items as $invoices_item)
                                            <tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"
                                                class="sortable-row ui-sortable-handle" style="">
                                                <td class="hide-border td-icon">
                                                    <i style="display:none" class="fa fa-sort"></i>
                                                </td>
                                                <td style="cursor:pointer" class="hide-border td-icon">
                                                    <i class="tim-icons icon-simple-remove remove"
                                                       title="Remove item"/>
                                                </td>
                                                <td>
                                                    <input name="pid[]" value="{{$invoices_item->id}}" type="hidden">
                                                    <select name="name[]"
                                                            class="select-item combobox-container name"
                                                            data-id="{{$invoices_item->id}}">
                                                        @foreach($product as $product_selected)
                                                            @if($product_selected->id == $invoices_item->hpo_product_id)
                                                                <option value="{{$product_selected->id}}">{{$product_selected->hp_product_name}}</option>
                                                            @endif
                                                        @endforeach
                                                        @foreach($product as $product_item)
                                                            <option value="{{$product_item->id}}"
                                                                    data-price="{{$product_item->hp_product_price}}">
                                                                {{$product_item->hp_product_name . $product_item->hp_product_model . $product_item->hp_product_size}}
                                                                @foreach($color as $colors)
                                                                    @if($colors->id == $product_item->hp_product_color_id)
                                                                        {{$colors->hn_color_name}}
                                                                    @endif
                                                                @endforeach
                                                                @foreach($properties as $property)
                                                                    @if($property->id== $product_item->hp_product_property)
                                                                        {{$property->hpp_property_name}}
                                                                        @foreach ($items as $item)
                                                                            @if($item->id == $property->hpp_property_items)
                                                                                {{$item->hppi_items_name}}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                <textarea
                                                        data-bind="value: notes, valueUpdate: 'afterkeydown', attr: {name: 'invoice_items[]'}"
                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"
                                                        class="form-control word-wrap invoice_items"
                                                        name="invoice_items[]">{{$invoices_item->hpo_description}}</textarea>
                                                </td>
                                                <td>
                                                    @foreach($product as $product_item_price)
                                                        @if($invoices_item->hpo_product_id == $product_item_price->id)
                                                            <input disabled type="text"
                                                                   class="form-control unit"
                                                                   name="hp_product_price[]"
                                                                   value="{{$product_item_price->hp_product_price}}">
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display:table-cell">
                                                    <input
                                                            style="text-align: right"
                                                            class="form-control invoice_items qty"
                                                            name="invoice_items_qty[]"
                                                            value="{{$invoices_item->hpo_count}}">
                                                </td>
                                                <td style="text-align:right;padding-top:9px !important" nowrap="">
                                                    <div class="line-total sub-total"
                                                         name="total[]">{{$invoices_item->hpo_total}}</div>
                                                    <input name="total[]" class="sub-total" type="hidden"
                                                           value="{{$invoices_item->hpo_total}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tbody data-bind="sortable: { data: invoice_items_without_tasks, allowDrop: false, afterMove: onDragged} "
                                               class="ui-sortable">

                                        <tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"
                                            class="sortable-row ui-sortable-handle" style="">
                                            <td class="hide-border td-icon">
                                                <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;
                $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>
                                            </td>
                                            <td><i class="tim-icons icon-simple-add" id="add-row"
                                                   title="Add item"></i></td>
                                            <td>
                                                <input name="pid[]" id="pid-new" type="hidden">
                                                <select name="name[]" class="select-item combobox-container">
                                                </select>

                                            </td>
                                            <td>
                                                <textarea
                                                        data-bind="value: notes, valueUpdate: 'afterkeydown', attr: {name: 'invoice_items[]'}"
                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"
                                                        class="form-control word-wrap"
                                                        name="invoice_items[]"></textarea>
                                            </td>
                                            <td>
                                                <input id="unit" disabled type="text" class="form-control unit"
                                                       name="hp_product_price[]">
                                                <input name="price" id="price" type="hidden">
                                            </td>
                                            <td style="display:table-cell">
                                                <input
                                                        style="text-align: right" class="form-control invoice-item qty"
                                                        id="qty"
                                                        name="invoice_items_qty[]">
                                            </td>
                                            <td style="text-align:right;padding-top:9px !important" nowrap="">
                                                <div class="line-total sub-total" name="total[]"></div>
                                                <input name="total[]" class="sub-total" type="hidden">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if($project->hp_total_all != "")
                                        {{--Box2--}}
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    @role('Admin')
                                                    <div class="row">
                                                        <label class="bmd-label-floating">{{__('Paid to Date:')}}</label>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input class="form-control"
                                                                           id="test-date-id"
                                                                           type="text"
                                                                           name="hop_due_date"
                                                                           value="{{$items_all->hop_due_date}}"
                                                                    >
                                                                    &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endrole

                                                    <div class="row">
                                                        <label class="bmd-label-floating">{{__('Total:')}}</label>
                                                        <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <input disabled class="form-control"
                                                                               id="all_total"
                                                                               type="text"
                                                                               name="all_total"
                                                                               value="{{$project->hp_total_all}}"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if($project->hp_discount != "")
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Discount')}}
                                                                :</label>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <div class="input-group"><input
                                                                                    class="form-control"
                                                                                    id="discount"
                                                                                    type="number"
                                                                                    name="hpo_discount"
                                                                                    value="{{$project->hp_discount}}">
                                                                            &nbsp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Total Including Discount:')}}</label>
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-6 col-sm-6">
                                                                            <input disabled class="form-control"
                                                                                   id="total_discount"
                                                                                   type="text"
                                                                                   name="total_discount"
                                                                                   value="{{$project->hp_total_discount}}"
                                                                            >
                                                                            <div class="small">
                                                                                <h20>{{$tax->hpx_tax}}
                                                                                    .{{__('% VAT rate is calculated')}}</h20>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Discount')}}
                                                                :</label>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <div class="input-group"><input
                                                                                    class="form-control"
                                                                                    id="discount"
                                                                                    type="number"
                                                                                    name="hpo_discount">
                                                                            &nbsp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Total Including Discount:')}}</label>
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-6 col-sm-6">
                                                                            <input disabled class="form-control"
                                                                                   id="total_discount"
                                                                                   type="text"
                                                                                   name="total_discount">
                                                                            &nbsp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{--End Box2--}}

                                        {{--Hidden Object--}}
                                        <input type="hidden" id="client_id" name="hpo_client_id"
                                               value="{{$project->ho_client}}">
                                        <input type="hidden" id="order_id" name="hpo_order_id" value="{{$project->id}}">
                                        <input id="all_dis" name="all_dis" type="hidden"
                                               value="{{$project->hp_total_discount}}">
                                        <input id="all_tot" name="all_tot" type="hidden"
                                               value="{{$project->hp_total_all}}">
                                        {{--End Hidden Object--}}
                                    @else
                                        {{--Box2--}}
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    @role('Admin')
                                                    <div class="row">
                                                        <label class="bmd-label-floating">{{__('Paid to Date:')}}</label>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input class="form-control"
                                                                           id="test-date-id"
                                                                           type="text"
                                                                           name="hop_due_date">
                                                                    &nbsp
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endrole
                                                    </div>
                                                    <div class="row">
                                                        <label class="bmd-label-floating">{{__('Total:')}}</label>
                                                        <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <input disabled class="form-control"
                                                                               id="all_total"
                                                                               type="text"
                                                                               name="all_total">
                                                                        &nbsp
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($project->hp_discount != "")
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Discount')}}
                                                                :</label>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <div class="input-group"><input
                                                                                    class="form-control"
                                                                                    id="discount"
                                                                                    type="number"
                                                                                    name="hpo_discount"
                                                                                    value="{{$project->hp_discount}}">
                                                                            &nbsp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Total Including Discount:')}}</label>
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-6 col-sm-6">
                                                                            <input disabled class="form-control"
                                                                                   id="total_discount"
                                                                                   type="text"
                                                                                   name="total_discount"
                                                                                   value="{{$project->hp_total_discount}}"
                                                                            >
                                                                            <div class="small">
                                                                                <h20>{{$tax->hpx_tax}}
                                                                                    .{{__('% VAT rate is calculated')}}</h20>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Discount')}}
                                                                :</label>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="col-lg-6 col-sm-6">
                                                                        <div class="input-group"><input
                                                                                    class="form-control"
                                                                                    id="discount"
                                                                                    type="number"
                                                                                    name="hpo_discount">
                                                                            &nbsp
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="bmd-label-floating">{{__('Total Including Discount:')}}</label>
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-6 col-sm-6">
                                                                            <input disabled class="form-control"
                                                                                   id="total_discount"
                                                                                   type="text"
                                                                                   name="total_discount">
                                                                            <div class="small">
                                                                                <h20>{{$tax->hpx_tax}}
                                                                                    .{{__('% VAT rate is calculated')}}</h20>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{--@role('admin')--}}
                                                    {{--<div class="row">--}}
                                                    {{--<label class="bmd-label-floating">{{__('Statuses:')}}</label>--}}
                                                    {{--<div class="col-md-12 ">--}}
                                                    {{--<div class="col-lg-6 col-sm-6">--}}
                                                    {{--<div class="form-group">--}}

                                                    {{--<select name="hpo_status" class="form-control">--}}
                                                    {{--@foreach($invoice_statuses as $invoice_status)--}}
                                                    {{--<option>--}}
                                                    {{--{{$invoice_status->name}}--}}
                                                    {{--</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--@endrole--}}
                                                </div>
                                            </div>
                                        </div>
                                        {{--End Box2--}}

                                        {{--Hidden Object--}}
                                        <input type="hidden" id="client_id" name="hpo_client_id">
                                        <input type="hidden" id="order_id" name="hpo_order_id" value="{{$project->id}}">
                                        <input id="all_dis" name="all_dis" type="hidden">
                                        <input id="all_tot" name="all_tot" type="hidden">
                                        {{--End Hidden Object--}}
                                    @endif
                                    <div class="col-md-12">
                                        <a href="{{route('order.index')}}"
                                           class="btn btn-primary">{{__('Back')}}</a>
                                        <button id="btn_submit" type="submit"
                                                class="btn btn-primary">{{__('Send Modify')}}</button>
                                        {{--<button type="submit" class="btn btn-primary"--}}
                                        {{--id="preview">{{__('Preview Factor')}}</button>--}}
                                    </div>
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
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>

    <script>
        var total;
        var discount;
        var total_discount;
        var remove = 0;
        var product_array = new Array();

        $(document).ready(function () {
            var client_id;
            var order_id;

            // push current items in array
            $('.remove').each(function () {
                // push all items
                product_array.push(parseInt($(this).parent().parent().find("select[name='name[]']").val()));
                // end
            });
            // end

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
                var data = {
                    id: $("#hp_project_name").data('id'),
                    hp_project_name: $("#hp_project_name").val(),
                    hp_employer_name: $("#hp_employer_name").val(),
                    ho_client: $("#ho_client").val(),
                    hp_connector: $("#hp_connector").val(),
                    hp_owner_user: $("#hp_owner_user").val(),
                    hp_phone_number: $("#hp_phone_number").val(),
                    hp_project_area: $("#hp_project_area").val(),
                    hp_number_of_units: $("#hp_number_of_units").val(),
                    hp_type_project: $("#hp_type_project").val(),
                    hp_contract_type: $("#hp_contract_type").val(),
                    hp_address_state_id: $("#hp_address_state_id").val(),
                    hp_address_city_id: $("#hp_address_city_id").val(),
                    hp_address: $("#hp_address").val(),
                    hp_project_location: $("#location").val(),
                }
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
                    url: '/order/' + data.id,
                    type: 'POST',
                    data: data,
                    method: 'put',
                    dataType: 'json',
                    async: false,
                    success: function (data) {
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

            $("#btn_submit").on('click', function (event) {
                var data = $("#form2").serialize();
                var hpo_order_id = $("#hpo_order_id").val();
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
                    url: '/order_product/' + hpo_order_id,
                    type: 'POST',
                    method: 'put',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                    },
                    cache: false,
                });
            });

            var locale = $("#tab2").data('lang');

            $(".select-client").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-client-data',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                placeholder: (locale == 'fa' ? 'انتخاب مشتری' : 'Select Client'),
            });

            $(".select-city").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-city',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                placeholder: (locale == 'fa' ? 'انتخاب شهر' : 'Select City'),
            });

            $(".select-state").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-state',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                placeholder: (locale == 'fa' ? 'انتخاب استان' : 'Select State'),
            });

            $(".select-item").select2({
                ajax: {
                    url: '/json-data-fill-data-product',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        }
                    }
                },
                theme: "bootstrap",
                dir: 'rtl',
                left: '1142px',
                width: '340.667px',
                placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
// allowClear: true

            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/products/" + repo.hp_product_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    // "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
                    // "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
                    // "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Price')}}" + " : " + repo.hp_product_price);
                $container.find(".select2-result-repository__color").text("{{__('Color')}}" + " : " + repo.hn_color_name);
                $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.hpp_property_name + repo.hppi_items_name);
// $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
// $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
// $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.text;
            }

            $(".select-item").on('select2:select', function (event) {

                var result = event.params.data;

                // push data id for limitation select to

                if (product_array.indexOf(result.id) == -1) {

                    product_array.push(result.id);


                    $("#unit").val(result.hp_product_price);
                    $('#qty').val('1');
                    unit_count = $("#unit").val();
                    unit_qty = $("#qty").val();
                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                    $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);
                    var all_total_val = $("#all_total").val();

                    $('.sub-total').each(function () {

                        total = $(this).text();
                        if (total != "") {

                            $("#all_total").val(parseInt(total) + parseInt(all_total_val));
                            $("#all_total").text(parseInt(total) + parseInt(all_total_val));
                            $("#all_tot").val(parseInt(total) + parseInt(all_total_val));
                            discount = $("#discount").val();
                            total = $("#all_total").val();
                            if (discount != "") {
                                total_discount = parseInt(discount) * parseInt(total) / 100;
                                $("#all_dis").val(parseInt(total) - parseInt(total_discount));
                                $("#total_discount").val(parseInt(total) - parseInt(total_discount));
                                $("#total_discount").text(parseInt(total) - parseInt(total_discount));
                            }
                        }

                    });

                    $(".qty").on('change', function (event) {
                        unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                        unit_qty = $(this).val();
                        $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                        $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);
                        discount = $("#discount").val();
                        total = $("#all_total").val();
                        if (discount != "") {
                            total_discount = parseInt(discount) * parseInt(total) / 100;
                            $("#all_dis").val(parseInt(total) - parseInt(total_discount))
                            $("#total_discount").val(parseInt(total) - parseInt(total_discount))
                            $("#total_discount").text(parseInt(total) - parseInt(total_discount))
                        }
                        total = 0;
                        $('.sub-total').each(function () {

                            current = $(this).text();
                            if (current != "") {
                                total = total + parseInt(current);
                                $("#all_total").val(total);
                                $("#all_total").text(total);
                            }
                        });

                    });

                    $("#discount").on('change', function (event) {
                        total = $('#all_total').val();
                        discount = $(this).val();
                        total_discount = parseInt(discount) * parseInt(total) / 100;
                        $('#all_dis').val(parseInt(total) - parseInt(total_discount));
                        $('#total_discount').val(parseInt(total) - parseInt(total_discount));
                        $('#total_discount').text(parseInt(total) - parseInt(total_discount));
                    })
                    // first row on table 2
                    $("#add-row").on('click', function (event) {
                        if ($(this).hasClass('icon-simple-add')) {
                            append_item();
                            $(this).removeClass('icon-simple-add');
                        }
                        $(this).addClass('icon-simple-remove');
                        if ($(this).hasClass('icon-simple-remove')) {
                            //remove item operations
                            $("#add-row").click(function (event) {
                                var rowCount = $('#table2 tr').length;
                                if (rowCount > 2) {
                                    if ($(this).parent().parent().find("div[name='total[]']").text() != "") {
                                        var all = $("#all_total").val();
                                        var total_each = parseInt(all) - parseInt($(this).parent().parent().find("div[name='total[]']").text());

                                        $('#all_total').val(total_each);
                                        $('#all_tot').val(total_each);

                                        if ($('#discount').val() != "") {
                                            var total1 = $('#all_total').val();
                                            discount = $('#discount').val();
                                            total_discount = parseInt(discount) * parseInt(total1) / 100;
                                            $('#total_dis').val(parseInt(total1) - parseInt(total_discount));
                                            $('#total_discount').val(parseInt(total1) - parseInt(total_discount));
                                            $('#total_discount').text(parseInt(total1) - parseInt(total_discount));
                                        }
                                    }

                                    var data = {
                                        id: $('#pid-new').val(),
                                    }
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $.ajax({
                                        url: '/order_product/' + data.id,
                                        type: 'delete',
                                        data: data,
                                        dataType: 'json',
                                        async: false,
                                        success: function (data) {
                                        },
                                        cache: false,
                                    });

                                    // pop items from no repeat array
                                    product_array.splice(product_array.indexOf(parseInt($(this).parent().parent().find("select[name='name[]']").val())), 1, 0);
                                    $(this).parent().parent().remove();
                                    remove = 0;
                                }
                            })
                        }
                    });
                    // end

                    // store new row
                    var data = {
                        name: $(this).parent().parent().find("select[name='name[]']").val(),
                        total: $(this).parent().parent().find('.sub-total').text(),
                        hpo_order_id: $("#order_id").val(),
                        // hpo_client_id: $("#order_id_show").data('client'),
                        hop_due_date: $("#test-date-id").val(),
                        hpo_discount: $("#discount").val(),
                        all_tot: $("#all_total").val(),
                        all_dis: $("#total_discount").val(),
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/add-product',
                        type: 'Post',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            $('#pid-new').val(data.pid);
                        },
                        cache: false,
                    });

                    // end

                    function append_item() {

                        $('.table').append('<tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"\n' +
                            '                                        class="sortable-row ui-sortable-handle" style="">\n' +
                            '                                        <td class="hide-border td-icon">\n' +
                            '                                            <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;\n' +
                            '                $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>\n' +
                            '                                        </td>\n' +
                            '                      <td> <i class="tim-icons icon-simple-add" id="add-row' + $("#table2 tr").length + '" title="Add item"/></td>\n' +
                            '                                        <td>\n' +
                            '                                                       <input name="pid[]" id="pid-new' + $("#table2 tr").length + '" type="hidden">\n' +
                            '                                                       <select name="name[]" class="select-item combobox-container">\n' +
                            '                                                        </select>\n' +
                            '                                        </td>\n' +
                            '                                        <td>\n' +
                            '                                                <textarea\n' +
                            '                                                        data-bind="value: notes, valueUpdate: \'afterkeydown\', attr: {name: \'invoice_items[]\'}"\n' +
                            '                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"\n' +
                            '                                                        class="form-control word-wrap"\n' +
                            '                                                        name="invoice_items[]"></textarea>\n' +
                            '                                        </td>\n' +
                            '                                        <td>\n' +
                            '                                            <input disabled type="text"  class="form-control unit"\n' +
                            '                                                   name="hp_product_price[]">\n' +
                            '                                        </td>\n' +
                            '                                        <td style="display:table-cell">\n' +
                            '                                            <input \n' +
                            '                                                   style="text-align: right" class="form-control invoice-item qty"\n' +
                            '                                                   name="invoice_items_qty[]">\n' +
                            '                                        </td>\n' +
                            '                                        <td style="text-align:right;padding-top:9px !important" nowrap="">\n' +
                            '                                            <div name="total[]" class="line-total sub-total"></div>\n' +
                            '                                            <input name="total[]"class="sub-total" type="hidden">\n' +
                            '                                        </td>\n' +
                            '                                        <td style="cursor:pointer" class="hide-border td-icon">\n' +
                            '                                    </tr>'
                        )
                        ;

                        var locale = $("#tab2").data('lang');

                        $(".select-item").select2({
                            ajax: {
                                url: '/json-data-fill-data-product',
                                dataType: 'json',
                                data: function (params) {
                                    return {
                                        search: params.term, // search term
                                        page: params.page
                                    };
                                },
                                processResults: function (data) {
                                    return {
                                        results: data.results
                                    }
                                }
                            },
                            theme: "bootstrap",
                            dir: 'rtl',
                            left: '1142px',
                            width: '340.667px',
                            placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                            templateResult: formatRepo,
                            templateSelection: formatRepoSelection
// allowClear: true

                        });

                        function formatRepo(repo) {

                            if (repo.loading) {
                                return repo.text;
                            }

                            var $container = $(
                                "<div class='select2-result-repository clearfix'>" +
                                "<div class='select2-result-repository__avatar'><img src='/img/products/" + repo.hp_product_image + "' /></div>" +
                                "<div class='select2-result-repository__meta'>" +
                                "<div class='select2-result-repository__title'></div>" +
                                "<div class='select2-result-repository__description'></div>" +
                                "<div class='select2-result-repository__color'></div>" +
                                "<div class='select2-result-repository__statistics'>" +
                                // "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
                                // "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
                                // "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
                                "</div>" +
                                "</div>" +
                                "</div>"
                            );

                            $container.find(".select2-result-repository__title").text(repo.text);
                            $container.find(".select2-result-repository__description").text("{{__('Price')}}" + " : " + repo.hp_product_price);
                            $container.find(".select2-result-repository__color").text("{{__('Color')}}" + " : " + repo.hn_color_name);
                            $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.hpp_property_name + repo.hppi_items_name);
                            return $container;
                        }

                        function formatRepoSelection(repo) {
                            return repo.text;
                        }

                        $(".select-item").on('select2:select', function (event) {

                            var result = event.params.data;

                            // push data id for limitation select to
                            if (product_array.indexOf(result.id) == -1) {

                                product_array.push(result.id);

                                $(this).parent().parent().find("input[name='hp_product_price[]']").val(result.hp_product_price);
                                $(this).parent().parent().find("input[name='invoice_items_qty[]']").val('1');


                                unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                                unit_qty = $(this).parent().parent().find("input[name='invoice_items_qty[]']").val();
                                $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                                $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);

                                total = 0;
                                $('.sub-total').each(function () {

                                    current = $(this).text();
                                    if (current != "") {
                                        total = total + parseInt(current);
                                        $("#all_tot").val(total);
                                        $("#all_total").val(total);
                                        $("#all_total").text(total);
                                        if ($('#discount').val() != "") {
                                            total1 = $('#all_total').val();
                                            discount = $('#discount').val();
                                            total_discount = parseInt(discount) * parseInt(total1) / 100;
                                            $('#all_dis').val(parseInt(total1) - parseInt(total_discount));
                                            $('#total_discount').val(parseInt(total1) - parseInt(total_discount));
                                            $('#total_discount').text(parseInt(total1) - parseInt(total_discount));
                                        }
                                    }
                                });

                                $(".qty").on('change', function (event) {

                                    unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                                    unit_qty = $(this).val();
                                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                                    $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);
                                    discount = $("#discount").val();
                                    total = $("#all_total").val();
                                    if (discount != "") {
                                        total_discount = parseInt(discount) * parseInt(total) / 100;
                                        $("#all_dis").val(parseInt(total) - parseInt(total_discount))
                                        $("#total_discount").val(parseInt(total) - parseInt(total_discount))
                                        $("#total_discount").text(parseInt(total) - parseInt(total_discount))
                                    }
                                    total = 0;
                                    $('.sub-total').each(function () {

                                        current = $(this).text();
                                        if (current != "") {
                                            total = total + parseInt(current);
                                            $("#all_tot").val(total);
                                            $("#all_total").val(total);
                                            $("#all_total").text(total);
                                        }
                                    });

                                });

                                $("#discount").on('change', function (event) {
                                    discount = $(this).val();
                                    total_discount = parseInt(discount) * parseInt(total) / 100;
                                    $('#all_dis').val(parseInt(total) - parseInt(total_discount));
                                    $('#total_discount').val(parseInt(total) - parseInt(total_discount));
                                    $('#total_discount').text(parseInt(total) - parseInt(total_discount));
                                });

                                $("#add-row" + parseInt($("#table2 tr").length - 1)).on('click', function (event) {

                                    if ($(this).hasClass('icon-simple-add')) {
                                        append_item();
                                        $(this).removeClass('icon-simple-add');
                                        $(this).addClass('icon-simple-remove');
                                    }

                                    if ($(this).hasClass('icon-simple-remove')) {
                                        //remove item operations
                                        $(this).click(function (event) {

                                            var rowCount = $('#table2 tr').length;

                                            if (rowCount > 2) {

                                                if ($(this).parent().parent().find('.line-total').text() != "") {
                                                    var all = $("#all_total").val();
                                                    total = parseInt(all) - parseInt($(this).parent().parent().find("div[name='total[]']").text());
                                                    $('#all_total').val(parseInt(total));
                                                    $('#all_tot').val(parseInt(total));

                                                    if ($('#discount').val() != "") {
                                                        var total1 = $('#all_total').val();
                                                        var discount = $('#discount').val();
                                                        total_discount = parseInt(discount) * parseInt(total1) / 100;
                                                        $('#total_dis').val(parseInt(total1) - parseInt(total_discount));
                                                        $('#total_discount').val(parseInt(total1) - parseInt(total_discount));
                                                        $('#total_discount').text(parseInt(total1) - parseInt(total_discount));
                                                    }
                                                }

                                                var data = {
                                                    id: $(this).parent().parent().find("#pid-new" + parseInt($("#table2 tr").length - 1)).val(),
                                                }
                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });
                                                $.ajax({
                                                    url: '/order_product/' + data.id,
                                                    type: 'delete',
                                                    data: data,
                                                    dataType: 'json',
                                                    async: false,
                                                    success: function (data) {
                                                    },
                                                    cache: false,
                                                });

                                                // pop items from no repeat array
                                                product_array.splice(product_array.indexOf(parseInt($(this).parent().parent().find("select[name='name[]']").val())), 1, 0);
                                                $(this).parent().parent().remove();
                                                remove = 0;
                                            }
                                        })

                                    }
                                });

                                // store new row
                                var data = {
                                    name: $(this).parent().parent().find("select[name='name[]']").val(),
                                    total: $(this).parent().parent().find('.sub-total').text(),
                                    hpo_order_id: $("#order_id").val(),
                                    // hpo_client_id: $("#order_id_show").data('client'),
                                    hop_due_date: $("#test-date-id").val(),
                                    hpo_discount: $("#discount").val(),
                                    all_tot: $("#all_total").val(),
                                    all_dis: $("#total_discount").val(),
                                }
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url: '/add-product',
                                    type: 'Post',
                                    data: data,
                                    dataType: 'json',
                                    async: false,
                                    success: function (data) {
                                        $("#pid-new" + parseInt($("#table2 tr").length - 1)).val(data.pid);
                                    },
                                    cache: false,
                                });
                                // end
                            }
                        });
                    }
                }

            });

            $("#discount").on('change', function (event) {
                total = $('#all_total').val();
                discount = $(this).val();
                total_discount = parseInt(discount) * parseInt(total) / 100;
                $('#all_dis').val(parseInt(total) - parseInt(total_discount));
                $('#total_discount').val(parseInt(total) - parseInt(total_discount));
                $('#total_discount').text(parseInt(total) - parseInt(total_discount));
            })

            $(".qty").on('change', function (event) {
                unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                unit_qty = $(this).val();
                $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);
                discount = $("#discount").val();
                total = $("#all_total").val();
                if (discount != "") {
                    total_discount = parseInt(discount) * parseInt(total) / 100;
                    $("#all_dis").val(parseInt(total) - parseInt(total_discount));
                    $("#total_discount").val(parseInt(total) - parseInt(total_discount));
                    $("#total_discount").text(parseInt(total) - parseInt(total_discount));
                }
                total = 0;
                $('.sub-total').each(function () {

                    current = $(this).text();
                    if (current != "") {
                        total = total + parseInt(current);
                        $("#all_total").val(total);
                        $("#all_tot").val(total);
                        $("#all_total").text(total);
                    }

                    discount = $("#discount").val();
                    var total_a = $("#all_total").val();
                    if (discount != "") {
                        total_discount = parseInt(discount) * parseInt(total_a) / 100;
                        $("#all_dis").val(parseInt(total_a) - parseInt(total_discount))
                        $("#total_discount").val(parseInt(total_a) - parseInt(total_discount))
                        $("#total_discount").text(parseInt(total_a) - parseInt(total_discount))
                    }
                });

            });

            $(".remove").click(function () {

                var rowCount = $('#table2 tr').length;

                if (rowCount > 2) {

                    if ($(this).parent().parent().find('.sub-total').text() != "") {
                        var all = $("#all_total").val();
                        var tot = parseInt(all) - parseInt($(this).parent().parent().find("div[name='total[]']").text());
                        $('#all_total').val(parseInt(tot));
                        $('#all_tot').val(parseInt(tot));
                        if ($('#discount').val() != "") {
                            var total1 = parseInt($('#all_total').val());
                            discount = parseInt($('#discount').val());
                            total_discount = parseInt(discount) * parseInt(total1) / 100;
                            $('#total_dis').val(parseInt(total1) - parseInt(total_discount));
                            $('#total_discount').val(parseInt(total1) - parseInt(total_discount));
                            $('#total_discount').text(parseInt(total1) - parseInt(total_discount));
                        }
                    }
                    var data = {
                        id: $(this).parent().parent().find('.name').data('id'),
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/order_product/' + data.id,
                        type: 'delete',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                        },
                        cache: false,
                    });

                    // pop items from no repeat array
                    product_array.splice(product_array.indexOf(parseInt($(this).parent().parent().find("select[name='name[]']").val())), 1, 0);
                    $(this).parent().parent().remove();
                }
            });

        });

        $('#preview').on('click', function () {
            $('#form2').attr('action', '{{route('order.preview')}}');
        })

    </script>
    {{--datapicker--}}
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
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

        var map = L.map('map').setView([35.7736, 51.4631], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        L.marker([{{$project->hp_project_location}}], {icon: greenIcon}).addTo(map)
            .bindPopup('{{$project->hp_address}}')
            .openPopup();

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