@extends('layouts.app')

@section('title',__('Product Task'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-right font-weight-400">{{__('Order List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-hover">
                                    <table id="table1" class="table" cellspacing="0" width="100%">
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
                                            {{__('Count')}}
                                        </th>
                                        <th>
                                            {{__('User')}}
                                        </th>
                                        <th>
                                            {{__('Zone')}}
                                        </th>
                                        <th>
                                            {{__('Status')}}
                                        </th>
                                        <th>
                                            {{__('Report')}}
                                        </th>
                                        <th>
                                            {{__('Comment')}}
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

    {{--//Modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-landscape">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('Comment')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modal_form">
                    <div class="modal-body">
                        <div class="md-form mb-5">
                            <input id="part_id" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="bmd-label-floating"
                                           style="float: right;">{{__('Comment')}}</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="hpt_comment" id="hpt_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="bmd-label-floating"
                                           style="float: right;">{{__('Report')}}</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="hpt_report" id="hpt_report"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input id="hpt_product_id" name="hpt_product_id" hidden>
                            <input id="hpt_invoice_number" name="hpt_invoice_number" hidden>
                            <input id="hpt_count" name="hpt_count" hidden>
                            <input id="hpt_product_zone_id" name="hpt_product_zone_id" hidden>
                            <input id="hpt_status" name="hpt_status" hidden>
                            <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--end modal--}}
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#card-form2').hide();

            var table1 = $('#table1').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-product-new-task',
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
                                "                                                                <a class=\"dropdown-item comment\"\n" +
                                "                                                                >{{__('Comment')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item \" type=\"submit\">{{__('Final Approval')}}</button>\n" +
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


            $('#table1').on('click', 'button', function (event) {

                var data_table = table1.row($(this).parents('tr')).data();
                var data = {
                    id: data_table[9],
                    hpt_status: data_table[11],
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
                                url: '/checkbox-product-status/' + data.id,
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
                                    $('#table1').DataTable().ajax.reload();
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
                var data = $('#modal_form').serialize();
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
                    url: '/store-report',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                        $('#table1').DataTable().ajax.reload();

                    },
                    cache: false,
                });
            });
            // End Modal Form

            // fill data in comment form
            $('#table1').on('click', '.comment', function (event) {
                $("#modalRegisterForm").modal();
                var data = table1.row($(this).parents('tr')).data();
                $('#hpt_product_id').val(data[12]);
                $('#hpt_invoice_number').val(data[1]);
                $('#hpt_count').val(data[3]);
                $('#hpt_status').val(data[11]);
                $('#hpt_product_zone_id').val(data[10]);
            })
            // end filling
        });
    </script>
@endpush