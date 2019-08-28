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
                                <a href="{{route('order.index')}}"
                                   class="btn badge-danger">{{__('Back')}}</a>

                                <button type="submit" class="btn badge-primary"
                                >{{__('Send')}}</button>
                                <button type="submit" class="btn btn-primary"
                                        id="preview">{{__('Preview Factor')}}</button>


                                {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                {{--<div class="form-group">--}}
                                {{--<button type="button" class="btn btn-info btn-lg"--}}
                                {{--data-toggle="modal"--}}
                                {{--data-target="#myModal">{{__('Product Selection')}}</button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>

                            <div class="row" style="min-height:195px" onkeypress="formEnterClick(event)">
                                <div class="col-md-4" id="col_1">


                                    <div class="form-group client_select closer-row required"><label for="client"
                                                                                                     class="control-label col-lg-4 col-sm-4">{{__('Client')}}</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <div class="combobox-container"><input type="hidden" name="client"
                                                                                   value="0">
                                                <div class="input-group"><input type="text" autocomplete="off"
                                                                                placeholder="" required="required"
                                                                                class="form-control client-input"> <span
                                                            class="input-group-addon dropdown-toggle"
                                                            data-dropdown="dropdown"> <span class="caret"></span> <i
                                                                class="fa fa-times"></i> </span></div>
                                            </div>
                                            <select class="form-control client-input"
                                                    data-bind="dropdown: client, dropdownOptions: {highlighter: comboboxHighlighter}"
                                                    id="client" name="ho_client" style="display: none;">
                                                @foreach($client as $client)
                                                <option value="{{$client->id}}">{{$client->hc_name}}</option>
                                                @endforeach
                                            </select></div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 8px">
                                        <div class="col-lg-8 col-sm-8 col-lg-offset-4 col-sm-offset-4">
                                            <a id="createClientLink" class="pointer"
                                               data-bind="click: $root.showClientForm, html: $root.clientLinkText">{{__('Create new client')}}</a>
                                            <span data-bind="visible: $root.invoice().client().public_id() > 0"
                                                  style="display:none">|
                        <a data-bind="attr: {href: 'http://127.0.0.1:8005/clients/' + $root.invoice().client().public_id()}"
                           target="_blank" href="http://127.0.0.1:8005/clients/0">View Client</a>
                    </span>
                                        </div>
                                    </div>


                                    <div data-bind="with: client" class="invoice-contact">
                                        <div style="" class="form-group"
                                             data-bind="visible: contacts().length > 0, foreach: contacts">
                                            <div class="col-lg-8 col-lg-offset-4 col-sm-offset-4">
                                                <label class="checkbox"
                                                       data-bind="attr: {for: $index() + '_check'}, visible: email.display"
                                                       onclick="refreshPDF(true)" for="0_check" style="display: none;">
                                                    <input type="hidden" value="0"
                                                           data-bind="attr: {name: 'client[contacts][' + $index() + '][send_invoice]'}"
                                                           name="client[contacts][0][send_invoice]">
                                                    <input type="checkbox" value="1"
                                                           data-bind="visible: email() || first_name() || last_name(), checked: send_invoice, attr: {id: $index() + '_check', name: 'client[contacts][' + $index() + '][send_invoice]'}"
                                                           id="0_check" name="client[contacts][0][send_invoice]"
                                                           style="display: none;">
                                                    <span data-bind="visible: first_name || last_name"
                                                          style="display: none;">
								<span data-bind="text: (first_name() || '') + ' ' + (last_name() || '')"> </span>
								<br>
							</span>
                                                    <span data-bind="visible: email" style="display: none;">
								<span data-bind="text: email"></span>
								<br>
							</span>
                                                </label>
                                                <span data-bind="visible: !$root.invoice().is_recurring()">
                            <span data-bind="html: $data.view_as_recipient"></span>&nbsp;&nbsp;
                            	                            <span style="vertical-align: text-top; color: red; display: none;"
                                                                  class="fa fa-exclamation-triangle"
                                                                  data-bind="visible: $data.email_error, tooltip: {title: $data.email_error}"
                                                                  data-original-title="" title=""></span>
	                            <span style="vertical-align: text-top; padding-top: 2px; display: none; color: rgb(177, 181, 186);"
                                      class="fa fa-info-circle" data-bind="visible: $data.invitation_status, tooltip: {title: $data.invitation_status, html: true},
	                                    style: {color: $data.info_color}" data-original-title="" title=""></span>
								<span class="signature-wrapper">&nbsp;
								<span style="vertical-align: text-top; color: rgb(136, 136, 136); display: none;"
                                      class="fa fa-user"
                                      data-bind="visible: $data.invitation_signature_svg, tooltip: {title: $data.invitation_signature_svg, html: true}"
                                      data-original-title="" title=""></span>
								</span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4" id="col_2">
                                    <div data-bind="visible: !is_recurring()">
                                        <div class="form-group due_date"><label for="due_date"
                                                                                class="control-label col-lg-4 col-sm-4">{{__('Due Date')}}
                                                </label>
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-group"><input class="form-control"
                                                                                data-bind="datePicker: due_date, valueUpdate: 'afterkeydown'"
                                                                                placeholder=" "
                                                                                data-date-format="M d, yyyy"
                                                                                id="due_date" type="text"
                                                                                name="ho_due_dat"><span
                                                            class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-bind="visible: is_recurring" style="display: none">
                                        <div class="form-group frequency_id"><label for="frequency_id"
                                                                                    class="control-label col-lg-4 col-sm-4">Frequency</label>
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-group"><select class="form-control"
                                                                                 data-bind="value: frequency_id"
                                                                                 onchange="onFrequencyChange()"
                                                                                 id="frequency_id" name="frequency_id">
                                                        <option value="1">Weekly</option>
                                                        <option value="2">Two weeks</option>
                                                        <option value="3">Four weeks</option>
                                                        <option value="4">Monthly</option>
                                                        <option value="5">Two months</option>
                                                        <option value="6">Three months</option>
                                                        <option value="7">Four months</option>
                                                        <option value="8">Six months</option>
                                                        <option value="9">Annually</option>
                                                        <option value="10">Two years</option>
                                                    </select><span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-question-sign"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group start_date"><label for="start_date"
                                                                                  class="control-label col-lg-4 col-sm-4">Start
                                                Date</label>
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-group"><input class="form-control"
                                                                                data-bind="datePicker: start_date, valueUpdate: 'afterkeydown'"
                                                                                data-date-format="M d, yyyy"
                                                                                id="start_date" type="text"
                                                                                name="start_date"><span
                                                            class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group end_date"><label for="end_date"
                                                                                class="control-label col-lg-4 col-sm-4">End
                                                Date</label>
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-group"><input class="form-control"
                                                                                data-bind="datePicker: end_date, valueUpdate: 'afterkeydown'"
                                                                                data-date-format="M d, yyyy"
                                                                                id="end_date" type="text"
                                                                                name="end_date"><span
                                                            class="input-group-addon"><span
                                                                class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group recurring_due_date"><label for="recurring_due_date"
                                                                                          class="control-label col-lg-4 col-sm-4">Due
                                                Date</label>
                                            <div class="col-lg-8 col-sm-8">
                                                <div class="input-group"><select class="form-control"
                                                                                 data-bind="value: recurring_due_date"
                                                                                 id="recurring_due_date"
                                                                                 name="recurring_due_date">
                                                        <option value="" class="monthly weekly" style="display: block;">
                                                            Use client terms
                                                        </option>
                                                        <option value="1998-01-01" data-num="1" class="monthly"
                                                                style="display: block;">1st day of month
                                                        </option>
                                                        <option value="1998-01-02" data-num="2" class="monthly"
                                                                style="display: block;">2nd day of month
                                                        </option>
                                                        <option value="1998-01-03" data-num="3" class="monthly"
                                                                style="display: block;">3rd day of month
                                                        </option>
                                                        <option value="1998-01-04" data-num="4" class="monthly"
                                                                style="display: block;">4th day of month
                                                        </option>
                                                        <option value="1998-01-05" data-num="5" class="monthly"
                                                                style="display: block;">5th day of month
                                                        </option>
                                                        <option value="1998-01-06" data-num="6" class="monthly"
                                                                style="display: block;">6th day of month
                                                        </option>
                                                        <option value="1998-01-07" data-num="7" class="monthly"
                                                                style="display: block;">7th day of month
                                                        </option>
                                                        <option value="1998-01-08" data-num="8" class="monthly"
                                                                style="display: block;">8th day of month
                                                        </option>
                                                        <option value="1998-01-09" data-num="9" class="monthly"
                                                                style="display: block;">9th day of month
                                                        </option>
                                                        <option value="1998-01-10" data-num="10" class="monthly"
                                                                style="display: block;">10th day of month
                                                        </option>
                                                        <option value="1998-01-11" data-num="11" class="monthly"
                                                                style="display: block;">11th day of month
                                                        </option>
                                                        <option value="1998-01-12" data-num="12" class="monthly"
                                                                style="display: block;">12th day of month
                                                        </option>
                                                        <option value="1998-01-13" data-num="13" class="monthly"
                                                                style="display: block;">13th day of month
                                                        </option>
                                                        <option value="1998-01-14" data-num="14" class="monthly"
                                                                style="display: block;">14th day of month
                                                        </option>
                                                        <option value="1998-01-15" data-num="15" class="monthly"
                                                                style="display: block;">15th day of month
                                                        </option>
                                                        <option value="1998-01-16" data-num="16" class="monthly"
                                                                style="display: block;">16th day of month
                                                        </option>
                                                        <option value="1998-01-17" data-num="17" class="monthly"
                                                                style="display: block;">17th day of month
                                                        </option>
                                                        <option value="1998-01-18" data-num="18" class="monthly"
                                                                style="display: block;">18th day of month
                                                        </option>
                                                        <option value="1998-01-19" data-num="19" class="monthly"
                                                                style="display: block;">19th day of month
                                                        </option>
                                                        <option value="1998-01-20" data-num="20" class="monthly"
                                                                style="display: block;">20th day of month
                                                        </option>
                                                        <option value="1998-01-21" data-num="21" class="monthly"
                                                                style="display: block;">21st day of month
                                                        </option>
                                                        <option value="1998-01-22" data-num="22" class="monthly"
                                                                style="display: block;">22nd day of month
                                                        </option>
                                                        <option value="1998-01-23" data-num="23" class="monthly"
                                                                style="display: block;">23rd day of month
                                                        </option>
                                                        <option value="1998-01-24" data-num="24" class="monthly"
                                                                style="display: block;">24th day of month
                                                        </option>
                                                        <option value="1998-01-25" data-num="25" class="monthly"
                                                                style="display: block;">25th day of month
                                                        </option>
                                                        <option value="1998-01-26" data-num="26" class="monthly"
                                                                style="display: block;">26th day of month
                                                        </option>
                                                        <option value="1998-01-27" data-num="27" class="monthly"
                                                                style="display: block;">27th day of month
                                                        </option>
                                                        <option value="1998-01-28" data-num="28" class="monthly"
                                                                style="display: block;">28th day of month
                                                        </option>
                                                        <option value="1998-01-29" data-num="29" class="monthly"
                                                                style="display: block;">29th day of month
                                                        </option>
                                                        <option value="1998-01-30" data-num="30" class="monthly"
                                                                style="display: block;">30th day of month
                                                        </option>
                                                        <option value="1998-01-31" data-num="31" class="monthly"
                                                                style="display: block;">Last day of month
                                                        </option>
                                                        <option value="1998-02-01" data-num="1" class="weekly"
                                                                style="display: none;">1st Sunday after
                                                        </option>
                                                        <option value="1998-02-02" data-num="2" class="weekly"
                                                                style="display: none;">1st Monday after
                                                        </option>
                                                        <option value="1998-02-03" data-num="3" class="weekly"
                                                                style="display: none;">1st Tuesday after
                                                        </option>
                                                        <option value="1998-02-04" data-num="4" class="weekly"
                                                                style="display: none;">1st Wednesday after
                                                        </option>
                                                        <option value="1998-02-05" data-num="5" class="weekly"
                                                                style="display: none;">1st Thursday after
                                                        </option>
                                                        <option value="1998-02-06" data-num="6" class="weekly"
                                                                style="display: none;">1st Friday after
                                                        </option>
                                                        <option value="1998-02-07" data-num="7" class="weekly"
                                                                style="display: none;">1st Saturday after
                                                        </option>
                                                        <option value="1998-02-08" data-num="8" class="weekly"
                                                                style="display: none;">2nd Sunday after
                                                        </option>
                                                        <option value="1998-02-09" data-num="9" class="weekly"
                                                                style="display: none;">2nd Monday after
                                                        </option>
                                                        <option value="1998-02-10" data-num="10" class="weekly"
                                                                style="display: none;">2nd Tuesday after
                                                        </option>
                                                        <option value="1998-02-11" data-num="11" class="weekly"
                                                                style="display: none;">2nd Wednesday after
                                                        </option>
                                                        <option value="1998-02-12" data-num="12" class="weekly"
                                                                style="display: none;">2nd Thursday after
                                                        </option>
                                                        <option value="1998-02-13" data-num="13" class="weekly"
                                                                style="display: none;">2nd Friday after
                                                        </option>
                                                        <option value="1998-02-14" data-num="14" class="weekly"
                                                                style="display: none;">2nd Saturday after
                                                        </option>
                                                        <option value="1998-02-15" data-num="15" class="weekly"
                                                                style="display: none;">3rd Sunday after
                                                        </option>
                                                        <option value="1998-02-16" data-num="16" class="weekly"
                                                                style="display: none;">3rd Monday after
                                                        </option>
                                                        <option value="1998-02-17" data-num="17" class="weekly"
                                                                style="display: none;">3rd Tuesday after
                                                        </option>
                                                        <option value="1998-02-18" data-num="18" class="weekly"
                                                                style="display: none;">3rd Wednesday after
                                                        </option>
                                                        <option value="1998-02-19" data-num="19" class="weekly"
                                                                style="display: none;">3rd Thursday after
                                                        </option>
                                                        <option value="1998-02-20" data-num="20" class="weekly"
                                                                style="display: none;">3rd Friday after
                                                        </option>
                                                        <option value="1998-02-21" data-num="21" class="weekly"
                                                                style="display: none;">3rd Saturday after
                                                        </option>
                                                        <option value="1998-02-22" data-num="22" class="weekly"
                                                                style="display: none;">4th Sunday after
                                                        </option>
                                                        <option value="1998-02-23" data-num="23" class="weekly"
                                                                style="display: none;">4th Monday after
                                                        </option>
                                                        <option value="1998-02-24" data-num="24" class="weekly"
                                                                style="display: none;">4th Tuesday after
                                                        </option>
                                                        <option value="1998-02-25" data-num="25" class="weekly"
                                                                style="display: none;">4th Wednesday after
                                                        </option>
                                                        <option value="1998-02-26" data-num="26" class="weekly"
                                                                style="display: none;">4th Thursday after
                                                        </option>
                                                        <option value="1998-02-27" data-num="27" class="weekly"
                                                                style="display: none;">4th Friday after
                                                        </option>
                                                        <option value="1998-02-28" data-num="28" class="weekly"
                                                                style="display: none;">4th Saturday after
                                                        </option>
                                                    </select><span class="input-group-addon"><span
                                                                class="glyphicon glyphicon-question-sign"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4" id="col_2">
            <span data-bind="visible: !is_recurring()">
            </span>
                                    <span data-bind="visible: is_recurring()" style="display: none">
                <div data-bind="visible: !(auto_bill() == 2 &amp;&amp; client_enable_auto_bill()) &amp;&amp; !(auto_bill() == 3 &amp;&amp; !client_enable_auto_bill())"
                     style="">
                <div class="form-group"><label for="auto_bill" class="control-label col-lg-4 col-sm-4">Auto Bill</label><div
                            class="col-lg-8 col-sm-8"><select class="form-control"
                                                              data-bind="value: auto_bill, valueUpdate: 'afterkeydown', event:{change:function(){if(auto_bill()==2)client_enable_auto_bill(0);if(auto_bill()==3)client_enable_auto_bill(1)}}"
                                                              id="auto_bill" name="auto_bill"><option
                                    value="1">Off</option><option value="2">Opt-in</option><option
                                    value="3">Opt-out</option><option value="4">Always</option></select></div></div>
                </div>
                <input type="hidden" name="client_enable_auto_bill"
                       data-bind="attr: { value: client_enable_auto_bill() }">
                <div class="form-group" data-bind="visible: auto_bill() == 2 &amp;&amp; client_enable_auto_bill()"
                     style="display: none;">
                    <div class="col-sm-4 control-label">Auto Bill</div>
                    <div class="col-sm-8" style="padding-top:10px;padding-bottom:9px">
                        Opted in - <a href="#"
                                      data-bind="click:function(){client_enable_auto_bill(false)}">(Disable)</a>
                    </div>
                </div>
                <div class="form-group" data-bind="visible: auto_bill() == 3 &amp;&amp; !client_enable_auto_bill()"
                     style="display: none;">
                    <div class="col-sm-4 control-label">Auto Bill</div>
                    <div class="col-sm-8" style="padding-top:10px;padding-bottom:9px">
                        Opted out - <a href="#" data-bind="click:function(){client_enable_auto_bill(true)}">(Enable)</a>
                    </div>
                </div>
            </span>
                                    <div class="form-group no-padding-or-border"><label for="discount"
                                                                                        class="control-label col-lg-4 col-sm-4">{{__('Discount')}}</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <div class="input-group"><input class="form-control"
                                                                            data-bind="value: discount, valueUpdate: 'afterkeydown'"
                                                                            min="0" step="any" id="discount"
                                                                            type="number" name="discount"><span
                                                        class="input-group-addon"><select class="form-control"
                                                                                          data-bind="value: is_amount_discount, event:{ change: isAmountDiscountChanged}"
                                                                                          id="is_amount_discount"
                                                                                          name="ho_discount"><option
                                                                value="0">Percent</option><option
                                                                value="1">Amount</option></select></span></div>
                                        </div>
                                    </div>


                                    <div class="form-group" style="margin-bottom: 8px">
                                        <div class="col-lg-8 col-sm-8 col-sm-offset-4 smaller"
                                             style="padding-top: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane" id="tab2">


                                <table class="table invoice-table product-table" style="direction: ltr">
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
                                            <select name="name" class="select-item form-control">
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
                                <button type="submit" class="btn badge-primary" id="send"
                                >{{__('Send')}}</button>
                                <input type="hidden" name="hp_product_selection" id="hp_product_selection">
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

        $(".select-item").on('change', function (event) {

            // event.preventDefault();
            $("#unit").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
            $('#qty').val('1');

            unit_count = $("#unit").val();
            unit_qty = $("#qty").val();
            $('#total').text(unit_count * unit_qty);
            append_item();

        });

        $("#qty").on('change', function (event) {
            unit_count = $("#unit").val();
            unit_qty = $("#qty").val();
            $('#total').text(unit_count * unit_qty);
        })

        $('#send').on('click', function (event) {
            event.preventDefault();
            jsondata = JSON.stringify($('#tab2').serializeArray());
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

            $(".select-item").on('change', function (event) {

                $(this).parent().parent().find("input[name='hp_product_price[]']").val($(this).find("option[value='" + $(this).val() + "']").data('price'));
                $(this).parent().parent().find("input[name='invoice_items_qty[]']").val('1');
                // event.preventDefault();

                unit_count = $(this).parent().parent().find("input[name='hp_product_price[]']").val();
                unit_qty = $(this).parent().parent().find("input[name='invoice_items_qty[]']").val();
                $(this).parent().parent().find("div[name='total[]']").text(unit_count * unit_qty);
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