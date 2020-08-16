@extends('layouts.app')

@section('title', __('Hanta Enterprise Resource Planning'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    {{--<div class="card-header text-right">--}}
                    {{--<h4>{{__('Projects Map')}} </h4>--}}
                    {{--</div>--}}
                    <div class="card-body">
                        <div id="map" class="map" style="width: 100%; height: 300px;direction: ltr"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('order.index') }}">{{__('Total Orders')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$orders}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-refresh-01"></i> Update Now--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Order queue')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$order_req}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('agreement.index') }}">{{__('Agreement')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$agreement}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('client.index') }}">{{__('Total Customers')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$client}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-watch-time"></i> In the last hours--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                {{--<h5 class="card-category">Total Project</h5>--}}
                                <h3 class="card-title">{{__('Smart Home Projects')}}</h3>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="btn-group btn-group-toggle float-right" data-toggle="buttons">--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple active" id="0">--}}
                            {{--<input type="radio" name="options" checked>--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-single-02"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple" id="1">--}}
                            {{--<input type="radio" class="d-none d-sm-none" name="options">--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-gift-2"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple" id="2">--}}
                            {{--<input type="radio" class="d-none" name="options">--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-tap-02"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartBig1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Total Shipments</h5>
                        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLinePurple"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Daily Sales</h5>
                        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="CountryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Completed Tasks</h5>
                        <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLineGreen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--message cartable--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-header text-right">
                        <h3 class="card-title"> {{__('Order Verify List')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>

                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $orders)
                                    <tr>
                                        <td>
                                            {{$orders->id }}
                                        </td>
                                        <td>
                                            {{$orders->hp_project_name }}
                                        </td>
                                        <td>
                                            {{$orders->created_at}}
                                        </td>
                                        <td>
                                            <a href="{{route('verify_pre.edit',$orders->id)}}"
                                               class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                <i class="tim-icons icon-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endrole

    @role('finance')
    <div class="content persian">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    {{--<div class="card-header text-right">--}}
                    {{--<h4>{{__('Projects Map')}} </h4>--}}
                    {{--</div>--}}
                    <div class="card-body">
                        <div id="map" class="map" style="width: 100%; height: 300px;direction: ltr"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.index')}}">{{__('Total Orders')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$orders}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-refresh-01"></i> Update Now--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Order queue')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$order_req}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('agreement.index') }}">{{__('Agreement')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$agreement}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('client.index') }}">{{__('Total Customers')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$client}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="tim-icons icon-watch-time"></i> In the last hours
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--message cartable--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}


        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                {{--<h5 class="card-category">Total Project</h5>--}}
                                <h3 class="card-title">{{__('Smart Home Projects')}}</h3>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="btn-group btn-group-toggle float-right" data-toggle="buttons">--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple active" id="0">--}}
                            {{--<input type="radio" name="options" checked>--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-single-02"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple" id="1">--}}
                            {{--<input type="radio" class="d-none d-sm-none" name="options">--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-gift-2"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--<label class="btn btn-sm btn-primary btn-simple" id="2">--}}
                            {{--<input type="radio" class="d-none" name="options">--}}
                            {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>--}}
                            {{--<span class="d-block d-sm-none">--}}
                            {{--<i class="tim-icons icon-tap-02"></i>--}}
                            {{--</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartBig1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Total Shipments</h5>
                        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLinePurple"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Daily Sales</h5>
                        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="CountryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Completed Tasks</h5>
                        <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLineGreen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{--<div class="col-lg-12 col-md-12">--}}
            {{--<div class="card card-tasks">--}}
            {{--<div class="card-header ">--}}
            {{--<h6 class="title d-inline">Tasks(5)</h6>--}}
            {{--<p class="card-category d-inline">today</p>--}}
            {{--<div class="dropdown">--}}
            {{--<button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">--}}
            {{--<i class="tim-icons icon-settings-gear-63"></i>--}}
            {{--</button>--}}
            {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">--}}
            {{--<a class="dropdown-item" href="#pablo">Action</a>--}}
            {{--<a class="dropdown-item" href="#pablo">Another action</a>--}}
            {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="card-body ">--}}
            {{--<div class="table-full-width table-responsive">--}}
            {{--<table class="table">--}}
            {{--<tbody>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">Update the Documentation</p>--}}
            {{--<p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="" checked="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">GDPR Compliance</p>--}}
            {{--<p class="text-muted">The GDPR is a regulation that requires businesses to--}}
            {{--protect the personal data and privacy of Europe citizens for transactions--}}
            {{--that occur within EU member states.</p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">Solve the issues</p>--}}
            {{--<p class="text-muted">Fifty percent of all respondents said they would be more--}}
            {{--likely to shop at a company </p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">Release v2.0.0</p>--}}
            {{--<p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">Export the processed files</p>--}}
            {{--<p class="text-muted">The report also shows that consumers will not easily--}}
            {{--forgive a company once a breach exposing their personal data occurs. </p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-check">--}}
            {{--<label class="form-check-label">--}}
            {{--<input class="form-check-input" type="checkbox" value="">--}}
            {{--<span class="form-check-sign">--}}
            {{--<span class="check"></span>--}}
            {{--</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--<p class="title">Arival at export process</p>--}}
            {{--<p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>--}}
            {{--</td>--}}
            {{--<td class="td-actions text-right">--}}
            {{--<button type="button" rel="tooltip" title="" class="btn btn-link"--}}
            {{--data-original-title="Edit Task">--}}
            {{--<i class="tim-icons icon-pencil"></i>--}}
            {{--</button>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
            {{--</table>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-header text-right">
                        <h3 class="card-title"> {{__('Order Verify List')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>

                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $order)
                                    <tr>
                                        <td class="persian">
                                            {{$order->id }}
                                        </td>
                                        <td>
                                            {{$order->hp_project_name }}
                                        </td>
                                        <td class="persian">
                                            {{$order->created_at}}
                                        </td>
                                        <td>
                                            <a href="{{route('verify_pre.edit',$order->id)}}"
                                               class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                <i class="tim-icons icon-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endrole

    @role('dealership')
    <div class="content persian">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header text-right">
                        <h4>{{__('Projects Map')}} </h4>
                    </div>
                    <div class="card-body">
                        <div id="map" class="map" style="width: 100%; height: 300px;direction: ltr"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('order.index') }}">{{__('Total Orders')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$orders}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="tim-icons icon-refresh-01"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Order queue')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$order_req}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="tim-icons icon-sound-wave"></i> Last Research
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('agreement.index') }}">{{__('Agreement')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$agreement}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="tim-icons icon-trophy"></i> Customers feedback
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('client.index') }}">{{__('Total Customers')}}</a>
                                    </p>
                                    <h3 class="card-title persian">{{$client}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="tim-icons icon-watch-time"></i> In the last hours
                        </div>
                    </div>
                </div>
            </div>
        </div>

        message cartable
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                <a class="dropdown-item" href="#pablo">Something else</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        reply box
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        end message cartable


        <div class="row">
            <div class="col-12">
                <div class="card card-chart">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                <h5 class="card-category">Total Project</h5>
                                <h3 class="card-title">{{__('Smart Home Projects')}}</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                    <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                        <input type="radio" name="options" checked>
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                                        <span class="d-block d-sm-none">
        <i class="tim-icons icon-single-02"></i>
        </span>
                                    </label>
                                    <label class="btn btn-sm btn-primary btn-simple" id="1">
                                        <input type="radio" class="d-none d-sm-none" name="options">
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                                        <span class="d-block d-sm-none">
        <i class="tim-icons icon-gift-2"></i>
        </span>
                                    </label>
                                    <label class="btn btn-sm btn-primary btn-simple" id="2">
                                        <input type="radio" class="d-none" name="options">
                                        <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                                        <span class="d-block d-sm-none">
        <i class="tim-icons icon-tap-02"></i>
        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartBig1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Total Shipments</h5>
                        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLinePurple"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Daily Sales</h5>
                        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="CountryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Completed Tasks</h5>
                        <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartLineGreen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card card-tasks">
                    <div class="card-header ">
                        <h6 class="title d-inline">Tasks(5)</h6>
                        <p class="card-category d-inline">today</p>
                        <div class="dropdown">
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#pablo">Action</a>
                                <a class="dropdown-item" href="#pablo">Another action</a>
                                <a class="dropdown-item" href="#pablo">Something else</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Update the Documentation</p>
                                        <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">GDPR Compliance</p>
                                        <p class="text-muted">The GDPR is a regulation that requires businesses to
                                            protect the personal data and privacy of Europe citizens for transactions
                                            that occur within EU member states.</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Solve the issues</p>
                                        <p class="text-muted">Fifty percent of all respondents said they would be more
                                            likely to shop at a company </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Release v2.0.0</p>
                                        <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Export the processed files</p>
                                        <p class="text-muted">The report also shows that consumers will not easily
                                            forgive a company once a breach exposing their personal data occurs. </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
            <span class="check"></span>
            </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Arival at export process</p>
                                        <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                                data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('repository')
    <div class="content persian">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}
    </div>
    @endrole

    @role('qc')
    <div class="content persian">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('qc.index')}}">{{__('Repository Inventory QC')}}</a>
                                    </p>
                                    @foreach($inventory_qc as $inventory_qcs)
                                        <h3 class="card-title">{{$inventory_qcs->total}}</h3>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('qc.index')}}">{{__('QC queue')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$queue_qc}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('qc.index')}}">{{__('Returned')}}</a>
                                    </p>
                                    @foreach($inventory_qc_returned as $inventory_qc_returned_s)
                                        <h3 class="card-title">{{$inventory_qc_returned_s->total}}</h3>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-watch-time"></i> In the last hours--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('conversation_view.inbox')}}">{{__('Unseen messages')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$un_seen_message}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}
    </div>
    @endrole

    @role('product')
    <div class="content persian">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Product Requirement')}}</a>
                                    </p>
                                    @foreach($product_requirement as $product_requirements)
                                        <h3 class="card-title">{{$product_requirements->sum_hpo}}</h3>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-refresh-01"></i> Update Now--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Order queue')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$order_req}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('order.invoices_list_product')}}">{{__('Returned')}}</a>
                                    </p>
                                    <h3 class="card-title">0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-watch-time"></i> In the last hours--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{Route('conversation_view.inbox')}}">{{__('Unseen messages')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$un_seen_message}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        {{--message cartable--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}

        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-header ">--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-6 text-right">--}}
        {{--<h3 class="card-title">{{__('Smart Home Projects')}}</h3>--}}
        {{--</div>--}}
        {{--<div class="col-sm-6">--}}
        {{--<div class="btn-group btn-group-toggle float-right" data-toggle="buttons">--}}
        {{--<label class="btn btn-sm btn-primary btn-simple active" id="0">--}}
        {{--<input type="radio" name="options" checked>--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-single-02"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--<label class="btn btn-sm btn-primary btn-simple" id="1">--}}
        {{--<input type="radio" class="d-none d-sm-none" name="options">--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-gift-2"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--<label class="btn btn-sm btn-primary btn-simple" id="2">--}}
        {{--<input type="radio" class="d-none" name="options">--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-tap-02"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartBig1"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}


        {{--<div class="row">--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartLinePurple"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="CountryChart"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartLineGreen"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    @endrole

    @role('order')
    <div class="content persian">
        <div class="row">
            <div class="col-lg-2 col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-warning">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('order.index') }}">{{__('Total Orders')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$orders}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-refresh-01"></i> Update Now--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-primary">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category" style="width: 100px;"><a class="nav-link"
                                                                                      href="{{Route('order.invoices_list_product')}}">{{__('Order queue')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$order_order}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('agreement.index') }}">{{__('Agreement')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$agreement}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-danger">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category"><a class="nav-link"
                                                                href="{{ route('client.index') }}">{{__('Total Customers')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$client_order}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-watch-time"></i> In the last hours--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-lg-2 col-md-8">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="info-icon text-center icon-success">
                                    <i class="tim-icons icon-world"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category" style="width: 100px;"><a class="nav-link"
                                                                                      href="{{ route('conversation_view.inbox') }}">{{__('Unseen messages')}}</a>
                                    </p>
                                    <h3 class="card-title">{{$un_seen_message}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
                    {{--<hr>--}}
                    {{--<div class="stats">--}}
                    {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>

        {{--message cartable--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card_1">
                    <div class="card-header">
                        <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                        <div class="dropdown">
                            <h6 class="title d-inline">
                                <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                            </h6>
                            <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                    data-toggle="dropdown">
                                <i class="tim-icons icon-settings-gear-63"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu"
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                   data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                <a class="dropdown-item"
                                   href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="table1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Sender Name')}}
                                    </th>
                                    <th>
                                        {{__('Message')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Action')}}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form1">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{__('Send Message TO')}}</label>
                                            <div class="form-group">
                                                <select name="user_receive_id[]"
                                                        class="form-control select-receiver-user"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form1"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form1"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--reply box--}}
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" id="card-form2">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title" id="request_user"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name" id="name" disabled>
                                                <input id="user_receive_id" name="user_receive_id[]" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_give"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Reply')}}</label>
                                                <textarea name="message" type="text" class="form-control"
                                                          required=""
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file2">
                                    <input id="file_data" hidden>
                                </form>
                                <br>
                                <div class="col-md-8">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="file_show" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                              id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file2" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub-btn-form2"
                                        class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                <button id="back_form2"
                                        class="btn btn-fill btn-primary">{{__('Back')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end message cartable--}}


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-header text-right">
                        <h3 class="card-title"> {{__('Order Status List')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Status')}}
                                    </th>
                                    <th>
                                        {{__('Preview Factor')}}
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_agent as $order_agents)
                                    <tr>
                                        <td>
                                            {{$order_agents->id }}
                                        </td>
                                        <td>
                                            {{$order_agents->hp_project_name }}
                                        </td>
                                        <td>
                                            {{$order_agents->created_at}}
                                        </td>
                                        @foreach($process_level as $status)
                                            @if($status->hp_process_id == $order_agents->hp_status)
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="col-md-4" style="margin-top: -10px">
                                                                {{$status->hp_process_name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="progress">
                                                                    @foreach($progress as $progresses)
                                                                        {{--<span class="progress-value">25%</span>--}}
                                                                        @if($progresses->ho_process_id == 1 and $order_agents->id == $progresses->order_id )
                                                                            <div class="progress-bar" role="progressbar"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"
                                                                                 style="width: 25%;"></div>
                                                                        @endif
                                                                        @if($progresses->ho_process_id == 2 and $order_agents->id == $progresses->order_id)
                                                                            <div class="progress-bar" role="progressbar"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"
                                                                                 style="width: 50%;"></div>
                                                                        @endif
                                                                        @if($progresses->ho_process_id == 3 and $order_agents->id == $progresses->order_id)
                                                                            <div class="progress-bar" role="progressbar"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"
                                                                                 style="width: 75%;"></div>
                                                                        @endif
                                                                        @if($progresses->ho_process_id == 4 and $order_agents->id == $progresses->order_id )
                                                                            <div class="progress-bar" role="progressbar"
                                                                                 aria-valuenow="60" aria-valuemin="0"
                                                                                 aria-valuemax="100"
                                                                                 style="width:100%; direction: ltr"></div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <a href="{{route('verify_pre.edit',$order_agents->id)}}"
                                               class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                <i class="tim-icons icon-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-header ">--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-6 text-right">--}}
        {{--<h3 class="card-title">{{__('Smart Home Projects')}}</h3>--}}
        {{--</div>--}}
        {{--<div class="col-sm-6">--}}
        {{--<div class="btn-group btn-group-toggle float-right" data-toggle="buttons">--}}
        {{--<label class="btn btn-sm btn-primary btn-simple active" id="0">--}}
        {{--<input type="radio" name="options" checked>--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-single-02"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--<label class="btn btn-sm btn-primary btn-simple" id="1">--}}
        {{--<input type="radio" class="d-none d-sm-none" name="options">--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-gift-2"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--<label class="btn btn-sm btn-primary btn-simple" id="2">--}}
        {{--<input type="radio" class="d-none" name="options">--}}
        {{--<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>--}}
        {{--<span class="d-block d-sm-none">--}}
        {{--<i class="tim-icons icon-tap-02"></i>--}}
        {{--</span>--}}
        {{--</label>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartBig1"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartLinePurple"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="CountryChart"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
        {{--<div class="card card-chart">--}}
        {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
        {{--<canvas id="chartLineGreen"></canvas>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    @endrole

    @role('geust')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    {{--<div class="card-header text-right">--}}
                    {{--<h4>{{__('Projects Map')}} </h4>--}}
                    {{--</div>--}}
                    <div class="card-body">
                        <div id="map" class="map" style="width: 100%; height: 300px;direction: ltr"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endrole

    @role('task')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    {{--message cartable--}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card" id="card_1">
                                <div class="card-header">
                                    <h3 class="card-title"> {{__('Un Read Message List')}}</h3>
                                    <div class="dropdown">
                                        <h6 class="title d-inline">
                                            <button class="btn btn-primary compose">{{__('Create Message')}}</button>
                                        </h6>
                                        <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                                data-toggle="dropdown">
                                            <i class="tim-icons icon-settings-gear-63"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu"
                                             aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item compose" href="#" id="compose" data-toggle="modal"
                                               data-target="#modalRegisterForm">{{__('Compose')}}</a>
                                            <a class="dropdown-item"
                                               href="{{ route('conversation_view.inbox') }}">{{__('Inbox')}}</a>
                                            {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="table1">
                                            <thead class=" text-primary">
                                            <tr>
                                                <th>
                                                    {{__('ID')}}
                                                </th>
                                                <th>
                                                    {{__('Sender Name')}}
                                                </th>
                                                <th>
                                                    {{__('Message')}}
                                                </th>
                                                <th>
                                                    {{__('Created at')}}
                                                </th>
                                                <th>
                                                    {{__('Action')}}
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card" id="card-form1">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                            <p class="card-category"></p>
                                        </div>
                                        <div class="card-body">
                                            <form id="form1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <label>{{__('Send Message TO')}}</label>
                                                        <div class="form-group">
                                                            <select name="user_receive_id[]"
                                                                    class="form-control select-receiver-user"
                                                                    multiple="multiple"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>{{__('Message')}}</label>
                                                            <textarea name="message" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="file" id="file">
                                            </form>
                                            <br>
                                            <div class="col-md-8">
                                                <label style="margin-top: -20px;">{{__('File')}}</label>
                                                <div class="card-body col-md-12 row">
                                                    <form action="{{url('/request-message-file-save')}}"
                                                          class="dropzone"
                                                          id="dropzone"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="form-group">
                                                            <input type="file" class="form-control"
                                                                   name="file" multiple>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="sub-btn-form1"
                                                    class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                            <button id="back_form1"
                                                    class="btn btn-fill btn-primary">{{__('Back')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--reply box--}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card" id="card-form2">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title" id="request_user"></h4>
                                            <p class="card-category"></p>
                                        </div>
                                        <div class="card-body">
                                            <form id="form2">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>{{__('Name')}}</label>
                                                            <input class="form-control"
                                                                   name="name" id="name" disabled>
                                                            <input id="user_receive_id" name="user_receive_id[]" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>{{__('Message')}}</label>
                                                            <textarea class="form-control" id="message_give"
                                                                      disabled></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>{{__('Reply')}}</label>
                                                            <textarea name="message" type="text" class="form-control"
                                                                      required=""
                                                                      aria-invalid="false"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="file" id="file2">
                                                <input id="file_data" hidden>
                                            </form>
                                            <br>
                                            <div class="col-md-8">
                                                <label style="margin-top: -20px;">{{__('File')}}</label>
                                                <button id="file_show" style="margin-left:33px; "
                                                        class="btn-outline-light">{{__('Download Attached File')}}</button>
                                                <div class="card-body col-md-12 row">
                                                    <form action="{{url('/request-message-file-save')}}"
                                                          class="dropzone"
                                                          id="dropzone"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="form-group">
                                                            <input type="file" class="form-control"
                                                                   name="file2" multiple>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="sub-btn-form2"
                                                    class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                            <button id="back_form2"
                                                    class="btn btn-fill btn-primary">{{__('Back')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end message cartable--}}
                    <div class="card-body">
                        <div id="map" class="map" style="width: 100%; height: 300px;direction: ltr"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endrole
@endsection

@push('scripts')

    <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
    <script src="{{asset('assets/js/demo.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>

    @role('Admin')
    <script>
        $(document).ready(function () {

            demo.initDashboardPageCharts();
            var greenIcon = L.icon({
                iconUrl: '../../assets/images/marker-icon.png',
                iconSize: [24, 24], // size of the icon
            });

            var cities = L.layerGroup();

            @foreach($projects as $key => $project)
            L.marker([{{$project->hp_project_location}}], {icon: greenIcon}).bindPopup('This is Littleton, CO.').addTo(cities);
                    @endforeach

            var mbAttr = '',
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

            var grayscale = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
                streets = L.tileLayer(mbUrl, {id: 'mapbox.streets', attribution: mbAttr});

            var map = L.map('map', {
                center: [32.760, 53.503],
                zoom: 5,
                layers: [cities, grayscale]
            });

            var baseLayers = {
                "Grayscale": grayscale,
                "Streets": streets
            };

            var overlays = {
                "Cities": cities
            };

            // map.on('click', onMapClick);

            var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

            if (isWindows) {

                if ($('.main-panel').length != 0) {
                    var ps = new PerfectScrollbar('.main-panel', {
                        wheelSpeed: 0.01,
                        wheelPropagation: false,
                        minScrollbarLength: 10,
                        suppressScrollX: true
                    });
                }

                if ($('.sidebar .sidebar-wrapper').length != 0) {

                    var ps1 = new PerfectScrollbar('.sidebar .sidebar-wrapper');
                    $('.table-responsive').each(function () {
                        var ps2 = new PerfectScrollbar($(this)[0]);
                    });
                }

                $('html').addClass('perfect-scrollbar-on');
            }

        });

    </script>
    @endrole
    <script>
        $(document).ready(function () {

            {{--message cartable--}}

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");

            $('#card-form1').hide();
            $('#card-form2').hide();

            var table = $('#table1').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/fill-unread-message',
                "columnDefs":
                    [{
                        "targets": -1,
                        "data": null,

                        "render": function (data, type, row, meta) {
                            return "  <div class=\"dropdown\">\n" +
                                "                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +
                                "                                                                    data-toggle=\"dropdown\">\n" +
                                "                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +
                                "                                                            </a>\n" +
                                "                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +
                                "                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +
                                "                                                                <a class=\"dropdown-item reply\"\n" +
                                "                                                                >{{__('Reply')}}</a>\n" +
                                "                                                        </div>"
                        }
                    }],
                "language":
                    {
                        "sEmptyTable":
                            "هیچ داده ای در جدول وجود ندارد",
                        "sInfo":
                            "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty":
                            "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered":
                            "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix":
                            "",
                        "sInfoThousands":
                            ",",
                        "sLengthMenu":
                            "نمایش _MENU_ رکورد",
                        "sLoadingRecords":
                            "در حال بارگزاری...",
                        "sProcessing":
                            "در حال پردازش...",
                        "sSearch":
                            "جستجو:",
                        "sZeroRecords":
                            "رکوردی با این مشخصات پیدا نشد",
                        "oPaginate":
                            {
                                "sFirst":
                                    "ابتدا",
                                "sLast":
                                    "انتها",
                                "sNext":
                                    "بعدی",
                                "sPrevious":
                                    "قبلی"
                            }
                        ,
                        "oAria":
                            {
                                "sSortAscending":
                                    ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending":
                                    ": فعال سازی نمایش به صورت نزولی"
                            }
                    }
            });

            // compose message
            $("#sub-btn-form1").on('click', function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                $("#form1").block({
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
                    url: '/conversation_view',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form1").unblock(), 2000);
                        document.getElementById('form1').reset();
                        $('#table1').DataTable().ajax.reload();
                        $('#table2').DataTable().ajax.reload();
                        $('#card-form1').hide();
                        $('#card_1').show();
                    },
                    cache: false,
                });
            });

            // reply message
            $("#sub-btn-form2").on('click', function (event) {
                var data = $("#form2").serialize();
                event.preventDefault();
                $('#form2').block({
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
                //token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/conversation_view',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($('#form2').unblock(), 2000);
                        $('#table1').DataTable().ajax.reload();
                        $('#table2').DataTable().ajax.reload();
                        $('#card-form2').hide();
                        $('#card_1').show();
                    },
                    cache: false,
                });
            });

            // fill data in reply form
            $('#table1').on('click', '.reply', function (event) {
                var data = table.row($(this).parents('tr')).data();
                // update status
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/update-status/' + data[4],
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method: 'put',
                    async: false,
                    success: function (data) {
                    },
                    cache: false,
                });
                $('#card_1').hide();
                $('#card-form2').show();
                $('#id').val(data[4]);
                $('#user_receive_id').val(data[5]);
                $('#message_give').val(data[2]);
                $('#name').val(data[1]);
                $('#request_user').text("{{__('Reply Message')}} " + data[1] + " ");
                $('#file_data').val(data[6]);
                if (data[6] != '') {
                    $('#file_show').show();
                }
                // end
            });
            // end filling


            // compose form show
            $('#compose').on('click', function () {
                $('#card_1').hide();
                $('#card-form1').show();
            });

            // compose form show
            $('.compose').on('click', function () {
                $('#card_1').hide();
                $('#card-form1').show();
            });
            {{--end message cartable--}}

            // back to message list
            $('#back_form1').on('click', function () {
                $('#card-form1').hide();
                $('#card_1').show();
            });
            $('#back_form2').on('click', function () {
                $('#card-form2').hide();
                $('#card_1').show();

            });
            // end back

            // select receiver
            $(".select-receiver-user").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/fill-data-limited-user',
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
                placeholder: ('انتخاب کاربر'),
                dir: "rtl",
                templateResult: formatRepo,
                templateSelection: formatRepoSelection2,
                tags: true,
                tokenSeparators: [',', ' ']
            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__statistics").text("{{__('Position')}}" + " : " + repo.position + " " + "{{__('Name')}}" + " : " + repo.text);

                return $container;
            }

            function formatRepoSelection2(repo) {
                return repo.text || repo.id;
            }

            // end

            {{--// onclick on table cell--}}
            {{--$('#table1').on( 'click', 'td', function () {--}}
            {{--var data = table.row($(this).parents('tr')).data();--}}
            {{--// update status--}}
            {{--$.ajaxSetup({--}}
            {{--headers: {--}}
            {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
            {{--});--}}

            {{--$.ajax({--}}
            {{--url: '/update-status/' + data[4],--}}
            {{--type: 'POST',--}}
            {{--data: data,--}}
            {{--dataType: 'json',--}}
            {{--method: 'put',--}}
            {{--async: false,--}}
            {{--success: function (data) {--}}
            {{--},--}}
            {{--cache: false,--}}
            {{--});--}}
            {{--$('#card_1').hide();--}}
            {{--$('#card-form2').show();--}}
            {{--$('#id').val(data[4]);--}}
            {{--$('#user_receive_id').val(data[5]);--}}
            {{--$('#message_give').val(data[2]);--}}
            {{--$('#name').val(data[1]);--}}
            {{--$('#request_user').text("{{__('Reply Message')}} " + data[1] + " ");--}}
            {{--// end--}}
            {{--} );--}}

            // download data file
            $('#file_show').on('click', function (event) {
                window.open('img/request_message_file/' + $('#file_data').val(), '_blank');
            });
            // end
        });
        // save image
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                // فایل نوع آبجکت است
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + '-' + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.pdf,.mp4",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    // اسم اینپوت و مقداری که باید به آن ارسال شود
                    $('#file').val(file.upload.filename);
                    $('#file2').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving
    </script>
@endpush