@extends('layouts.app')

@section('title',__('Client'))

@push('css')
@endpush
@section('content')
    @role('Admin')
    <div class="content persian">
        <form id="form_tab_panel_1"
              enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Add New Client')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card">
                        <div class="col-md-12">
                            <input type="hidden" id="cid" value="{{$client->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    @include('layouts.partial.Msg')
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">{{__('Contacts')}}</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('First Name')}}</label>
                                                        <input type="text" class="form-control" name="hc_name"
                                                               value="{{$client->hc_name}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Phone')}}</label>
                                                        <input type="text" class="form-control" name="hc_phone"
                                                               value="{{$client->hc_phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Email')}}</label>
                                                        <input type="text" class="form-control" name="hc_email"
                                                               value="{{$client->hc_email}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @include('layouts.partial.Msg')
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">{{__('Details')}}</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('ID Number')}}</label>
                                                        <input type="text" class="form-control"
                                                               name="hc_account_id" value="{{$client->hc_account_id}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('VAT Number')}}</label>
                                                        <input type="text" class="form-control" name="vat_number"
                                                               value="{{$client->vat_number}}">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Website')}}</label>
                                                        <input type="text" class="form-control"
                                                               name="hc_website" value="{{$client->hc_website}}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="client_details">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('layouts.partial.Msg')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-content setting-tab">
                                                <h6 class="card-subtitle">{{__('Additional Info')}}</h6>
                                                <ul class="nav nav-pills" style="float: none">
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link active" href="#tab4" data-toggle="tab"
                                                           role="tab">
                                                            {{__('Notes')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab5" data-toggle="tab" role="tab">
                                                            {{__('Message')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab6" data-toggle="tab" role="tab">
                                                            {{__('Classify')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab7" data-toggle="tab" role="tab">
                                                            {{__('Address')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2" >
                                                        <a class="nav-link" href="#" data-toggle="tab" role="tab">
                                                            {{__('Setting')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                                {{--<div role="tabpanel" class="tab-pane active" id="tab3">--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Currency')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="hc_currency_id">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Language')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="language_id">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Payment Terms')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="payment_terms">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Task Rate')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="task_rate">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Client Portal')}}</label>--}}
                                                {{--<input type="checkbox" name="show_tasks_in_portal">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div role="tabpanel" class="tab-pane active" id="tab4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Public Notes')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="public_notes"
                                                                       value="{{$client->public_notes}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Private Notes')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="hc_private_notes"
                                                                       value="{{$client->hc_private_notes}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab5">
                                                    <div class="row">
                                                        {{--<div class="col-md-6">--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<label class="bmd-label-floating">{{__('Dashboard')}}</label>--}}
                                                        {{--<input type="text" class="form-control" name="">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Unpaid Invoice')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="invoice_number_counter"
                                                                       value="{{$client->invoice_number_counter}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Paid Invoice')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="credit_number_counter"
                                                                       value="{{$client->credit_number_counter}}">
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-md-6">--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<label class="bmd-label-floating">{{__('Unapproved Quote')}}</label>--}}
                                                        {{--<input type="text" class="form-control"--}}
                                                        {{--name="quote_number_counter" value="{{$client->quote_number_counter}}">--}}
                                                        {{--</div>--}}

                                                        {{--</div>--}}
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Company Size')}}</label>
                                                                <input type="text" class="form-control" name="size_id"
                                                                       value="{{$client->size_id}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Industry')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="industry_id"
                                                                       value="{{$client->industry_id}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab7">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Street')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_address1">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Apt/Suite')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_address2"
                                                                       value="{{$client->shipping_address2}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('City')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_city"
                                                                       value="{{$client->shipping_city}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('State/Province')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_state"
                                                                       value="{{$client->shipping_state}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Postal Code')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_postal_code"
                                                                       value="{{$client->shipping_postal_code}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Country')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_country_id"
                                                                       value="{{$client->shipping_country_id}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn badge-primary"
                                                        style="vert-align: top">{{__('Send')}}</button>

                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endrole
    @role('order')
    <div class="content persian">
        <form id="form_tab_panel_1"
              enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Add New Client')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card">
                        <div class="col-md-12">
                            <input type="hidden" id="cid" value="{{$client->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    @include('layouts.partial.Msg')
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">{{__('Contacts')}}</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('First Name')}}</label>
                                                        <input type="text" class="form-control" name="hc_name"
                                                               value="{{$client->hc_name}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Phone')}}</label>
                                                        <input type="text" class="form-control" name="hc_phone"
                                                               value="{{$client->hc_phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Email')}}</label>
                                                        <input type="text" class="form-control" name="hc_email"
                                                               value="{{$client->hc_email}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @include('layouts.partial.Msg')
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">{{__('Details')}}</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('ID Number')}}</label>
                                                        <input type="text" class="form-control"
                                                               name="hc_account_id" value="{{$client->hc_account_id}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('VAT Number')}}</label>
                                                        <input type="text" class="form-control" name="vat_number"
                                                               value="{{$client->vat_number}}">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">{{__('Website')}}</label>
                                                        <input type="text" class="form-control"
                                                               name="hc_website" value="{{$client->hc_website}}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="client_details">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('layouts.partial.Msg')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-content setting-tab">
                                                <h6 class="card-subtitle">{{__('Additional Info')}}</h6>
                                                <ul class="nav nav-pills" style="float: none">
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link active" href="#tab4" data-toggle="tab"
                                                           role="tab">
                                                            {{__('Notes')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab5" data-toggle="tab" role="tab">
                                                            {{__('Message')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab6" data-toggle="tab" role="tab">
                                                            {{__('Classify')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2">
                                                        <a class="nav-link" href="#tab7" data-toggle="tab" role="tab">
                                                            {{__('Address')}}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item col-md-2" >
                                                        <a class="nav-link" href="#" data-toggle="tab" role="tab">
                                                            {{__('Setting')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                                {{--<div role="tabpanel" class="tab-pane active" id="tab3">--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Currency')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="hc_currency_id">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Language')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="language_id">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Payment Terms')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="payment_terms">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Task Rate')}}</label>--}}
                                                {{--<input type="text" class="form-control"--}}
                                                {{--name="task_rate">--}}
                                                {{--</div>--}}

                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group">--}}
                                                {{--<label class="bmd-label-floating">{{__('Client Portal')}}</label>--}}
                                                {{--<input type="checkbox" name="show_tasks_in_portal">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div role="tabpanel" class="tab-pane active" id="tab4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Public Notes')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="public_notes"
                                                                       value="{{$client->public_notes}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Private Notes')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="hc_private_notes"
                                                                       value="{{$client->hc_private_notes}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab5">
                                                    <div class="row">
                                                        {{--<div class="col-md-6">--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<label class="bmd-label-floating">{{__('Dashboard')}}</label>--}}
                                                        {{--<input type="text" class="form-control" name="">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Unpaid Invoice')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="invoice_number_counter"
                                                                       value="{{$client->invoice_number_counter}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Paid Invoice')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="credit_number_counter"
                                                                       value="{{$client->credit_number_counter}}">
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-md-6">--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<label class="bmd-label-floating">{{__('Unapproved Quote')}}</label>--}}
                                                        {{--<input type="text" class="form-control"--}}
                                                        {{--name="quote_number_counter" value="{{$client->quote_number_counter}}">--}}
                                                        {{--</div>--}}

                                                        {{--</div>--}}
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Company Size')}}</label>
                                                                <input type="text" class="form-control" name="size_id"
                                                                       value="{{$client->size_id}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Industry')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="industry_id"
                                                                       value="{{$client->industry_id}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="tab7">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Street')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_address1">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Apt/Suite')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_address2"
                                                                       value="{{$client->shipping_address2}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('City')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_city"
                                                                       value="{{$client->shipping_city}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('State/Province')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_state"
                                                                       value="{{$client->shipping_state}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Postal Code')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_postal_code"
                                                                       value="{{$client->shipping_postal_code}}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">{{__('Country')}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="shipping_country_id"
                                                                       value="{{$client->shipping_country_id}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn badge-primary"
                                                        style="vert-align: top">{{__('Send')}}</button>

                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var client_id;
            $("#form_tab_panel_1").submit(function (event) {
                client_id = $('#cid').val();
                var data = $("#form_tab_panel_1").serialize();
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
                    url: '/client/' + client_id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method:'put',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        location.reload();
                        window.location.href = "/client";
                    },
                    cache: false,
                });
            });

        });
    </script>
@endpush