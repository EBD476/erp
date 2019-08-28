@extends('layouts.app')

@section('title',__('Client'))

@push('css')

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
                        <h4 class="card-title ">{{__('Edit Client')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('client.update',$client->id)}}" ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('User Id')}}</label>
                                        <input type="text" class="form-control" name="hc_user_id" value="{{$client->hc_user_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Account Id')}}</label>
                                        <input type="text" class="form-control" name="hc_account_id" value="{{$client->hc_account_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Currency Id')}}</label>
                                        <input type="text" class="form-control" name="hc_currency_id" value="{{$client->hc_currency_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="hc_name" value="{{$client->hc_name}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Address')}}</label>
                                        <input type="text" class="form-control" name="hc_address" value="{{$client->hc_address}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('City')}}</label>
                                        <input type="text" class="form-control" name="hc_city" value="{{$client->hc_city}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('State')}}</label>
                                        <input type="text" class="form-control" name="hc_sate" value="{{$client->hc_sate}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Postal Code')}}</label>
                                        <input type="text" class="form-control" name="hc_postal_code" value="{{$client->hc_postal_code}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Country Id')}}</label>
                                        <input type="text" class="form-control" name="hc_country_id" value="{{$client->hc_country_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Private Notes')}}</label>
                                        <input type="text" class="form-control" name="hc_private_notes" value="{{$client->hc_private_notes}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Balance')}}</label>
                                        <input type="text" class="form-control" name="hc_balance" value="{{$client->hc_balance}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Paid To Date')}}</label>
                                        <input type="text" class="form-control" name="hc_paid_to_date" value="{{$client->hc_paid_to_date}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Last Login')}}</label>
                                        <input type="text" class="form-control" name="hc_last_login" value="{{$client->hc_last_login}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Website')}}</label>
                                        <input type="text" class="form-control" name="hc_website" value="{{$client->hc_website}}">
                                    </div>
                            <a href="{{route('product.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
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