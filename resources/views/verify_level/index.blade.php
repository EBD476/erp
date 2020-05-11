@extends('layouts.app')

@section('title',__('Verify Order'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    @role('Admin')
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
                                                        "
                                                   class="btn btn-link btn-warning btn-icon btn-sm btn-neutral  edit">
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
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="javascript:void(0)">
                                    {{--<img class="avatar" src="../assets/img/emilyz.jpg" alt="...">--}}
                                    <h5 class="title">Hanta IBMS</h5>
                                </a>
                            </div>
                            </p>
                            <div class="card-description">

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                                    <i class="fab fa-facebook"></i>
                                </button>
                                <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                                    <i class="fab fa-google-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
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