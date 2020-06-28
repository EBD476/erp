@extends('layouts.app')

@section('title',__('Show Response List'))

@push('script')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
@endpush


@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
@endpush

@section('content')
    @role('Admin|order')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Support Response List')}}</h4>
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
                                        {{__('Title')}}
                                    </th>

                                    <th>
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Status')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('action')}}
                                    </th>
                                    </thead>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {
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
                                url: '/projects-destroy/' + data[5],
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
                            $('#table').DataTable().ajax.reload();
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
                    '/json-data-fill-response',
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
                                "                                                                <a href=\"show_response/" + data[5] + "\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Show Response')}}</a>\n" +
                                "                                                            </div>\n" +
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
        });
    </script>
@endpush