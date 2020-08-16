@extends('layouts.app')

@section('title',__('Inventory Product'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|qc|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('List of Inventory Product In Que')}}</h4>
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
                                        {{__('Product Name')}}
                                    </th>
                                    <th>
                                        {{__('Count')}}
                                    </th>
                                    <th>
                                        {{__('Inventory From')}}
                                    </th>
                                    <th>
                                        {{__('Inventory to')}}
                                    </th>
                                    <th>
                                        {{__('Created at')}}
                                    </th>
                                    <th>
                                        {{__('Verify')}}
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
                            <h4 class="card-title text-right font-weight-400">{{__('List of Inventory Product')}}</h4>
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
                                        {{__('Product Name')}}
                                    </th>
                                    <th>
                                        {{__('Count')}}
                                    </th>
                                    <th>
                                        {{__('Inventory From')}}
                                    </th>
                                    <th>
                                        {{__('Inventory to')}}
                                    </th>
                                    {{--<th>--}}
                                        {{--{{__('Verify')}}--}}
                                    {{--</th>--}}
                                    <th>
                                        {{__('Created at')}}
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
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function () {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            var table5 = $('#table5').on('draw.dt', function (e, settings, json, xhr) {
                $('.js-switch').each(function () {
                    var switchery = new Switchery($(this)[0], $(this).data());
                    $(this)[0].onchange = function () {
                        var cdata = table5.row($(this).parents('tr')).data();
                        var data = {
                            hr_return_value: cdata[2],
                            hr_entry_date: cdata[6],
                            hr_exit: cdata[7],
                            hr_contradiction: cdata[8],
                            hr_status_return_part: cdata[9],
                            hr_verify_repository_goal: $(this)[0].checked == true ? 1 : 0,
                            hr_repository_id: cdata[11],
                            hr_product_id: cdata[12],
                            id: cdata[13],
                            hr_repository_goal_id: cdata[14],
                            hr_comment: cdata[15],
                            hr_count: cdata[16],
                        };
                        //token
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/inventory-product/' + data.id,
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
                    }
                })
            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/inventory-product-fill',
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
                                "                                                                <button class=\"dropdown-item deleted\" type=\"submit\">{{__('Verify All Inventory')}}</button>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    },
                        {
                            "targets": -2,
                            "data": null,
                            "defaultContent": '<input type="checkbox" class="js-switch" data-size="small">'
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
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/inventory-product-fill-all',
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

        });
    </script>
@endpush