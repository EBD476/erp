@extends('layouts.app')

@section('title',__('Verify Order'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                                        {{__('Product Name')}}
                                    </th>
                                    <th>
                                        {{__('Count')}}
                                    </th>

                                    <th>
                                        {{__('Create At')}}
                                    </th>

                                    <th>
                                        {{__('Accept State')}}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $key => $product)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$product->hp_product_name}}
                                            </td>
                                            <td>
                                                {{$product->hp_product_name}}
                                            </td>
                                            <td>
                                                {{$product->created_at}}
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

            </div>
        </div>
    </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
            <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
            <script>
                $(document).ready(function () {

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    $('#table').on('click', 'button', function (event) {

                        var data = table.row($(this).parents('tr')).data();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        swal({
                            // title: "",
                            text: "{{__('Are you sure?')}}",
                            buttons: ["{{__('cancel')}}", "{{__('Done')}}"],
                            icon: "warning",
                            // buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        url: '/order-destroy/' + data[0],
                                        type: 'delete',
                                        data: data,
                                        dataType: 'json',
                                        async: false,
                                        success: function (data) {
                                            swal("{{__("Poof! Your imaginary file has been deleted!")}}", {
                                                icon: "success",
                                                button: "{{__('Done')}}",
                                            });
                                        },
                                        cache: false,
                                    });
                                    location.reload();
                                } else {
                                    swal(
                                        "{{__("Your imaginary file is safe!")}}",
                                        {button: "{{__('Done')}}"}
                                    );

                                }
                            });
                    });
                    var table = $('#table').on('draw.dt', function (e, settings, json, xhr) {
                        }).DataTable({

                            "processing":
                                true,
                            "serverSide":
                                true,
                            "ajax":
                                '/json-data-order',
                            "columnDefs":
                                [{
                                    "targets": -1,
                                    "data": null,
                                    "defaultContent": "  <div class=\"dropdown\">\n" +
                                        "                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +
                                        "                                                                    data-toggle=\"dropdown\">\n" +
                                        "                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +
                                        "                                                            </a>\n" +
                                        "                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +
                                        "                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +
                                        "                                                                <a href=\"{{route('order.edit',113)}}\" class=\"dropdown-item\"\n" +
                                        "                                                                >{{__('Edit')}}</a>\n" +
                                        "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
                                        "                                                            </div>\n" +
                                        "                                                        </div>"
                                }, {
                                    "targets": -2,
                                    "data": null,
                                    "defaultContent": '  <div class="progress">\n' +
                                        '                                                            @foreach($order as $orders)\n' +
                                        '                                                            @foreach($progress as $progresses)\n' +
                                        // '                                                                <span class="progress-value">25%</span>\n' +
                                        '                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 25%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 50%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width: 75%;"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )\n' +
                                        '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                        '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                        '                                                                         aria-valuemax="100"\n' +
                                        '                                                                         style="width:100%; direction: ltr"></div>\n' +
                                        '                                                                @endif\n' +
                                        '                                                            @endforeach\n' +
                                        '                                                            @endforeach\n' +
                                        '                                                        </div>'
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
                        })
                    ;
                });
            </script>
    @endpush