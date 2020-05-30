@extends('layouts.app')

@section('title',__('Products'))

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
                <div class="col-md-12">
                    <a class="btn btn-primary float-left mb-lg-2" data-target="#modalRegisterForm" href="#"
                       data-toggle="modal">
                        {{__('Computing Product')}}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-right font-weight-400">{{__('Products Part List')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-hover">
                                    <table id="table" class="table" cellspacing="0" width="100%">
                                        <thead class=" text-primary">
                                        {{--<th>--}}
                                        {{--{{__('Statuses')}}--}}
                                        {{--</th>--}}
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Product Name')}}
                                        </th>
                                        <th>
                                            {{__('Part Name')}}
                                        </th>
                                        <th>
                                            {{__('Zone')}}
                                        </th>
                                        <th>
                                            {{__('Count')}}
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
                                    <h4 class="card-title ">{{__('New Product Part')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <form id="form1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Product Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-product" name="hpp_product_id">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Product Part Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-part" name="hpp_part_id">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Set Product Zone')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-product-zone"
                                                            name="hpp_product_zone"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Part Count')}}</label>
                                                    <input name="hpp_part_count" type="text" class="form-control"
                                                           required=""
                                                           aria-invalid="false">
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
                                    <h4 class="card-title ">{{__('Edit Product Part')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <form id="form2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Product Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-product" name="hpp_product_id">
                                                        <option id="hpp_product_id"></option>
                                                    </select>
                                                    <input hidden id="pid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Product Part Name')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-part" name="hpp_part_id">
                                                        <option id="hpp_part_id"></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{__('Set Product Zone')}}</label>
                                                <div class="form-group">
                                                    <select class="form-control select-product-zone"
                                                            name="hpp_product_zone"
                                                           ><option  id="hpp_product_zone"></option></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Part Count')}}</label>
                                                    <input name="hpp_part_count" type="text" class="form-control"
                                                           id="hpp_part_count"
                                                           required=""
                                                           aria-invalid="false">
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

                {{--//Product Details Modal//--}}
                <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">{{__('View Product Details')}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" id="modal_form" enctype="multipart/form-data">
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-5" id="table-form">
                                        {{--<i class="fas fa-user prefix grey-text"></i>--}}
                                        <table class="table" id="table1" cellspacing="0" width="100%">
                                            <tbody>
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
                                                {{__('Verify')}}
                                            </th>
                                            </thead>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="md-form mb-5" id="table-form2">
                                        <table class="table" id="table2" cellspacing="0" width="100%">
                                            <tbody>
                                            <h5 class="card-title ">{{__('Product Name')}}</h5>
                                            <thead class=" text-primary">
                                            <th>
                                                {{__('ID')}}
                                            </th>
                                            <th>
                                                {{__('Part Name')}}
                                            </th>
                                            <th>
                                                {{__('Count')}}
                                            </th>
                                            <th>
                                                {{__('Stock')}}
                                            </th>
                                            <th>
                                                {{__('Verify')}}
                                            </th>
                                            </thead>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--end Product Details --}}
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
            $('#table-form2').hide();

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
                                url: '/product-part-destroy/' + data[8],
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
                    '/json-data-product-part',
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

            // store data
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
                    url: '/product-part',
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

            // update data
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
                $('#pid').val(data[8]);
                $('#hpp_part_id').val(data[6]);
                $('#hpp_product_zone').val(data[3]);
                $('#hpp_product_id').val(data[5]);
                $('#hpp_part_count').val(data[4]);
            })
            // end filling


            var table1 = $('#table1').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-product-part-compute',
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
                                "                                                                >{{__('Verify')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item preview\"  type=\"submit\">{{__('Preview Detail')}}</button>\n" +
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


            // fill data in preview form
            $('#table1').on('click', '.preview', function (event) {
                $('#table-form').hide();
                $('#table-form2').show();
                event.preventDefault();
                var data = table1.row($(this).parents('tr')).data();
                $('#table2').DataTable({
                    "processing":
                        true,
                    "serverSide":
                        true,
                    "ajax":
                        '/computing-product-part-detail',
                    "columnDefs":
                        [{
                            "targets": -1,
                            "data": data[3],

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
                                    "                                                                <button class=\"dropdown-item deleted\"  type=\"submit\">{{__('Delete')}}</button>\n" +
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


            });
            // end filling


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

            // end fill data in select part

            // fill data in select part
            $(".select-product-zone").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-zone',
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
                placeholder: ('انتخاب بخش'),
                templateSelection: formatRepoSelection
            });

            function formatRepoSelection(repo) {
                return repo.text || repo.id;
            }

            // end fill data in select part

            $('#back').on('click',function () {
                $('#table-form2').hide();
                $('#table-form').show();
                event.preventDefault();

            })
        });
    </script>
@endpush