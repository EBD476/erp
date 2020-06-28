@extends('layouts.app')

@section('title',__('Product Task'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin|product|task')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-right font-weight-400">{{__('Report List')}}</h4>
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
                                            {{__('Actor')}}
                                        </th>
                                        <th>
                                            {{__('Zone')}}
                                        </th>
                                        <th>
                                            {{__('Level')}}
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
                    '/json-data-product-report-list',
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
                                "                                                                >{{__('Show')}}</a>\n" +
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


            // fill data in comment form
            $('#table1').on('click', '.comment', function (event) {
                $("#modalRegisterForm").modal();
                var data = table1.row($(this).parents('tr')).data();
                $('#hpt_comment').val(data[8]);
                $('#hpt_report').val(data[7]);
            })
            // end filling
        });
    </script>
@endpush