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
            {{--Order Data List--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Order List')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1" cellspacing="0" width="100%">
                                <thead class=" text-primary">
                                <th>
                                    {{__('ID')}}
                                </th>
                                <th>
                                    {{__('Invoices Number')}}
                                </th>
                                <th>
                                    {{__('Product Name')}}
                                </th>
                                <th>
                                    {{__('Product Model')}}
                                </th>

                                <th>
                                    {{__('Property Name')}}
                                </th>
                                <th>
                                    {{__('Color')}}
                                </th>
                                <th>
                                    {{__('Size')}}
                                </th>
                                <th>
                                    {{__('Count')}}
                                </th>
                                <th>
                                    {{__('Due Date')}}
                                </th>
                                <th>
                                    {{__('Action')}}
                                </th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{--End Order Data List--}}

            {{-- Repository List--}}
            <div class="col-md-12">
                <div class="row">
                    {{--Repository Product Data List--}}
                    <div class="col-md-4">
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
                    {{--Repository Middle Part List--}}
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
            {{--End Repository List--}}

            {{--Requirement Product List--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-tasks">
                        {{--Drop Done Show Details Product List--}}
                        <div class="card-header ">
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
                                    <th>{{__('Inventory After Exit')}}</th>
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
        </div>
    </div>

    {{--//Product Details Modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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
                            <table class="table" cellspacing="0" width="100%">
                                <tbody>
                                <thead class=" text-primary">
                                <th>
                                    {{__('Product Name')}}
                                </th>
                                <th>
                                    {{__('Count')}}
                                </th>
                                <th>
                                    {{__('Inventory Deficit')}}
                                </th>
                                </thead>
                                @foreach($query as $item)
                                    @foreach($repository_product as $repository_stock)
                                        @if($item->hpo_product_id == $repository_stock->hr_product_id and $item->hpo_status == '3')
                                            <input type="hidden" class="product-id"
                                                   data-id[]="{{$item->hpo_product_id}}">
                                            <input type="hidden" class="inventory-deficit"
                                                   data-inventory-deficit=" {{$item->sum_hpo}}">
                                            <input type="hidden" class="product-stock"
                                                   data-product-stock=" {{$item->sum_hpo - $repository_stock->hr_product_stock}}">
                                            <tr>
                                                @foreach($product as $products)
                                                    @if($item->hpo_product_id == $products->id)
                                                        <td>
                                                            {{$products->hp_product_name}}
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{$item->sum_hpo}}
                                                </td>
                                                <td>
                                                    @if($item->sum_hpo - $repository_stock->hr_product_stock > 0)
                                                        {{$repository_stock->hr_product_stock - $item->sum_hpo  }}
                                                    @endif
                                                </td>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </tr>
                                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit"
                                    class="btn btn-deep-orange" form="modal_form"
                                    value="Submit">{{__('Request Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--//End Product Details Modal//--}}

    @endrole

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            $('#table1').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-order-product',
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
                                "                                                               <a  href=\"verify_pre/" + data[9] + "/edit\" class=\"dropdown-item\"\n" +
                                "                                                                >{{__('Preview Invoice')}}</a>\n" +
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

                        data[12] == 1 ? $(this)[0].click() : 0;

                        $(this)[0].onchange = function () {
                            var cdata = table5.row($(this).parents('tr')).data();
                            var data = {
                                id: cdata[0],
                                status: $(this)[0].checked == true ? 1 : 0
                            };
                            //token
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: '/checkbox/' + data.id,
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                method: 'put',
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
                                    "                                                               <a  href=\"verify_pre/" + data[0] + "/edit\" class=\"dropdown-item\"\n" +
                                    "                                                                >{{__('Preview Report')}}</a>\n" +
                                    "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Final Approval')}}</button>\n" +
                                    "                                                            </div>\n" +
                                    "                                                        </div>"
                            }
                        }, {
                            "targets": -2,
                            "data": null,
                            "defaultContent": '  <div class="progress">\n' +
                                    {{--'                                                            @foreach($order as $orders)\n' +--}}
                                            {{--'                                                            @foreach($progress as $progresses)\n' +--}}
                                            {{--// '                                                                <span class="progress-value">25%</span>\n' +--}}
                                            {{--'                                                                @if($progresses->ho_process_id == 1 and $orders->id == $progresses->order_id )\n' +--}}
                                            {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
                                            {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
                                            {{--'                                                                         aria-valuemax="100"\n' +--}}
                                            {{--'                                                                         style="width: 25%;"></div>\n' +--}}
                                            {{--'                                                                @endif\n' +--}}
                                            {{--'                                                                @if($progresses->ho_process_id == 2 and $orders->id == $progresses->order_id)\n' +--}}
                                            {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
                                            {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
                                            {{--'                                                                         aria-valuemax="100"\n' +--}}
                                            {{--'                                                                         style="width: 50%;"></div>\n' +--}}
                                            {{--'                                                                @endif\n' +--}}
                                            {{--'                                                                @if($progresses->ho_process_id == 3 and $orders->id == $progresses->order_id)\n' +--}}
                                            {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
                                            {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
                                            {{--'                                                                         aria-valuemax="100"\n' +--}}
                                            {{--'                                                                         style="width: 75%;"></div>\n' +--}}
                                            {{--'                                                                @endif\n' +--}}
                                            {{--'                                                                @if($progresses->ho_process_id == 4 and $orders->id == $progresses->order_id )\n' +--}}
                                            {{--'                                                                    <div class="progress-bar" role="progressbar"\n' +--}}
                                            {{--'                                                                         aria-valuenow="60" aria-valuemin="0"\n' +--}}
                                            {{--'                                                                         aria-valuemax="100"\n' +--}}
                                            {{--'                                                                         style="width:100%; direction: ltr"></div>\n' +--}}
                                            {{--'                                                                @endif\n' +--}}
                                            {{--'                                                            @endforeach\n' +--}}
                                            {{--'                                                            @endforeach\n' +--}}
                                        '                                                        </div>'
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
                    id: data_table[0],
                    product: data_table[5],
                    computing_repository_requirement: data_table[4],
                }
                alert(data.computing_repository_requirement);
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


            // Modal Form
            $('#modal_form').submit(function (event) {
                var data = {
                    Product_Id: $('.product-id').data('id[]'),
                    Inventory_deficit: $('.inventory-deficit').data('inventory-deficit'),
                    Product_Count: $('.product-stock').data('product-stock'),
                }
                event.preventDefault();
                $.blockUI({
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
                    url: '/repository_requirement',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        alert('ok');
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                    },
                    cache: false,
                });
            });
            // End Modal Form

        });
    </script>
@endpush