@extends('layouts.app')

@section('title', __('Hanta Enterprise Resource Planning'))

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
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
                                    <p class="card-category">{{__('Total Orders')}}</p>
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
                                    <p class="card-category">{{__('Order queue')}}</p>
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
                                    <p class="card-category">{{__('Agreement')}}</p>
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
                                    <p class="card-category">{{__('Total Customers')}}</p>
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
                                        <td>
                                            {{$order->id }}
                                        </td>
                                        <td>
                                            {{$order->hp_project_name }}
                                        </td>
                                        <td>
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
                                    <p class="card-category">{{__('Total Orders')}}</p>
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
                                    <p class="card-category">{{__('Order queue')}}</p>
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
                                    <p class="card-category">{{__('Agreement')}}</p>
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
                                    <p class="card-category">{{__('Total Customers')}}</p>
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
                                    <p class="card-category">{{__('Total Orders')}}</p>
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
                                    <p class="card-category">{{__('Order queue')}}</p>
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
                                    <p class="card-category">{{__('Agreement')}}</p>
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
                                    <p class="card-category">{{__('Total Customers')}}</p>
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
        </div>
    </div>
    @endrole
    @role('repository')
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

        {{--<div class="row">--}}
        {{--<div class="col-lg-3 col-md-6">--}}
        {{--<div class="card card-stats">--}}
        {{--<div class="card-body">--}}
        {{--<div class="row">--}}
        {{--<div class="col-5">--}}
        {{--<div class="info-icon text-center icon-warning">--}}
        {{--<i class="tim-icons icon-puzzle-10"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-7">--}}
        {{--<div class="numbers">--}}
        {{--<p class="card-category">{{__('Total Orders')}}</p>--}}
        {{--<h3 class="card-title">{{$orders}}</h3>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-footer">--}}
        {{--<hr>--}}
        {{--<div class="stats">--}}
        {{--<i class="tim-icons icon-refresh-01"></i> Update Now--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-3 col-md-6">--}}
        {{--<div class="card card-stats">--}}
        {{--<div class="card-body">--}}
        {{--<div class="row">--}}
        {{--<div class="col-5">--}}
        {{--<div class="info-icon text-center icon-primary">--}}
        {{--<i class="tim-icons icon-single-copy-04"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-7">--}}
        {{--<div class="numbers">--}}
        {{--<p class="card-category">{{__('Order queue')}}</p>--}}
        {{--<h3 class="card-title">{{$order_req}}</h3>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-footer">--}}
        {{--<hr>--}}
        {{--<div class="stats">--}}
        {{--<i class="tim-icons icon-sound-wave"></i> Last Research--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-3 col-md-6">--}}
        {{--<div class="card card-stats">--}}
        {{--<div class="card-body">--}}
        {{--<div class="row">--}}
        {{--<div class="col-5">--}}
        {{--<div class="info-icon text-center icon-success">--}}
        {{--<i class="tim-icons icon-world"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-7">--}}
        {{--<div class="numbers">--}}
        {{--<p class="card-category">{{__('Agreement')}}</p>--}}
        {{--<h3 class="card-title">{{$agreement}}</h3>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-footer">--}}
        {{--<hr>--}}
        {{--<div class="stats">--}}
        {{--<i class="tim-icons icon-trophy"></i> Customers feedback--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-lg-3 col-md-6">--}}
        {{--<div class="card card-stats">--}}
        {{--<div class="card-body">--}}
        {{--<div class="row">--}}
        {{--<div class="col-5">--}}
        {{--<div class="info-icon text-center icon-danger">--}}
        {{--<i class="tim-icons icon-single-02"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-7">--}}
        {{--<div class="numbers">--}}
        {{--<p class="card-category">{{__('Total Customers')}}</p>--}}
        {{--<h3 class="card-title">{{$client}}</h3>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-footer">--}}
        {{--<hr>--}}
        {{--<div class="stats">--}}
        {{--<i class="tim-icons icon-watch-time"></i> In the last hours--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
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
                                    <p class="card-category">{{__('Product Requirement')}}</p>
                                    @foreach($Repositories_Requirement as $Repositories_Requirement)
                                        <h3 class="card-title">{{$Repositories_Requirement->sum_hpo}}</h3>
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
                                    <p class="card-category">{{__('Order queue')}}</p>
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
                                    <p class="card-category">{{__('Returned')}}</p>
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
                                    <p class="card-category"></p>
                                    <h3 class="card-title"></h3>
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
                                    <p class="card-category">{{__('Total Orders')}}</p>
                                    <h3 class="card-title">{{$order_order}}</h3>
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
                                    <p class="card-category">{{__('Order queue')}}</p>
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
                                    <p class="card-category">{{__('Agreement')}}</p>
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
                                    <p class="card-category">{{__('Total Customers')}}</p>
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
        </div>


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
                                                    {{$status->hp_process_name}}
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
@endsection

@push('scripts')

    {{--    <script type="text/javascript" src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
    <script src="{{asset('assets/js/demo.js')}}"></script>

    <script>
        $(document).ready(function () {

            demo.initDashboardPageCharts();

            var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

            /**** Scroller ****/

            // if ($.fn.niceScroll){
            //     var mainScroller = $("html").niceScroll({
            //         zindex:999999,
            //         boxzoom:true,
            //         cursoropacitymin :0.5,
            //         cursoropacitymax :0.8,
            //         cursorwidth :"10px",
            //         cursorborder :"0px solid",
            //         autohidemode:false
            //     });
            // };

            /*** PerfectScrollbar ****/

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


        });
    </script>
@endpush