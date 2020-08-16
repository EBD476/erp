@extends('layouts.app')

@section('title',__('QC'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|qc')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('List of Product Waiting to be QC')}}</h4>
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
                            <h4 class="card-title text-right font-weight-400">{{__('List of QC Product')}}</h4>
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
                {{--Repository Product Data List--}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('inventory Repository Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" cellspacing="0" width="100%" id="table">
                                    <thead>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Product Name')}}
                                    </th>
                                    <th>
                                        {{__('Stock')}}
                                    </th>
                                    <th>
                                        {{__('Provider')}}
                                    </th>
                                    <th>
                                        {{__('Repository')}}
                                    </th>
                                    <th>
                                        {{__('Comment')}}
                                    </th>
                                    <th>
                                        {{__('Entry Date')}}
                                    </th>
                                    <th>
                                        {{__('Exit Date')}}
                                    </th>
                                    <th>
                                        {{__('Return Value')}}
                                    </th>
                                    <th>
                                        {{__('Contradiction')}}
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
                {{--End Repository Product Data List--}}
                {{--//Edit Product Repository Modal//--}}
                <div class="modal fade" id="modalRegisterForm1" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-landscape">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">{{__('Edit inventory Product')}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form1">
                                <div class="modal-body">
                                    <div class="md-form mb-5">
                                        <input id="product_id" hidden>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="bmd-label-floating"
                                                       style="float: right ; margin-top: -10px">{{__('Product Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-product"
                                                            name="hr_product_id" id="hr_product_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bmd-label-floating"
                                                       style="float: right ; margin-top: -10px">{{__('Provider')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-provider-1"
                                                            id="hr_provider_code" name="hr_provider_code">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bmd-label-floating"
                                                       style="float: right ; margin-top: -15px">{{__('Origin Repository Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="hr_repository_id">
                                                        <option id="hr_repository_id"></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bmd-label-floating"
                                                       style="float: right ; margin-top: -15px">{{__('goal Repository Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control repository-goal-1" name="hr_repository_id_goal">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Repository Inventory')}}</label>
                                                    <input type="number" class="form-control" required=""
                                                           aria-invalid="false" id="hr_product_stock1" disabled>
                                                    <input hidden id="hr_product_stock" name="hr_product_stock">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating" style="float: right">{{__('Count')}}</label>
                                                    <input type="number" class="form-control" required=""
                                                           aria-invalid="false" id="hr_count" name="hr_count">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Entry Date')}}</label>
                                                    <input class="form-control"
                                                           aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Exit')}}</label>
                                                    <input class="form-control"
                                                           aria-invalid="false" name="hr_exit" id="test-date-id-3"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Contradiction')}}</label>
                                                    <input class="form-control"
                                                           aria-invalid="false" name="hr_contradiction" id="hr_contradiction"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Return Value')}}</label>
                                                    <input class="form-control"
                                                           aria-invalid="false" name="hr_return_value" id="hr_return_value"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"
                                                           style="float: right">{{__('Status Return Part')}}</label>
                                                    <input class="form-control"
                                                           aria-invalid="false" name="hr_status_return_part"
                                                           id="hr_status_return_part"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating" style="float: right">{{__('Comment')}}</label>
                                                    <textarea class="form-control" required=""
                                                              aria-invalid="false" id="hr_comment" name="hr_comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--end modal--}}
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function () {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('#table5').on('click', 'button', function (event) {

                var cdata = table5.row($(this).parents('tr')).data();
                var data = {
                    id: cdata[5],
                    state:5,
                    all:1,
                };
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
                                url: '/qc/' + data.id,
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                async: false,
                                method: 'put',
                                success: function (data) {
                                    swal("{{__("success")}}", {
                                        icon: "success",
                                        button: "{{__('Done')}}",
                                    });
                                },
                                cache: false,
                            });
                            $('#table5').DataTable().ajax.reload();
                            $('#table6').DataTable().ajax.reload();
                        } else {
                            swal(
                                "{{__("Your imaginary file is safe!")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            var table5 = $('#table5').on('draw.dt', function (e, settings, json, xhr) {
                $('.js-switch').each(function () {
                    var data = table5.row($(this).parents('tr')).data();
                    var switchery = new Switchery($(this)[0], $(this).data());
                    $(this)[0].onchange = function () {
                        var cdata = table5.row($(this).parents('tr')).data();
                        var data = {
                            id: cdata[6],
                            state: $(this)[0].checked == true ? 5 : 4,
                            all:0,
                        };
                        //token
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/qc/' + data.id,
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
                "initComplete": function (settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-qc',
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
                                "                                                                <button class=\"dropdown-item deleted\" type=\"submit\">{{__('Verify All Order')}}</button>\n" +
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
                                return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}} "  + data[2] + "<br><br> {{__('Client Name')}} : "  + data[3] + "<br><br> {{__('Due Date')}} : "  + data[4] +"<br><br> {{__('Type Project')}} : "  + data[12] + "<br><br> {{__('Contract Type')}} : "  + data[13] + "<br><br> {{__('Owner User')}} : "  + data[14] + "\">\"" + data[1] + "</span>"
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
                            },
                    }
            })


            $('#table6').DataTable({
                "initComplete": function (settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-qc-all',
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
                            "targets": 1,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                {{--return ' <span  data-toggle="tooltip" data-html="true" title=" {{__('Project Name')}} ' + data[2] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Deu Date')}} : ' + data[4] + ' <br><br> {{__('Description')}} : ' + data[8] + ' <br><br> {{__('Client Name')}} : ' + data[3] + ' <br><br> {{__('Address')}} : ' + data[10] + ' <br><br> {{__('Phone Number')}} : ' + data[11] + ' <br><br> {{__('Type Project')}} : ' + data[12] + ' <br><br> {{__('Contract Type')}} : ' + data[13] + ' <br><br> {{__('Owner User')}} : ' + data[14] + ' <br><br> {{__('Connector')}} : ' + data[15] + ' <br><br> {{__('Product Name')}} : ' + data[16] + ' ">' + data[1] + '</span>'--}}
                                    return " <span  data-toggle=\"tooltip\" data-html=\"true\" title=\"{{__('Project Name')}}"  + data[2] + "<br><br> {{__('Client Name')}} : "  + data[3] + "<br><br> {{__('Due Date')}} :<br>"  + data[4] +"<br><br> {{__('Verify QC Date')}} :<br>"  + data[10] + "<br><br> {{__('Type Project')}} : "  + data[12] + "<br><br> {{__('Contract Type')}} :"  + data[13] + "<br><br> {{__('Owner User')}} :"  + data[14] + "\">\"" + data[1] + "</span>"
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


            // fill and show repository product data
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
                                url: '/repository-product-destroy/' + data[14],
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
                "initComplete": function(settings, json) {
                    $('[data-toggle="tooltip"]').tooltip({template: '<div class="tooltip tooltip-custom"><div class="title"></div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'});
                },
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-fill-repository-qc',
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
                                "                                                                <a class=\"dropdown-item edit-product\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                    {{--"                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +--}}
                                        "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    },
                        {
                            "targets":5,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return ' <span  data-toggle="tooltip" data-html="true" title="' + data[5] + '" >' + data[5] + '</span>'
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
            // end

            // fill data in select product
            $(".select-product").select2({
                ajax: {
                    url: '/json-data-fill_data_repository_product',
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
                dir: 'rtl',
                placeholder: ('انتخاب محصول'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
                // allowClear: true

            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }
                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/products/" + repo.hp_product_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    // "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
                    // "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
                    // "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Price')}}" + " : " + repo.hp_product_price);
                $container.find(".select2-result-repository__color").text("{{__('Color')}}" + " : " + repo.hn_color_name);
                $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.hpp_property_name + repo.hppi_items_name);
                // $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
                // $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
                // $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");
                return $container;

            }

            function formatRepoSelection(repo) {
                return repo.text
            }

            // end filling

            // pass product data
            $("#form1").submit(function (event) {
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
                    url: '/inventory-product',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form1").unblock(), 2000);
                        document.getElementById("form1").reset();
                        $('#table').DataTable().ajax.reload();
                        $("#modalRegisterForm1").modal('hide');


                    },
                    cache: false,
                });
            });

            // select-provider for modal form1
            $(".select-provider-1").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/json-data-fill-data-provider',
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
                placeholder: ('انتخاب تامین کننده'),
                dir: "rtl",
                dropdownParent: $('#modalRegisterForm1'),
                templateResult: formatRepo11,
                templateSelection: formatRepoSelection11
            });
            function formatRepo11(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    // "<div class='select2-result-repository__avatar'><img src='/img/parts/" + repo.hp_part_image + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text("{{__('Name')}}" + " : " + repo.text);
                $container.find(".select2-result-repository__description").text("{{__('Title')}}" + " : " + repo.hp_title);

                return $container;
            }
            function formatRepoSelection11(repo) {
                return repo.text || repo.id;
            }
            // end


            // select-repository-goal for modal form1
            $(".repository-goal-1").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/fill-repository-name',
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
                placeholder: ('انتخاب انبار مقصد'),
                dir: "rtl",
                dropdownParent: $('#modalRegisterForm1'),
                templateSelection: formatRepoSelection_repository_goal_1,
            });
            function formatRepoSelection_repository_goal_1(repo) {
                return repo.text || repo.id;
            }
            // end

            // fiil edit form
            $('#table').on('click', '.edit-product', function (event) {
                $("#modalRegisterForm1").modal();
                var data = table.row($(this).parents('tr')).data();
                $('#product_id').val(data[14]);
                $("#hr_product_id").append('<option selected value="' + data[13] + '">' + data[1] + '</option>');
                $('#hr_product_stock').val(data[2]);
                $('#hr_product_stock1').val(data[2]);
                $("#hr_provider_code").append('<option selected value="' + data[11] + '">' + data[3] + '</option>');
                $("#hr_repository_id").text(data[4]);
                $('#test-date-id').val(data[6]);
                $('#test-date-id-3').val(data[7]);
                $('#hr_return_value').val(data[8]);
                $('#hr_contradiction').val(data[9]);
                $('#hr_status_return_part').val(data[10]);
                $('#hr_comment').val(data[5]);
                $("#hr_repository_id").val(data[12]);

            })
            // end
        });




        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
        kamaDatepicker('test-date-id-3', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
@endpush