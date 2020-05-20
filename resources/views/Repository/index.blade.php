@extends('layouts.app')

@section('title',__('Repository List'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin||repository')
    <div class="content persian">
        <div class="container-fluid">
            <div class="col-md-12">
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
                {{--End Repository Product Data List--}}

                {{--Repository Middle Part List--}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Repository Middle Part List')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" cellspacing="0" width="100%" id="table2">
                                    <thead>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>
                                    <th>
                                        {{__('Count')}}
                                    </th>
                                    <th>
                                        {{__('Provider')}}
                                    </th>
                                    <th>
                                        {{__('Repository')}}
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
                {{--End Repository Middle Part List--}}

                {{--Repository Part List--}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Repository Part List')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table3" class="table" cellspacing="0" width="100%">
                                    <thead>
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Name')}}
                                    </th>
                                    <th>
                                        {{__('Count')}}
                                    </th>
                                    <th>
                                        {{__('Provider')}}
                                    </th>
                                    <th>
                                        {{__('Repository')}}
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
                {{--end--}}
            </div>
        </div>
    </div>
    {{--End Repository Part List--}}

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
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right ; margin-top: -10px">{{__('Product Name')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-product"
                                                name="hr_product_id" id="hr_product_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right ; margin-top: -10px">{{__('Provider')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-provider"
                                                aria-invalid="false" id="hr_provider_code" name="hr_provider_code">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right ; margin-top: -15px">{{__('Repository Name')}}</label>
                                    <div class="form-group">
                                        <select class="form-control" name="hr_repository_id">
                                            <option id="hr_repository_id"></option>
                                            @foreach($repository_name as $namess)
                                                <option value="{{$namess->hr_priority_id}}">
                                                    {{$namess->hr_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="float: right">{{__('Count')}}</label>
                                        <input type="number" class="form-control" required=""
                                               aria-invalid="false" id="hr_product_stock" name="hr_product_stock">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--end modal--}}
    {{--//Edit Middle Part Repository Modal//--}}
    <div class="modal fade" id="modalRegisterForm2" tabindex="-1" role="dialog"
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
                <form id="form2">
                    <div class="modal-body">
                        <div class="md-form mb-5">
                            <input hidden id="middle_part_id">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right; margin-top: -10px">{{__('Name')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-middle-part" id="hrm_middle_part_id"
                                                name="hrm_middle_part_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right; margin-top: -10px">{{__('Provider')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-provider"
                                                aria-invalid="false" name="hrm_provider_code" id="hrm_provider_code">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right ; margin-top: -15px">{{__('Repository Name')}}</label>
                                        <select class="form-control" name="hrm_repository_id">
                                            <option id="hrm_repository_id"></option>
                                            @foreach($repository_name as $names)
                                                <option value="{{$names->id}}">
                                                    {{$names->hr_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="float: right">{{__('Count')}}</label>
                                        <input type="number" class="form-control" required=""
                                               aria-invalid="false" name="hrm_count" id="hrm_count">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrm_entry_date" id="test-date-id-1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Exit')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrm_exit" id="test-date-id-4">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Contradiction')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrm_contradiction" id="hrm_contradiction">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Return Value')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrm_return_value" id="hrm_return_value"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Status Return Part')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrm_status_return_part"
                                               id="hrm_status_return_part">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="float: right">{{__('Comment')}}</label>
                                        <textarea class="form-control" required=""
                                                  aria-invalid="false" name="hrm_comment" id="hrm_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--end modal--}}

    {{--//Edit Part Repository Modal//--}}
    <div class="modal fade" id="modalRegisterForm3" tabindex="-1" role="dialog"
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
                <form id="form3">
                    <div class="modal-body">
                        <div class="md-form mb-5">
                            <input id="part_id" hidden>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right; margin-top: -10px">{{__('Part Name')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-part" name="hrp_part_id" id="hrp_part_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="bmd-label-floating"
                                           style="float: right; margin-top: -10px">{{__('Provider')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-provider"
                                                aria-invalid="false" name="hrp_provider_code" id="hrp_provider_code">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right; margin-top: -15px">{{__('Repository Name')}}</label>
                                        <select class="form-control" name="hrp_repository_id">
                                            <option id="hrp_repository_id"></option>
                                            @foreach($repository_name as $name)
                                                <option value="{{$name->id}}">
                                                    {{$name->hr_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="float: right">{{__('Count')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_part_count" id="hrp_part_count">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hrp_entry_date" id="test-date-id-2">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Status Return Part')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrp_status_return_part"
                                               id="hrp_status_return_part">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Exit')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrp_exit" id="test-date-id-5"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Contradiction')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrp_contradiction" id="hrp_contradiction"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"
                                               style="float: right">{{__('Return Value')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hrp_return_value" id="hrp_return_value"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="float: right">{{__('Comment')}}</label>
                                        <textarea class="form-control" required=""
                                                  aria-invalid="false" name="hrp_comment" id="hrp_comment"></textarea>
                                    </div>
                                </div>
                            </div>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {

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
                                url: '/repository-product-destroy/' + data[0],
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
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-product',
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
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
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
            // end

            {{--// fill and show repository middle part data--}}
            $('#table2').on('click', 'button', function (event) {

                var data = table2.row($(this).parents('tr')).data();
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
                                url: '/repository-middle-part-destroy/' + data[0],
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
                            $('#table2').DataTable().ajax.reload();
                        } else {
                            swal(
                                "{{__("Your imaginary file is safe!")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            var table2 = $('#table2').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-middle-part',
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
                                "                                                                <a class=\"dropdown-item edit-middle-part\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
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
            // end

            // fill and show repository part data
            $('#table3').on('click', 'button', function (event) {

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
                                url: '/repository-part-destroy/' + data[0],
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
                            $('#table2').DataTable().ajax.reload();
                        } else {
                            swal(
                                "{{__("Your imaginary file is safe!")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            var table3 = $('#table3').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-repository-part',
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
                                "                                                                <a class=\"dropdown-item edit-part\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
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
            {{--// end--}}


            // update Inventory
            $("#form2").submit(function (event) {
                var data = $("#form2").serialize();
                var pid = $('#pid').val();
                event.preventDefault();
                $('#form2').block({
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
                    url: '/product-part/' + pid,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method: 'put',
                    async: false,
                    success: function (data) {
                        setTimeout($('#form2').unblock(), 2000);
                        $('#table').DataTable().ajax.reload();
                        $('#card-form2').hide();
                    },
                    cache: false,
                });
            });

            // fill data in edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form2').show();
                var data = table.row($(this).parents('tr')).data();
                $('#pid').val(data[0]);
                $('#hpp_part_id').val(data[6]);
                $('#hp_part_model').val(data[3]);
                $('#hpp_product_id').val(data[5]);
                $('#hpp_part_count').val(data[4]);
            })
            // end filling

            // Computing Modal Form
            $("#modal_form").submit(function (event) {
                var data = $("#modal_form").serialize();
                event.preventDefault();
                $.blockUI();
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
                        setTimeout($.unblockUI);
                        $("#modalRegisterForm").find("input").val("");
                        $("#modalRegisterForm").modal('hide');
                    },
                    cache: false,
                });
            });
            // End Modal Form

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
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                    },
                    cache: false,
                });
            });
            // End Modal Form

            // pass checkbox data
            $('.checkbox').on('change', function (event) {
                if (event.target.checked) {
                    var data = {
                        id: $(this).data('id'),
                        state: $(this)[0].checked == true ? 3 : 2,
                        product: $(this).data('pid'),
                        computing_repository_requirement: $(this).data('computing_repository_requirement'),

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
                        url: '/order-state/' + data.id,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            setTimeout($.unblockUI, 2000);
                            location.reload();
                        },
                        cache: false,
                    });
                }


            });
            // End data pass

            {{--edit repositories modal--}}

            // pass product data
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
                var product_id = $('#product_id').val();
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
                    url: '/repository',
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
            // pass middle part data
            $("#form2").submit(function (event) {
                var data = $("#form2").serialize();
                var middle_part_id = $('#middle_part_id').val();
                event.preventDefault();
                $("#form2").block({
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
                    url: '/repository-middle-part',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form2").unblock(), 2000);
                        document.getElementById("form2").reset();
                        $('#table2').DataTable().ajax.reload();
                        $("#modalRegisterForm2").modal('hide');


                    },
                    cache: false,
                });
            });
            // pass part data
            $("#form3").submit(function (event) {
                var data = $("#form3").serialize();
                var part_id = $('#part_id').val();
                event.preventDefault();
                $("#form3").block({
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
                    url: '/repository-part',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form3").unblock(), 2000);
                        document.getElementById("form3").reset();
                        $('#table3').DataTable().ajax.reload();
                        $("#modalRegisterForm3").modal('hide');
                    },
                    cache: false,
                });
            });

            // fill data in select middle part
            $(".select-middle-part").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-middle-part',
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
                dropdownParent: $('#modalRegisterForm2'),
                placeholder: ('انتخاب قطعه میانی'),
                templateResult: formatRepo1,
                templateSelection: formatRepoSelection1
            });

            function formatRepo1(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/middle_parts/" + repo.hmp_image + "' /></div>" +
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
                $container.find(".select2-result-repository__description").text("{{__('Model')}}" + " : " + repo.hmp_middle_part_model);
                $container.find(".select2-result-repository__color").text("{{__('Code')}}" + " : " + repo.hmp_serial_number);
                return $container;
            }

            function formatRepoSelection1(repo) {
                return repo.text || repo.id;
            }

            // end fill data in select middle part

            // fill data in select product
            $(".select-product").select2({
                ajax: {
                    url: '/json-data-fill-data-product',
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
                dropdownParent: $('#modalRegisterForm1'),
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

            // end

            // fill data in select part
            $(".select-part").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-part',
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
                placeholder: ('انتخاب قطعه'),
                dropdownParent: $('#modalRegisterForm3'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='/img/parts/" + repo.hp_part_image + "' /></div>" +
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
                $container.find(".select2-result-repository__description").text("{{__('Model')}}" + " : " + repo.hp_part_model);
                $container.find(".select2-result-repository__color").text("{{__('Code')}}" + " : " + repo.hp_serial_number);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.text || repo.id;
            }

            // end fill data in select middle part

            // select-provider
            $(".select-provider").select2({
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
                templateSelection: formatRepoSelection2
            });

            function formatRepoSelection2(repo) {
                return repo.text || repo.id;
            }

            // end

            // fiil edit form
            $('#table').on('click', '.edit-product', function (event) {
                $("#modalRegisterForm1").modal();
                var data = table.row($(this).parents('tr')).data();
                $('#product_id').val(data[0]);
                $("#hr_product_id").append('<option selected value="' + data[13] + '">' + data[1] + '</option>');
                $('#hr_product_stock').val(data[2]);
                $("#hr_provider_code").append('<option selected value="' + data[11] + '">' + data[3] + '</option>');
                $("#hr_repository_id").text(data[4]);
                $('#test-date-id').val(data[5]);
                $('#test-date-id-3').val(data[6]);
                $('#hr_return_value').val(data[7]);
                $('#hr_contradiction').val(data[8]);
                $('#hr_status_return_part').val(data[9]);
                $('#hr_comment').val(data[10]);
                $("#hr_repository_id").val(data[12]);

            })
            // end

            // fiil edit form
            $('#table2').on('click', '.edit-middle-part', function (event) {
                $("#modalRegisterForm2").modal();
                var data = table2.row($(this).parents('tr')).data();
                $("#hrm_middle_part_id").append('<option selected value="' + data[13] + '">' + data[1] + '</option>');
                $("#hrm_provider_code").append('<option selected value="' + data[11] + '">' + data[3] + '</option>');
                $("#hrm_repository_id").text(data[4]);
                $('#hrm_count').val(data[2]);
                $('#test-date-id-1').val(data[5]);
                $('#hrm_exit').val(data[6]);
                $('#hrm_return_value').val(data[7]);
                $('#hrm_contradiction').val(data[8]);
                $('#hrm_status_return_part').val(data[9]);
                $('#hrm_comment').val(data[10]);
                $("#hrm_repository_id").val(data[12]);
            })
            // end

            // fiil edit form
            $('#table3').on('click', '.edit-part', function (event) {
                $("#modalRegisterForm3").modal();
                var data = table3.row($(this).parents('tr')).data();
                $("#hrp_part_id").append('<option selected value="' + data[13] + '">' + data[1] + '</option>');
                $("#hrp_provider_code").append('<option selected value="' + data[11] + '">' + data[3] + '</option>');
                $("#hrp_repository_id").text(data[4]);
                $('#hrp_part_count').val(data[2]);
                $('#test-date-id-2').val(data[5]);
                $('#hrp_exit').val(data[6]);
                $('#hrp_return_value').val(data[7]);
                $('#hrp_contradiction').val(data[8]);
                $('#hrp_status_return_part').val(data[9]);
                $('#hrp_comment').val(data[10]);
                $("#hrp_repository_id").val(data[12]);

            })
            // end
        });

    </script>
    {{--datapicker--}}
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
        kamaDatepicker('test-date-id-1', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
        kamaDatepicker('test-date-id-2', {
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
        kamaDatepicker('test-date-id-4', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
        kamaDatepicker('test-date-id-5', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
@endpush




