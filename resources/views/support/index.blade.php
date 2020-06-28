@extends('layouts.app')

@section('title',__('Support'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin|support')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('support.show')}}" class="btn btn-primary float-left mb-lg-2"><i
                                class="tim-icons icon-simple-add"></i>{{__('All Support Request List')}}</a>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">{{__('Projects List')}}</h4>
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
                                                    {{__('Project Name')}}
                                                </th>
                                                <th>
                                                    {{__('Created at')}}
                                                </th>
                                                <th>
                                                    {{__('Action')}}
                                                </th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">{{__('Support Request')}}</h4>
                                        <p class="card-category"></p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="table2" class="table" cellspacing="0" width="100%">
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
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script>
        $(document).ready(function () {
             $('#table1').DataTable({
                 "initComplete": function(settings, json) {
                     $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                 },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-projects',
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
                                "                                                                <a href=\"projects/" + data[5] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                "                                                                <a href=\"verify_pre/" + data[4] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Preview Detail')}}</a>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    },
                        {
                            "targets": 1,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}} "  + data[2] + "<br><br> {{__('Client Name')}} : "  + data[3] + "<br><br> {{__('Due Date')}} : "  + data[4] +"<br><br> {{__('Address')}} :"  + data[10] +  "<br><br> {{__('Phone Number')}} : "  + data[11] + "<br><br> {{__('Type Project')}} : "  + data[12] + "<br><br> {{__('Contract Type')}} : "  + data[13] + "<br><br> {{__('Owner User')}} : "  + data[14] + "\">\"" + data[1] + "</span>"
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
            $('#table2').DataTable({
                "initComplete": function(settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-support',
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
                                "                                                                <a href=\"support/" + data[4] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Show')}}</a>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                        },
                        {
                            "targets": 1,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Title')}} : "  + data[1] + "<br><br> {{__('Project Name')}} : "  + data[2] + "<br><br> {{__('Request User Name')}} : "  + data[6] +"<br><br> {{__('Description')}} :"  + data[5] +  "<br><br> {{__('Created at')}} : "  + data[3] + "\">\"" + data[1] + "</span>"
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