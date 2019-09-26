@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{route('repository.create')}}"
                   class="btn btn-primary">{{__('Add New Repository')}}</a>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Repository')}}</h4>
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
                                            {{__('Product Id')}}
                                        </th>
                                        <th>
                                            {{__('Product Stock')}}
                                        </th>
                                        <th>
                                            {{__('Comment')}}
                                        </th>
                                        </thead>
                                        <tbody>

                                        @foreach($Repositories as $key => $Repositories)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{$Repositories -> Product_Id}}
                                                </td>
                                                <td>
                                                    {{$Repositories ->Product_Stock}}
                                                </td>
                                                <td>
                                                    {{$Repositories -> Comment}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Order List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table1" class="table" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Order ID')}}
                                        </th>
                                        <th>
                                            {{__('Client ID')}}
                                        </th>
                                        <th>
                                            {{__('Product ID')}}
                                        </th>
                                        <th>
                                            {{__('Count')}}
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $key => $orders )
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{$orders -> hpo_order_id}}
                                                </td>
                                                <td>
                                                    {{$orders ->hpo_client_id}}
                                                </td>
                                                <td>
                                                    {{$orders ->hpo_product_id}}
                                                </td>
                                                <td>
                                                    {{$orders ->hpo_count}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">333
                        <div class="card-body">
                            @foreach( $products_count as $products_count )
                                <label>{{$products_count}}</label>
                            @endforeach
                        </div>
                    </div>
                    {{--@foreach($count as $counts)--}}
                    {{--<label class="form-control">{{__('Sub Total')}}{{$order->hop_product_id}}:{{$counts}}</label>--}}
                    {{--@endforeach--}}
                </div>
            </div>
        </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#table').DataTable({
                        "language": {
                            "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                            "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                            "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                            "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ",",
                            "sLengthMenu": "نمایش _MENU_ رکورد",
                            "sLoadingRecords": "در حال بارگزاری...",
                            "sProcessing": "در حال پردازش...",
                            "sSearch": "جستجو:",
                            "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                            "oPaginate": {
                                "sFirst": "ابتدا",
                                "sLast": "انتها",
                                "sNext": "بعدی",
                                "sPrevious": "قبلی"
                            },
                            "oAria": {
                                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                            },

                        }
                    });
                    $('#table1').DataTable({
                        "language": {
                            "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                            "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                            "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                            "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ",",
                            "sLengthMenu": "نمایش _MENU_ رکورد",
                            "sLoadingRecords": "در حال بارگزاری...",
                            "sProcessing": "در حال پردازش...",
                            "sSearch": "جستجو:",
                            "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                            "oPaginate": {
                                "sFirst": "ابتدا",
                                "sLast": "انتها",
                                "sNext": "بعدی",
                                "sPrevious": "قبلی"
                            },
                            "oAria": {
                                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                            },

                        }
                    });
                });
            </script>
    @endpush