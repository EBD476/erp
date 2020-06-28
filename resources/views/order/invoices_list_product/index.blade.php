@extends('layouts.app')

@section('title',__('Invoices List'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin||product')
    <div class="content persian">
        <div class="container-fluid">
            {{--Requirement Product List--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-tasks">
                        {{--Drop Done Show Details Product List--}}
                        <div class="card-header ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Order List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="dropdown">
                                <h6 class="title d-inline">{{__('Inventory Deficit')}}</h6>
                                <button type="button" class="btn btn-link dropdown-toggle btn-icon"
                                        data-toggle="dropdown">
                                    <i class="tim-icons icon-settings-gear-63"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                       data-target="#modalRegisterForm">{{__('Details')}}</a>
                                    {{--<a class="dropdown-item" href="#pablo">Another action</a>--}}
                                    {{--<a class="dropdown-item" href="#pablo">Something else</a>--}}
                                </div>
                            </div>
                        </div>
                        {{--End Dropd Show Details Product List--}}

                        <div class="card-body ">
                            <div class="table-full-width table-responsive ps ps--active-y">
                                <table class="table" id="table5">
                                    <thead>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Invoices Number')}}</th>
                                    <th>{{__('Product Name')}}</th>
                                    <th>{{__('Count')}}</th>
                                    <th>{{__('Inventory After Exit Final Repository')}}</th>
                                    <th>{{__('Inventory After Exit')}}</th>
                                    <th>{{__('Due Date')}}</th>
                                    <th>{{__('Start The Process')}}</th>
                                    <th>{{__('Status Invoice')}}</th>
                                    <th>{{__('Status Verify')}}</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--End Requirement Product List--}}

            {{-- Repository List--}}
            {{--Repository Product Data List--}}
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('inventory Repository Product')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table2" cellspacing="0" width="100%">
                                <thead class=" text-primary">
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
                                    {{__('Repository')}}
                                </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{--End Repository Product Data List--}}
            <div class="row">
                <div class="col-md-12">
                    {{--Repository Middle Part List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Repository Middle Part List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="table3" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Name')}}
                                        </th>
                                        <th>
                                            {{__('Stock')}}
                                        </th>
                                        <th>
                                            {{__('Repository')}}
                                        </th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Repository Middle Part List--}}

                    {{--Repository Part List--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Repository Part List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-hover">
                                    <table id="table4" class="table" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Name')}}
                                        </th>
                                        <th>
                                            {{__('Stock')}}
                                        </th>
                                        <th>
                                            {{__('Repository')}}
                                        </th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end--}}
                </div>
            </div>
        </div>
        {{--End Repository List--}}
    </div>
    </div>

    {{--//Product Details Modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-landscape-in">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('View Details Data')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="modal_form" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            {{--<i class="fas fa-user prefix grey-text"></i>--}}
                            <table class="table" id="table6" cellspacing="0" width="100%">
                                <tbody>
                                <thead class=" text-primary">
                                <th>
                                    {{__('ID')}}
                                </th>
                                <th>
                                    {{__('Product Name')}}
                                </th>
                                <th>
                                    {{__('Ordered')}}
                                </th>
                                <th>
                                    {{__('Inventory Deficit')}}
                                </th>
                                <th>
                                    {{__('Action')}}
                                </th>
                                </thead>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input id="Product_Id" name="Product_Id" hidden>
                    <input id="Product_Count" name="Product_Count" hidden>
                    <input id="Comment" name="Comment" hidden>
                </form>
            </div>
        </div>
    </div>
    {{--//End Product Details Modal//--}}

    @endrole

@endsection
@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            $('#table2').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-product-p',
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
            $('#table3').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-middle-part-p',
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
            $('#table4').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-part-p',
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
            var table5 = $('#table5').on('draw.dt', function (e, settings, json, xhr) {
                    $('.js-switch').each(function () {
                        var data = table5.row($(this).parents('tr')).data();
                        var switchery = new Switchery($(this)[0], $(this).data());
                        if (data[4] > 0 || data[5] > 0) {
                            switchery.enable();
                        }else {
                            switchery.disable();
                        }

                        data[10] != '' ? $(this)[0].click() : 0;
                        $(this)[0].onchange = function () {
                            var cdata = table5.row($(this).parents('tr')).data();
                            var data = {
                                hpt_invoice_number: cdata[1],
                                hpt_count: cdata[3],
                                hpt_product_id: cdata[7],
                                hpo_order_id: cdata[9]
                            };
                            //token
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: '/product-task',
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                async: false,
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
                        }
                    })
                }).DataTable({

                    "processing":
                        true,
                    "serverSide":
                        true,
                    "ajax":
                        '/invoices-list-product',
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
                                    "                                                               <a  href=\"product-report-user/" + data[1] + "\" class=\"dropdown-item\"\n" +
                                    "                                                                >{{__('Preview Report')}}</a>\n" +
                                    "                                                                <button class=\"dropdown-item \"  type=\"submit\">{{__('Final Approval')}}</button>\n" +
                                    "                                                            </div>\n" +
                                    "                                                        </div>"
                            }
                        }, {
                            "targets": -2,
                            "data": null,
                            "render": function (data, type, row) {
                                return '<div class="progress">\n' +
                                    '                                                                    <div class="progress-bar" role="progressbar"\n' +
                                    '                                                                         aria-valuenow="60" aria-valuemin="0"\n' +
                                    '                                                                         aria-valuemax="100"\n' +
                                    '                                                                         style="width:' + data[12] + '%;"></div>\n'
                            }
                        },
                            {
                                "targets": -3,
                                "data": null,
                                "defaultContent": '<input type="checkbox" class="js-switch" data-size="small"  >'
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
            $('#table5').on('click', 'button', function (event) {

                var data_table = table5.row($(this).parents('tr')).data();
                var data = {
                    id: data_table[8],
                    product: data_table[7],
                    computing_repository_requirement: data_table[4],
                }
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
                                url: '/order-state/' + data.id,
                                type: 'POST',
                                method: 'put',
                                data: data,
                                dataType: 'json',
                                async: true,
                                success: function (data) {
                                    swal("{{__("The production process was successfully completed.")}}", {
                                        icon: "success",
                                        button: "{{__('Done')}}",
                                    });
                                    $('#table5').DataTable().ajax.reload();
                                    $('#table2').DataTable().ajax.reload();
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

            var table6 = $('#table6').DataTable({

                    "processing":
                        true,
                    "serverSide":
                        true,
                    "ajax":
                        '/invoices-list-product-inventory',
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
                                    "                                                                <button class=\"dropdown-item \"  type=\"submit\">{{__('Send Request')}}</button>\n" +
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
                })
            ;

            // set data to input inventory
            $('#table6').on('click', 'button', function (event) {
                var data_table_inventory = table6.row($(this).parents('tr')).data();
                $('#Product_Id').val(data_table_inventory[4]);
                $('#Product_Count').val(data_table_inventory[3]);
                $('#Comment').val('Inventory Deficit');

                var data = $('#modal_form').serialize();
                event.preventDefault();

                $('#modal_form').block({
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
                    url: '/product_requirement',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($('#modal_form').unblock(), 2000);
                        $("#modalRegisterForm").modal('hide');
                    },
                    cache: false,
                });
            });
        });
    </script>
@endpush