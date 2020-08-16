@extends('layouts.app')

@section('title',__('Finance'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|finance')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary float-left mb-lg-2" id="show-all">
                        {{__('Finance All Product List')}}</button>
                </div>
                {{--List OF new Agreement Order--}}
                <div class="col-md-9" id="card-new-list">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Finance Product List')}}</h4>
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
                                        {{__('Project Name')}}
                                    </th>
                                    <th>
                                        {{__('Paid Code')}}
                                    </th>
                                    <th>
                                        {{__('Type Paid')}}
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
                {{--end--}}
                {{--end--}}
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
                <div class="row">
                    {{--List OF All Agreement Order--}}
                    <div class="col-md-9" id="card-body-all-agreement">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-right font-weight-400">{{__('Finance All Product List')}}</h4>
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
                                            {{__('Project Name')}}
                                        </th>
                                        <th>
                                            {{__('Paid Code')}}
                                        </th>
                                        <th>
                                            {{__('Type Paid')}}
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

            $('#card-body-all-agreement').hide();


            // fill data to new agreement order
            var table5 = $('#table5').DataTable({

                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/invoices-list-finance',
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
                                "                                                                <button class=\"dropdown-item \"  type=\"submit\">{{__('Submit')}}</button>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    }, {
                        "targets": -3,
                        "data": null,
                        "defaultContent": '<input class="form-control code" type="number" name="hf_paid_code">'
                    }, {
                        "targets": -2,
                        "data": null,
                        "defaultContent": ' <div class="row">\n' +
                            '                                                                <div class="col-md-6">\n' +
                            '                                                                    <div class="form-group">\n' +
                            '                                                                        <p class="title">{{__('Cash')}}</p>\n' +
                            '                                                                        <br>\n' +
                            '                                                                        <div class="form-check">\n' +
                            '                                                                            <label class="form-check-label">\n' +
                            '                                                                                <input class="form-check-input type_paid_cash" type="checkbox" name="type_paid_cash">\n' +
                            '                                                                                <span class="form-check-sign">\n' +
                            '                                                                   <span class="check"></span>\n' +
                            '                                                                   </span>\n' +
                            '                                                                            </label>\n' +
                            '                                                                        </div>\n' +
                            '                                                                    <br>\n' +
                            '                                                                </div>\n' +
                            '                                                                </div>\n' +
                            '                                                                <div class="col-md-6">\n' +
                            '                                                                    <div class="form-group">\n' +
                            '                                                                        <p class="title">{{__('Czech')}}</p>\n' +
                            '                                                                        <br>\n' +
                            '                                                                        <div class="form-check">\n' +
                            '                                                                            <label class="form-check-label">\n' +
                            '                                                                                <input class="form-check-input type_paid_czech" type="checkbox"  name="type_paid_czech">\n' +
                            '                                                                                <span class="form-check-sign">\n' +
                            '                                                                   <span class="check"></span>\n' +
                            '                                                                   </span>\n' +
                            '                                                                            </label>\n' +
                            '                                                                        </div>\n' +
                            '                                                                        <br>\n' +
                            '                                                                    </div>\n' +
                            '                                                                </div>\n' +
                            '                                                            </div>'
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
            $('#table5').on('click', 'button', function (event) {
                var data_table = table5.row($(this).parents('tr')).data();
                var cell = $('#table5 tr').index($(this).closest('tr'));
                var code = table5.cell(parseInt(cell - 1), 2).nodes().to$().find('input').val();
                var data = {
                    id: data_table[2],
                    code: code,
                    type_paid_cash: table5.cell(parseInt(cell - 1), 3).nodes().to$().find('input[name="type_paid_cash"]').prop('checked') ? 1 : 0,
                    type_paid_czech: table5.cell(parseInt(cell - 1), 3).nodes().to$().find('input[name="type_paid_czech"]').prop('checked') ? 1 : 0,
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
                                url: '/finance/' + data.id,
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                async: false,
                                method: 'PUT',
                                success: function (data) {
                                    swal("{{__("The process was successfully completed.")}}", {
                                        icon: "success",
                                        button: "{{__('Done')}}",
                                    });
                                    $('#table5').DataTable().ajax.reload();
                                },
                                cache: false,
                            });
                        } else {
                            swal(
                                "{{__("Your imaginary file is safe!")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            // end

            $('#show-all').on('click', function (event) {
                $('#table6').on('draw.dt', function (e, settings, json, xhr){
                        $('.type_paid_cash').each(function () {
                            var data = table6.row($(this).parents('tr')).data();
                            data[4] == 'نقد' ? $(this)[0].click() : 0;
                    });
                        $('.type_paid_czech').each(function () {
                            var data = table6.row($(this).parents('tr')).data();
                            data[4] == 'چک' ? $(this)[0].click() : 0;
                    });
                });
                // fill data to all agreement order
                var table6 = $('#table6').DataTable({

                    "processing":
                        true,
                    "serverSide":
                        true,
                    "ajax":
                        '/invoices-list-finance-all',
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
                                    "                                                               <a target=\"_blank\"  href=\"verify_pre/" + data[2] + "/edit\" class=\"dropdown-item\"\n" +
                                    "                                                                >{{__('Preview Factor')}}</a>\n" +
                                    "                                                            </div>\n" +
                                    "                                                        </div>"
                            }
                        }, {
                            "targets": -3,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return '<input class="form-control code" type="number" name="hf_paid_code" disabled value="' + data[3] + '">'
                            }
                        }, {
                            "targets": -2,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return ' <div class="row">\n' +
                                    '                                                                <div class="col-md-6">\n' +
                                    '                                                                    <div class="form-group">\n' +
                                    '                                                                        <p class="title">{{__('Cash')}}</p>\n' +
                                    '                                                                        <br>\n' +
                                    '                                                                        <div class="form-check">\n' +
                                    '                                                                            <label class="form-check-label">\n' +
                                    '                                                                                <input class="form-check-input type_paid_cash" type="checkbox" name="type_paid_cash">\n' +
                                    '                                                                                <span class="form-check-sign">\n' +
                                    '                                                                   <span class="check"></span>\n' +
                                    '                                                                   </span>\n' +
                                    '                                                                            </label>\n' +
                                    '                                                                        </div>\n' +
                                    '                                                                    <br>\n' +
                                    '                                                                </div>\n' +
                                    '                                                                </div>\n' +
                                    '                                                                <div class="col-md-6">\n' +
                                    '                                                                    <div class="form-group">\n' +
                                    '                                                                        <p class="title">{{__('Czech')}}</p>\n' +
                                    '                                                                        <br>\n' +
                                    '                                                                        <div class="form-check">\n' +
                                    '                                                                            <label class="form-check-label">\n' +
                                    '                                                                                <input class="form-check-input type_paid_czech" type="checkbox"  name="type_paid_czech">\n' +
                                    '                                                                                <span class="form-check-sign">\n' +
                                    '                                                                   <span class="check"></span>\n' +
                                    '                                                                   </span>\n' +
                                    '                                                                            </label>\n' +
                                    '                                                                        </div>\n' +
                                    '                                                                        <br>\n' +
                                    '                                                                    </div>\n' +
                                    '                                                                </div>\n' +
                                    '                                                            </div>'
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
                $('#card-body-all-agreement').show();
            });

        });
    </script>


@endpush