@extends('layouts.app')

@section('title',__('Products Price'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Products List')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-hover">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Serial Number')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>
                                    <th>
                                        {{__('Model')}}
                                    </th>
                                    <th>
                                        {{__('Property')}}
                                    </th>
                                    <th>
                                        {{__('Color')}}
                                    </th>
                                    <th>
                                        {{__('Voltage')}}
                                    </th>
                                    <th>
                                        {{__('Size')}}
                                    </th>
                                    <th>
                                        {{__('Price')}}
                                    </th>
                                    <th>
                                        {{__('New Price')}}
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {

            // index of row
            var count;
            $('#table').on('click', 'tr', function (event) {
                count = parseInt(table.row(this).index());
            });

            // pass data to controller
            $('#table').on('click', 'button', function (event) {
                var data_table = table.row($(this).parents('tr')).data();
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
                            var data = {
                                hp_product_price: table.cell(count, -2).nodes().to$().find('input').val()
                            };
                            $.ajax({
                                url: '/product-price/' + data_table[9],
                                type: 'post',
                                method: 'put',
                                data: data,
                                dataType: 'json',
                                async: false,
                                success: function (data) {
                                    swal("{{__("Done")}}", {
                                        icon: "success",
                                        button: "{{__('Done')}}",
                                    });
                                },
                                cache: false,
                            });
                            $('#table').DataTable().ajax.reload();
                        } else {
                            swal(
                                "{{__("Done")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            var table = $('#table').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-product-price',
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
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Send')}}</button>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    }, {
                        "targets": -2,
                        "data": null,
                        "render": function (data, type, row, meta) {
                            return '<input name="hp_product_price" type="number" class="form-control" data-size="small">'
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