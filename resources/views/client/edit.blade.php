@extends('layouts.app')

@section('title',__('Client'))

@push('css')

@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">

                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Client')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('client.update',$client->id)}}"
                              ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('User ID')}}</label>
                                        <input type="text" class="form-control" name="hc_user_id"
                                               value="{{$client->hc_user_id}}">
                                    </div>

                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Account ID')}}</label>
                                        <input type="text" class="form-control" name="hc_account_id"
                                               value="{{$client->hc_account_id}}">
                                    </div>

                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Currency ID')}}</label>
                                        <input type="text" class="form-control" name="hc_currency_id"
                                               value="{{$client->hc_currency_id}}">
                                    </div>

                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="hc_name"
                                               value="{{$client->hc_name}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Address')}}</label>
                                        <input type="text" class="form-control" name="hc_address"
                                               value="{{$client->hc_address}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('City')}}</label>
                                        <input type="text" class="form-control" name="hc_city"
                                               value="{{$client->hc_city}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('State')}}</label>
                                        <input type="text" class="form-control" name="hc_sate"
                                               value="{{$client->hc_sate}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Postal Code')}}</label>
                                        <input type="text" class="form-control" name="hc_postal_code"
                                               value="{{$client->hc_postal_code}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Country ID')}}</label>
                                        <input type="text" class="form-control" name="hc_country_id"
                                               value="{{$client->hc_country_id}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Private Notes')}}</label>
                                        <input type="text" class="form-control" name="hc_private_notes"
                                               value="{{$client->hc_private_notes}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Balance')}}</label>
                                        <input type="text" class="form-control" name="hc_balance"
                                               value="{{$client->hc_balance}}">
                                    </div>

                                </div>

                                {{--<div class="col-md-3">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="bmd-label-floating">{{__('Paid To Date')}}</label>--}}
                                        {{--<input type="text" class="form-control" name="hc_paid_to_date"--}}
                                               {{--value="{{$client->hc_paid_to_date}}">--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                {{--<div class="col-md-3">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="bmd-label-floating">{{__('Last Login')}}</label>--}}
                                        {{--<input type="text" class="form-control" name="hc_last_login"--}}
                                               {{--value="{{$client->hc_last_login}}">--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Website')}}</label>
                                        <input type="text" class="form-control" name="hc_website"
                                               value="{{$client->hc_website}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping Address2')}}</label>
                                        <input type="text" class="form-control" name="shipping_address2"
                                               value="{{$client->shipping_address2}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping Address1')}}</label>
                                        <input type="text" class="form-control" name="shipping_address1"
                                               value="{{$client->shipping_address1}}">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping Country ID')}}</label>
                                        <input type="text" class="form-control" name="shipping_country_id"
                                               value="{{$client->shipping_country_id}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping Postal Code')}}</label>
                                        <input type="text" class="form-control" name="shipping_postal_code"
                                               value="{{$client->shipping_postal_code}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping State')}}</label>
                                        <input type="text" class="form-control" name="shipping_state"
                                               value="{{$client->shipping_state}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Shipping City')}}</label>
                                        <input type="text" class="form-control" name="shipping_city"
                                               value="{{$client->shipping_city}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Work Phone')}}</label>
                                        <input type="text" class="form-control" name="hc_work_phone"
                                               value="{{$client->hc_work_phone}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Send Reminders')}}</label>
                                        <input type="text" class="form-control" name="send_reminders"
                                               value="{{$client->send_reminders}}">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('VAT Number')}}</label>
                                        <input type="text" class="form-control" name="vat_number"
                                               value="{{$client->vat_number}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Language ID')}}</label>
                                        <input type="text" class="form-control" name="language_id"
                                               value="{{$client->language_id}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Payment terms')}}</label>
                                        <input type="text" class="form-control" name="payment_terms"
                                               value="{{$client->payment_terms}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Task Rate')}}</label>
                                        <input type="text" class="form-control" name="task_rate"
                                               value="{{$client->task_rate}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Show Tasks In Portal')}}</label>
                                        <input type="text" class="form-control" name="show_tasks_in_portal"
                                               value="{{$client->show_tasks_in_portal}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Public Notes')}}</label>
                                        <input type="text" class="form-control" name="public_notes"
                                               value="{{$client->public_notes}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Invoice Number Counter')}}</label>
                                        <input type="text" class="form-control" name="invoice_number_counter"
                                               value="{{$client->invoice_number_counter}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Size ID')}}</label>
                                        <input type="text" class="form-control" name="shipping_address1"
                                               value="{{$client->size_id}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Custom Value1')}}</label>
                                        <input type="text" class="form-control" name="custom_value1"
                                               value="{{$client->custom_value1}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Custom Messages')}}</label>
                                        <input type="text" class="form-control" name="custom_messages"
                                               value="{{$client->custom_messages}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Quote Number Counter')}}</label>
                                        <input type="text" class="form-control" name="quote_number_counter"
                                               value="{{$client->quote_number_counter}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Credit Number Counter')}}</label>
                                        <input type="text" class="form-control" name="credit_number_counter"
                                               value="{{$client->credit_number_counter}}">
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Industry ID')}}</label>
                                        <input type="text" class="form-control" name="industry_id"
                                               value="{{$client->industry_id}}">
                                    </div>

                                </div>
                            <div class="col-md-12">
                            <a href="{{route('product.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
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

@endpush