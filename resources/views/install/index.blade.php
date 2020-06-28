@extends('layouts.app')

@section('title',__('Install'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|install')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('List of Product Waiting to be Install')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table id="table5" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Invoices Number')}}
                                    </th>
                                    <th>
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Client Name')}}
                                    </th>
                                    <th>
                                        {{__('Due Date')}}
                                    </th>
                                    <th>
                                        {{__('Status')}}
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
                            <h4 class="card-title text-right font-weight-400">{{__('List of Install Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table id="table6" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Invoices Number')}}
                                    </th>
                                    <th>
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Client Name')}}
                                    </th>
                                    <th>
                                        {{__('Due Date')}}
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
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            var table5 = $('#table5').on('draw.dt', function (e, settings, json, xhr) {
                $('.js-switch').each(function () {
                    var switchery = new Switchery($(this)[0], $(this).data());

                    $(this)[0].onchange = function () {
                        var cdata = table5.row($(this).parents('tr')).data();
                        var data = {
                            id: cdata[5],
                            state: $(this)[0].checked == true ? 7 : 5,
                        };
                        //token
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/install/' + data.id,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            method: 'put',
                            success: function (data) {
                                swal({
                                    title: "",
                                    text: "{{__('success')}}",
                                    icon: "success",
                                    button: "{{__('Done')}}"
                                })
                            },
                            cache: false,
                        });
                        $('#table5').DataTable().ajax.reload();
                        $('#table6').DataTable().ajax.reload();
                    }
                })
            }).DataTable({
                "initComplete": function(settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-install',
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
                                "                                                               <a target=\"_blank\"  href=\"verify_pre/" + data[5] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('View Detail Factor')}}</a>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    },
                        {
                            "targets": -2,
                            "data": null,
                            "defaultContent": '<input type="checkbox" class="js-switch" data-size="small">'
                        },
                        {
                            "targets": 1,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                {{--return ' <span  data-toggle="tooltip" data-html="true" title=" {{__('Project Name')}} ' + data[2] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Deu Date')}} : ' + data[4] + ' <br><br> {{__('Description')}} : ' + data[8] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Address')}} : ' + data[10] + ' <br><br> {{__('Phone Number')}} : ' + data[11] + ' <br><br> {{__('Type Project')}} : ' + data[12] + ' <br><br> {{__('Contract Type')}} : ' + data[13] + ' <br><br> {{__('Owner User')}} : ' + data[14] + ' <br><br> {{__('Connector')}} : ' + data[15] + ' <br><br> {{__('Product Name')}} : ' + data[16] + ' ">' + data[1] + '</span>'--}}
                                    return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}} "  + data[2] + "<br><br> {{__('Client Name')}} : "  + data[3] + "<br><br> {{__('Due Date')}} : "  + data[4] +"<br><br> {{__('Address')}} :"  + data[10] +  "<br><br> {{__('Phone Number')}} : "  + data[11] + "<br><br> {{__('Type Project')}} : "  + data[12] + "<br><br> {{__('Contract Type')}} : "  + data[13] + "<br><br> {{__('Owner User')}} : "  + data[14] + "\">\"" + data[1] + "</span>"
                            },
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
        });
        $('#table6').DataTable({
            "initComplete": function(settings, json) {
                $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
            },
            "processing":
                true,
            "serverSide":
                true,
            "ajax":
                '/json-data-install-all',
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
                            "                                                               <a target=\"_blank\"  href=\"verify_pre/" + data[5] + "/edit\" class=\"dropdown-item\"\n" +
                            "                                                                >{{__('Preview Detail')}}</a>\n" +
                            "                                                            </div>\n" +
                            "                                                        </div>"
                    }
                    },
                    {
                        "targets": 1,
                        "data": null,
                        "render": function (data, type, row, meta) {
                            {{--return ' <span  data-toggle="tooltip" data-html="true" title=" {{__('Project Name')}} ' + data[2] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Deu Date')}} : ' + data[4] + ' <br><br> {{__('Description')}} : ' + data[8] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Address')}} : ' + data[10] + ' <br><br> {{__('Phone Number')}} : ' + data[11] + ' <br><br> {{__('Type Project')}} : ' + data[12] + ' <br><br> {{__('Contract Type')}} : ' + data[13] + ' <br><br> {{__('Owner User')}} : ' + data[14] + ' <br><br> {{__('Connector')}} : ' + data[15] + ' <br><br> {{__('Product Name')}} : ' + data[16] + ' ">' + data[1] + '</span>'--}}
                                return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}} "  + data[2] + "<br><br> {{__('Client Name')}} : "  + data[3] + "<br><br> {{__('Due Date')}} : "  + data[4] +"<br><br> {{__('Address')}} :"  + data[10] +  "<br><br> {{__('Phone Number')}} : "  + data[11] + "<br><br> {{__('Type Project')}} : "  + data[12] + "<br><br> {{__('Contract Type')}} : "  + data[13] + "<br><br> {{__('Owner User')}} : "  + data[14] + "\">\"" + data[1] + "</span>"
                        },
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
    </script>
@endpush