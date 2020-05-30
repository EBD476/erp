@extends('layouts.app')

@section('title',__('Products Property Items'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-right font-weight-400">{{__('Products Property Items List')}}</h4>
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
                                                {{__('Items Name')}}
                                            </th>
                                            <th>
                                                {{__('Serial Number')}}
                                            </th>
                                            <th>
                                                {{__('Color')}}
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
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">{{__('New Product Property Items')}}</h4>
                                        <p class="card-category"></p>
                                    </div>
                                    <div class="card-body">
                                        <form id="form1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{__('Items Name')}}</label>
                                                        <input name="hppi_items_name" type="text" class="form-control"
                                                               required=""
                                                               aria-invalid="false">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{__('Serial Number')}}</label>
                                                        <input name="hppi_serial_number" type="text"
                                                               class="form-control"
                                                               required=""
                                                               aria-invalid="false">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('Product Color')}}</label>
                                                    <div class="form-group">
                                                        <select class="form-control select-item-color"
                                                                name="hppi_color"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"
                                                        class="btn btn-fill btn-primary">{{__('Save')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-user" id="card-form2">
                                <div class="card-body">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">{{__('Edit Product Property Items')}}</h4>
                                        <p class="card-category"></p>
                                    </div>
                                    <div class="card-body">
                                        <form id="form2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{__('Items Name')}}</label>
                                                        <input name="hppi_items_name" type="text" class="form-control"
                                                               id="hppi_items_name"
                                                               required=""
                                                               aria-invalid="false">
                                                        <input id="pid" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{__('Serial Number')}}</label>
                                                        <input name="hppi_serial_number" type="text"
                                                               class="form-control"
                                                               id="hppi_serial_number"
                                                               required=""
                                                               aria-invalid="false">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('Product Color')}}</label>
                                                    <div class="form-group">
                                                        <select class="select-item-color form-control"
                                                                name="hppi_color">
                                                            <option id="hppi_color"></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"
                                                        class="btn btn-fill btn-primary">{{__('Save')}}</button>
                                            </div>
                                        </form>
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
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {

            $('#card-form2').hide();

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

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
                                url: '/product-property-items-destroy/' + data[5],
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
                    '/json-data-product-property-items',
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
                                "                                                                <a class=\"dropdown-item edit\"\n" +
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

            // store items
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
                    url: '/product-property-items',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form1").unblock(), 2000);
                        document.getElementById('form1').reset();
                        $('#table').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });


            // update items
            $("#form2").submit(function (event) {
                var data = $("#form2").serialize();
                var pid = $("#pid").val();
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
                    url: '/product-property-items/' + pid,
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

            // select color
            $(".select-item-color").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/json-data-fill_data_product_color',
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
                placeholder: ('انتخاب رنگ محصول'),
                dir: "rtl",
                templateSelection: formatRepoSelection1
            });

            function formatRepoSelection1(repo) {
                return repo.text || repo.id;
            }

            // end


            // fill data in edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form2').show();
                var data = table.row($(this).parents('tr')).data();
                $('#pid').val(data[5]);
                $('#hppi_items_name').val(data[1]);
                $('#hppi_serial_number').val(data[2]);
                $('#hppi_color').val(data[4]);
            })
            // end filling

        });
    </script>
@endpush