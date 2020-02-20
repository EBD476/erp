@extends('layouts.app')

@section('title',__('Verify Order'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Verify Order')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Create At')}}
                                    </th>
                                    <th>
                                        {{__('Accept State')}}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($order as $key => $order)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$order->hp_project_name}}
                                            </td>
                                            <td>
                                                {{$order->created_at}}
                                            </td>
                                            <td>
{{--                                                @can('browse-btn-user')--}}
                                               <a class="nav-link" href="{{route('verify_pre.edit',[$order->id])}}
                                                       " class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
                                                   <i class="tim-icons icon-pencil"></i></a>
                                                {{--@endcan--}}
                                            </td>
                                            {{--<td>--}}
                                                {{--<a href="{{route('verify_pre.create')}}" class="btn btn-primary">{{__('send')}}</a>--}}
                                            {{--</td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <br><br>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right">{{__('Projects Locations')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div  id="map" style="width: 100%; height: 400px;direction: ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
            {{--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>--}}
            {{--<script>--}}
                {{--$(document).ready(function() {--}}
                {{--$('#table').DataTable({--}}
                    {{--"language": {--}}
                        {{--"sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",--}}
                        {{--"sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",--}}
                        {{--"sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",--}}
                        {{--"sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",--}}
                        {{--"sInfoPostFix":    "",--}}
                        {{--"sInfoThousands":  ",",--}}
                        {{--"sLengthMenu":     "نمایش _MENU_ رکورد",--}}
                        {{--"sLoadingRecords": "در حال بارگزاری...",--}}
                        {{--"sProcessing":     "در حال پردازش...",--}}
                        {{--"sSearch":         "جستجو:",--}}
                        {{--"sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",--}}
                        {{--"oPaginate": {--}}
                            {{--"sFirst":    "ابتدا",--}}
                            {{--"sLast":     "انتها",--}}
                            {{--"sNext":     "بعدی",--}}
                            {{--"sPrevious": "قبلی"--}}
                        {{--},--}}
                        {{--"oAria": {--}}
                            {{--"sSortAscending":  ": فعال سازی نمایش به صورت صعودی",--}}
                            {{--"sSortDescending": ": فعال سازی نمایش به صورت نزولی"--}}
                        {{--}--}}
                    {{--}--}}
                {{--} );--}}
                {{--});--}}
            {{--</script>--}}
    @endpush