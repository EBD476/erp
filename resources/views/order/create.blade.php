@extends('layouts.app')

@section('title',__('Order'))

@push('css')
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
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
                                    {{__('Project Information')}}
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
                                                <label class="bmd-label-floating"
                                                       style="margin-top: -20px">{{__('Client Name')}}</label>
                                                <select id="client_name" name="ho_client"
                                                        class="select-client form-control">
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
                                                <input type="number" class="form-control persian" required=""
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
                                                <label style="margin-top: -20px" class="bmd-label-floating">{{__('State')}}</label>
                                                <select class="select-state form-control" type="text"
                                                        name="hp_address_state_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating" style="margin-top: -20px">{{__('City')}}</label>
                                                <select class="select-city form-control" type="text"
                                                        name="hp_address_city_id">
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
                                    <table class="table invoice-table product-table" style="direction: rtl" id="table2">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                            <th style="min-width:120px;width:25%">{{__('Item')}}</th>
                                            <th style="width:100%">{{__('Description')}}</th>
                                            <th style="min-width:120px">{{__('Unit Cost')}}</th>
                                            <th style="min-width:120px;display:table-cell">{{__('Quantity')}}</th>
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
                                            <td><i class="tim-icons icon-simple-add" id="add-row" title="Add item"/>
                                            </td>
                                            <td>
                                                <select name="name[]" class="select-item combobox-container">
                                                    <option value=""></option>
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
                                                <input disabled type="text" id="unit" class="form-control"
                                                       name="hp_product_price[]">
                                                <input name="price" id="price" type="hidden">
                                            </td>
                                            <td style="display:table-cell">
                                                <input
                                                        style="text-align: right" class="form-control invoice-item"
                                                        id="qty"
                                                        name="invoice_items_qty[]">
                                            </td>
                                            <td style="text-align:right;padding-top:9px !important" nowrap="">
                                                <div class="line-total" id="sub-total" name="total[]"></div>
                                                <input name="total[]" id="sub-total" type="hidden">
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
                                                                                                id="discount"
                                                                                                type="number"
                                                                                                name="hpo_discount">
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
                                                                    <input disabled class="form-control"
                                                                           id="all_total"
                                                                           type="text"
                                                                           name="all_total"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Total including discount')}}
                                                        :</label>
                                                    <div class="col-md-12 ">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input disabled class="form-control"
                                                                           id="total_discount"
                                                                           type="text"
                                                                           name="total_discount"
                                                                    >
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
                                    <input id="all_dis" name="all_dis" type="hidden">
                                    <input id="all_tot" name="all_tot" type="hidden">
                                    {{--End Hidden Object--}}

                                    <a href="{{route('order.index')}}"
                                       class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn btn-primary"
                                            id="btn-submit2">{{__('Send')}}</button>
                                    <button id="preview" class="btn btn-primary">{{__('Preview Factor')}}</button>
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
    @role('order')
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
                                    {{__('Project Information')}}
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
                                                <label class="bmd-label-floating"
                                                       style="margin-top: -20px">{{__('Client Name')}}</label>
                                                <select id="client_name" name="ho_client"
                                                        class="select-client form-control">
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
                                                <input type="number" class="form-control persian" required=""
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
                                                <label style="margin-top: -20px" class="bmd-label-floating">{{__('State')}}</label>
                                                <select class="select-state form-control" type="text"
                                                        name="hp_address_state_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating" style="margin-top: -20px">{{__('City')}}</label>
                                                <select class="select-city form-control" type="text"
                                                        name="hp_address_city_id">
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
                                    <table class="table invoice-table product-table" style="direction: rtl" id="table2">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th style="min-width:32px;" class="hide-border"></th>
                                            <th style="min-width:120px;width:25%">{{__('Item')}}</th>
                                            <th style="width:100%">{{__('Description')}}</th>
                                            <th style="min-width:120px">{{__('Unit Cost')}}</th>
                                            <th style="min-width:120px;display:table-cell">{{__('Quantity')}}</th>
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
                                            <td><i class="tim-icons icon-simple-add" id="add-row" title="Add item"/>
                                            </td>
                                            <td>
                                                <select name="name[]" class="select-item combobox-container">
                                                    <option value=""></option>
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
                                                <input disabled type="text" id="unit" class="form-control"
                                                       name="hp_product_price[]">
                                                <input name="price" id="price" type="hidden">
                                            </td>
                                            <td style="display:table-cell">
                                                <input
                                                        style="text-align: right" class="form-control invoice-item"
                                                        id="qty"
                                                        name="invoice_items_qty[]">
                                            </td>
                                            <td style="text-align:right;padding-top:9px !important" nowrap="">
                                                <div class="line-total" id="sub-total" name="total[]"></div>
                                                <input name="total[]" id="sub-total" type="hidden">
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
                                                                                                id="discount"
                                                                                                type="number"
                                                                                                name="hpo_discount">
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
                                                                    <input disabled class="form-control"
                                                                           id="all_total"
                                                                           type="text"
                                                                           name="all_total"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="bmd-label-floating">{{__('Total including discount')}}
                                                        :</label>
                                                    <div class="col-md-12 ">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <input disabled class="form-control"
                                                                           id="total_discount"
                                                                           type="text"
                                                                           name="total_discount"
                                                                    >
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
                                    <input id="all_dis" name="all_dis" type="hidden">
                                    <input id="all_tot" name="all_tot" type="hidden">
                                    {{--End Hidden Object--}}

                                    <a href="{{route('order.index')}}"
                                       class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn btn-primary"
                                            id="btn-submit2">{{__('Send')}}</button>
                                    <button id="preview" class="btn btn-primary">{{__('Preview Factor')}}</button>
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
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script>
        var total;
        var discount;
        var total_discount;
        var remove = 0;
        var last_total = 0;

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
                        setTimeout($.unblockUI, 2000);
                        client_id = data.client_id;
                        order_id = data.order_id;
                        $("#order_id").val(order_id);
                        $("#client_id").val(client_id);
                        $("#order_id_show").text(order_id);
                        $("#tab1").removeClass("active");
                        $("#tab2").addClass("active");
                    },
                    cache: false,
                });
            });

            $("#btn-submit2").on('click', function (event) {
                var data = $("#form2").serialize();
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

            var locale = $("#tab2").data('lang');

            $(".select-client").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill_data',
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
                    url: '/json-data-fill_data_city',
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
                    url: '/json-data-fill_data_state',
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

            // operation first row on table 2
            $(".select-item").select2({
                ajax: {
                    url: '/json-data-fill_data_product',
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
                dir:'rtl',
                left:'1142px',
                width:'340.667px',
                placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
                // allowClear: true

            }).on('select2:select', function (event) {

                var result = event.params.data;

                $("#unit").val(result.hp_product_price);
                $('#qty').val('1');

                unit_count = $("#unit").val();
                unit_qty = $("#qty").val();

                $("#sub-total").text(unit_count * unit_qty);
                $("#sub-total").val(unit_count * unit_qty);
                $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);

                $('#sub-total').each(function () {
                    total = $('#sub-total').text();
                    if (total != "") {
                        $("#all_total").val(total);
                        $("#all_total").text(total);
                        $("#all_tot").val(total);

                    }

                });

                $("#qty").on('change', function (event) {
                    unit_count = $("#unit").val();
                    unit_qty = $("#qty").val();
                    $('#sub-total').text(unit_count * unit_qty);
                    $('#sub-total').val(unit_count * unit_qty);
                    $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);

                    discount = $("#discount").val();
                    total = $("#sub-total").val();

                    if (discount != "") {
                        total_discount = parseInt(discount) * parseInt(total) / 100;
                        $("#all_dis").val(parseInt(total) - parseInt(total_discount));
                        $("#total_discount").val(parseInt(total) - parseInt(total_discount));
                        $("#total_discount").text(parseInt(total) - parseInt(total_discount));
                    }

                    total = 0;
                    var rowCount = $('#table2 tr').length;
                    if (rowCount == 2) {
                        $('#sub-total').each(function () {
                            current = $('#sub-total').val();
                            if (current != "") {
                                total = parseInt(current);
                                $("#all_total").val(total);
                                $("#all_total").text(total);
                            }
                        });
                    }
                    else {
                        total = 0;
                        $('.line-total').each(function () {
                            current = $(this).text();
                            subtotal = $('#sub-total').val();
                            if (current != "") {
                                if (current != "") {
                                    total = parseInt(total) + parseInt(current);
                                    $("#all_tot").val(total);
                                    $("#all_total").val(total);
                                    $("#all_total").text(total);
                                }

                            }
                        });
                    }

                    total = $("#all_total").val();
                    if (discount != "") {
                        total_discount = parseInt(discount) * parseInt(total) / 100;
                        $("#all_dis").val(parseInt(total) - parseInt(total_discount))
                        $("#total_discount").val(parseInt(total) - parseInt(total_discount))
                        $("#total_discount").text(parseInt(total) - parseInt(total_discount))
                    }

                });

                $("#discount").on('change', function (event) {
                    total = $('#all_total').val();
                    discount = $('#discount').val();
                    total_discount = parseInt(discount) * parseInt(total) / 100;
                    $('#all_dis').val(parseInt(total) - parseInt(total_discount));
                    $('#total_discount').val(parseInt(total) - parseInt(total_discount));
                    $('#total_discount').text(parseInt(total) - parseInt(total_discount));
                });

            });
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
                            if ($('#sub-total').text() != "") {
                                var all = $("#all_total").val();
                                var total_each = all - parseInt($('#sub-total').val());
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

                            if (remove == 0) {
                                total = all - parseInt($('#sub-total').val());
                                $("#all_tot").val(total);
                                $("#all_total").val(total);
                            }

                            $(this).parent().parent().remove();
                            remove = 0;
                        }
                    })
                }
            });
            // end

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

            // append item to table2
            function append_item() {
                $('.table').append('<tr data-bind="event: { mouseover: showActions, mouseout: hideActions }"\n' +
                    '                                       class="sortable-row ui-sortable-handle" style="">\n' +
                    '                                        <td class="hide-border td-icon">\n' +
                    '                                            <i style="display:none" data-bind="visible: actionsVisible() &amp;&amp;\n' +
                    '   ' +
                    '' +
                    '             $parent.invoice_items_without_tasks().length > 1" class="fa fa-sort"></i>\n' +
                    '                                        </td>\n' +
                    '                      <td> <i class="tim-icons icon-simple-add" id="add-row' + $("#table2 tr").length + '" title="Add item"/></td>\n' +
                    '                                        <td>\n' +
                    '                                                       <select name="name[]" class="select-item combobox-container">\n' +
                    '                                                            <option value=""></option>' +
                    '                                                        </select>\n' +
                    '\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                                <textarea\n' +
                    '                                                        data-bind="value: notes, valueUpdate: \'afterkeydown\', attr: {name: \'invoice_items[]\'}"\n' +
                    '                                                        rows="1" cols="60" style="resize: vertical; height: 42px;"\n' +
                    '                                                        class="form-control word-wrap"\n' +
                    '                                                        name="invoice_items[]"></textarea>\n' +
                    '\n' +
                    '                                        </td>\n' +
                    '                                        <td>\n' +
                    '                                            <input disabled type="text" id= "unit' + $("#table2 tr").length + '" class="form-control"\n' +
                    '                                                   name="hp_product_price[]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="display:table-cell">\n' +
                    '                                            <input \n' +
                    '                                                   style="text-align: right" class="form-control invoice-item qty"\n' +
                    '                                                 id= "qty' + $("#table2 tr").length + '"   name="invoice_items_qty[]">\n' +
                    '                                        </td>\n' +
                    '                                        <td style="text-align:right;padding-top:9px !important" nowrap="">\n' +
                    '                                            <div name="total[]" class="line-total" id="sub-total' + $("#table2 tr").length + '"></div>\n' +
                    '                                            <input name="total[]" id="sub-total' + $("#table2 tr").length + '" type="hidden">\n' +
                    '                                        </td>\n' +
                    '                                    </tr>'
                );

                var locale = $("#tab2").data('lang');

                $(".select-item").select2({
                    ajax: {
                        url: '/json-data-fill_data_product',
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
                    left:'1142px',
                    width:'340.667px',
                    placeholder: (locale == 'fa' ? 'انتخاب محصول' : 'Select Product'),
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                    // allowClear: true

                }).on('select2:select', function (event) {

                    var result = event.params.data;

                    $("#unit" + parseInt($("#table2 tr").length - 1)).val(result.hp_product_price);

                    $('#qty' + parseInt($("#table2 tr").length - 1)).val('1');

                    unit_count = $("#unit" + parseInt($("#table2 tr").length - 1)).val();

                    unit_qty = 1;

                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);

                    $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);

                    $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);

                    total = 0;
                    $('.line-total').each(function () {
                        current = $(this).text();
                        if (current != "") {
                            if (current != "") {
                                total = parseInt(total) + parseInt(current);
                                $("#all_tot").val(total);
                                $("#all_total").val(total);
                                $("#all_total").text(total);
                            }

                        }
                    });

                    $(".qty").on('change', function (event) {
                        unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                        unit_qty = $(this).val();
                        $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
                        $(this).parent().parent().find("div[name='total[]']").val(unit_count * unit_qty);
                        $(this).parent().parent().find("input[name='total[]']").val(unit_count * unit_qty);

                        discount = $("#discount").val();
                        total = 0;
                        $('.line-total').each(function () {
                            var current = $(this).text();
                            if (current != "") {
                                if (current != "") {
                                    total = total + parseInt(current);
                                    $("#all_tot").val(total);
                                    $("#all_total").val(total);
                                    $("#all_total").text(total);
                                }

                            }
                        });
                        total = $("#all_total").val();
                        if (discount != "") {
                            total_discount = parseInt(discount) * parseInt(total) / 100;
                            $("#all_dis").val(parseInt(total) - parseInt(total_discount))
                            $("#total_discount").val(parseInt(total) - parseInt(total_discount))
                            $("#total_discount").text(parseInt(total) - parseInt(total_discount))
                        }
                    });

                    $("#discount").on('change', function (event) {
                        total = $('#all_total').val();
                        discount = $('#discount').val();
                        total_discount = parseInt(discount) * parseInt(total) / 100;
                        $('#all_dis').val(parseInt(total) - parseInt(total_discount));
                        $('#total_discount').val(parseInt(total) - parseInt(total_discount));
                        $('#total_discount').text(parseInt(total) - parseInt(total_discount));
                    })

                });

                // add new row len _1 to table 2
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
                                    total = parseInt(all) - parseInt($(this).parent().parent().find("input[name='total[]']").val());
                                    $('#all_total').val(total);
                                    $('#all_tot').val(total);
                                    if ($('#discount').val() != "") {
                                        var total1 = $('#all_total').val();
                                        discount = $('#discount').val();
                                        total_discount = parseInt(discount) * parseInt(total1) / 100;
                                        $('#total_dis').val(parseInt(total1) - parseInt(total_discount));
                                        $('#total_discount').val(parseInt(total1) - parseInt(total_discount));
                                        $('#total_discount').text(parseInt(total1) - parseInt(total_discount));
                                    }
                                }


                                if (remove == 0) {

                                    total = all - parseInt($(this).parent().parent().find('.line-total').text());
                                    $("#all_tot").val(total);
                                    $("#all_total").val(total);
                                    remove += 1;

                                }

                                $(this).parent().parent().remove();
                                remove = 0;
                            }
                        })

                    }
                });


            }

        });

        //edit preview factor
        $('#edit_pre').on('click', function (event) {
            var oid = $("#hpo_order_id").val();
            var data = $("#form1").serialize();
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '/edit_pre/' + oid,
                type: 'POST',
                data: data,
                dataType: 'json',
                method: 'put',

                success: function (data) {
                    $('.container-fluid').html(data.response);
                },
                cache: false,
            });
        });

        //send form1 data
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


        //preview factor
        $('#preview').on('click', function () {
            $('#form2').attr('action', '{{route('order.preview')}}', 'method', 'post');
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

        map.on('click', onMapClick);
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

@endpush