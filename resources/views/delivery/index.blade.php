@extends('layouts.app')

@section('title',__('Delivery List'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Delivery List')}}</h4>
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
                                                {{__('Name')}}
                                            </th>
                                            <th>
                                                {{__('Status')}}
                                            </th>
                                            </thead>
                                            <tbody>

                                            @foreach($invoice_status as  $invoice_statuses)
                                                <tr>
                                                    <td>
                                                        {{$invoice_statuses ->hp_Invoice_number}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hp_project_name}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hpo_product_id}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hpo_count}}
                                                    </td>
                                                    <td>
                                                        {{$invoice_statuses ->hop_due_date}}
                                                    </td>
                                                    <td>
                                                        <div class="form-check ">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input checkbox"
                                                                       type="checkbox"
                                                                       data-id="{{$invoice_statuses->hpo_order_id}}">
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br><br>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "عبارت جستجو",
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                }

            });

        });

        // pass checkbox data
        $('.checkbox').on('change', function (event) {
            if (event.target.checked) {
                var data = {
                    id: $(this).data('id'),
                    state: $(this)[0].checked == true ? 6 : 4,

                };
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
                //token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/delivery/' + data.id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    method: 'PUT',
                    success: function (data) {
                        alert(data.response);
                        setTimeout($.unblockUI, 2000);
                        location.reload();
                    },
                    cache: false,
                });
            }


        });
        // End data pass

    </script>
    {{--full ajax  --}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>--}}
    {{--<script>--}}
    {{--$(document).ready(function () {--}}

    {{--var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));--}}

    {{--$('#table').on('click', 'button', function (event) {--}}

    {{--var data = table.row($(this).parents('tr')).data();--}}
    {{--$.ajaxSetup({--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--}--}}
    {{--});--}}
    {{--swal({--}}
    {{--// title: "",--}}
    {{--text: "{{__('Are you sure?')}}",--}}
    {{--buttons: ["{{__('cancel')}}", "{{__('Done')}}"],--}}
    {{--icon: "warning",--}}
    {{--// buttons: true,--}}
    {{--dangerMode: true,--}}
    {{--})--}}
    {{--.then((willDelete) => {--}}
    {{--if (willDelete) {--}}
    {{--$.ajax({--}}
    {{--url: '/order-destroy/' + data[0],--}}
    {{--type: 'delete',--}}
    {{--data: data,--}}
    {{--dataType: 'json',--}}
    {{--async: false,--}}
    {{--success: function (data) {--}}
    {{--swal("{{__("Poof! Your imaginary file has been deleted!")}}", {--}}
    {{--icon: "success",--}}
    {{--button: "{{__('Done')}}",--}}
    {{--});--}}
    {{--},--}}
    {{--cache: false,--}}
    {{--});--}}
    {{--location.reload();--}}
    {{--} else {--}}
    {{--swal(--}}
    {{--"{{__("Your imaginary file is safe!")}}",--}}
    {{--{button: "{{__('Done')}}"}--}}
    {{--);--}}

    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--var table = $('#table').on('draw.dt', function (e, settings, json, xhr) {--}}
    {{--}).DataTable({--}}

    {{--"processing":--}}
    {{--true,--}}
    {{--"serverSide":--}}
    {{--true,--}}
    {{--"ajax":--}}
    {{--'/json-data-order',--}}
    {{--"columnDefs":--}}
    {{--[{--}}
    {{--"targets": -1,--}}
    {{--"data": null,--}}
    {{--"defaultContent": "  <div class=\"dropdown\">\n" +--}}
    {{--"                                                            <a class=\"btn btn-link dropdown-toggle btn-icon\"\n" +--}}
    {{--"                                                                    data-toggle=\"dropdown\">\n" +--}}
    {{--"                                                                <i class=\"tim-icons icon-settings-gear-63\"></i>\n" +--}}
    {{--"                                                            </a>\n" +--}}
    {{--"                                                            <div class=\"dropdown-menu dropdown-menu-right\"\n" +--}}
    {{--"                                                                 aria-labelledby=\"dropdownMenuLink\">\n" +--}}
    {{--"                                                                <a href=\"{{route('order.edit',113)}}\" class=\"dropdown-item\"\n" +--}}
    {{--"                                                                >{{__('Edit')}}</a>\n" +--}}
    {{--"                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +--}}
    {{--"                                                            </div>\n" +--}}
    {{--"                                                        </div>"--}}
    {{--}, {--}}
    {{--"targets": -2,--}}
    {{--"data": null,--}}
    {{--"defaultContent": '  <div class="progress">\n' +--}}
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
    {{--'                                                        </div>'--}}
    {{--}],--}}
    {{--"language":--}}
    {{--{--}}
    {{--"sEmptyTable":--}}
    {{--"هیچ داده ای در جدول وجود ندارد",--}}
    {{--"sInfo":--}}
    {{--"نمایش _START_ تا _END_ از _TOTAL_ رکورد",--}}
    {{--"sInfoEmpty":--}}
    {{--"نمایش 0 تا 0 از 0 رکورد",--}}
    {{--"sInfoFiltered":--}}
    {{--"(فیلتر شده از _MAX_ رکورد)",--}}
    {{--"sInfoPostFix":--}}
    {{--"",--}}
    {{--"sInfoThousands":--}}
    {{--",",--}}
    {{--"sLengthMenu":--}}
    {{--"نمایش _MENU_ رکورد",--}}
    {{--"sLoadingRecords":--}}
    {{--"در حال بارگزاری...",--}}
    {{--"sProcessing":--}}
    {{--"در حال پردازش...",--}}
    {{--"sSearch":--}}
    {{--"جستجو:",--}}
    {{--"sZeroRecords":--}}
    {{--"رکوردی با این مشخصات پیدا نشد",--}}
    {{--"oPaginate":--}}
    {{--{--}}
    {{--"sFirst":--}}
    {{--"ابتدا",--}}
    {{--"sLast":--}}
    {{--"انتها",--}}
    {{--"sNext":--}}
    {{--"بعدی",--}}
    {{--"sPrevious":--}}
    {{--"قبلی"--}}
    {{--}--}}
    {{--,--}}
    {{--"oAria":--}}
    {{--{--}}
    {{--"sSortAscending":--}}
    {{--": فعال سازی نمایش به صورت صعودی",--}}
    {{--"sSortDescending":--}}
    {{--": فعال سازی نمایش به صورت نزولی"--}}
    {{--}--}}
    {{--}--}}
    {{--})--}}
    {{--;--}}
    {{--});--}}
    {{--</script>--}}
@endpush