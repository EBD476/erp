@extends('layouts.app')

@section('title',__('Order'))

@push('css')

@endpush

@section('content')
    @can('browse-menu-user')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Order')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('order.update',$order->id)}}" ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Project Name')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_project_name}}"
                                               name="hp_project_name">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Employer Name')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{$order->hp_employer_name}}" name="hp_employer_name">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Phone Number')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_phone_number}}"
                                               name="hp_phone_number">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Connector')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_connector}}"
                                               name="hp_connector">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Type Project')}}</label>
                                        <select type="text" class="form-control" name="hp_type_project">
                                            <option>{{__('MASKOONI')}} , {{__('TEJARI')}}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Owner User')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_owner_user}}"
                                               name="hp_owner_user">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Project Area')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_project_area}}"
                                               name="hp_project_area">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Number Of Units')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{$order->hp_number_of_units}}" name="hp_number_of_units">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('State')}}</label>
                                        <select class="form-control" type="text" name="hp_state">
                                            @foreach($state as $address)
                                                <option value="{{$state->hp_state}}">
                                                    {{$state->hp_code_state}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('City')}}</label>
                                        <select class="form-control" type="text" name="hp_city">
                                            @foreach($city as $address)
                                                <option value="{{$city->hp_city}}">
                                                    {{$city->hp_code_city}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Address')}}</label>
                                        <textarea type="text" class="form-control" name="hp_address"
                                                  placeholder="{{__('Address')}}">value="{{$order->hp_address}}"</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Project Location')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{$order->hp_project_location}}" name="hp_project_location">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Contract Type')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{$order->hp_contract_type}}" name="hp_contract_type">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Registrant')}}</label>
                                        <input type="text" class="form-control" value="{{$order->hp_registrant}}"
                                               name="hp_registrant">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Selection')}}</label>
                                        <input type="text" class="form-control"
                                               value="{{$order->hp_product_selection}}"
                                               name="hp_product_selection">
                                    </div>

                                </div>
                            <a href="{{route('product.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>
    @endcan
@endsection

@push('scripts')

@endpush