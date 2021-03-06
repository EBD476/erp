@extends('layouts.app')

@section('title',__('Product Middle Part'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="col-md-12">
                <a class="btn btn-primary float-left mb-lg-2" data-target="#modalRegisterForm" href="#"
                   data-toggle="modal">
                    {{__('Computing Product Middle Part')}}
                </a>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Product Middle Part List')}}</h4>
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
                                        {{__('Middle Part Name')}}
                                    </th>
                                    <th>
                                        {{__('Zone')}}
                                    </th>
                                    <th>
                                        {{__('Middle Part Count')}}
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
                            <h4 class="card-title ">{{__('New Product Middle Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
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
                                    <label>{{__('Middle Part Name')}}</label>
                                    <div class="form-group">
                                        <select id="part_id" class="form-control select-middle-part"
                                                name="hpp_middle_part_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>{{__('Set Middle Part Zone')}}</label>
                                    <div class="form-group">
                                        <select class="form-control select-product-zone"
                                                name="hpp_middle_part_zone">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('Part Count')}}</label>
                                        <input name="hpp_part_count" type="text" class="form-control"
                                               required="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">{{__('Save')}}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="card card-user" id="card-form2">
                        <div class="card-body">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Edit Product Middle Parts')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Product Name')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-product"
                                                        name="hpp_product_id">
                                                    <option id="hpp_product_id"></option>
                                                </select>
                                                <input id="pmpid" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Middle Part Name')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-middle-part"
                                                        name="hpp_middle_part_id">
                                                    <option id="hpp_middle_part_id"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Set Middle Part Zone')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-product-zone"
                                                        name="hpp_middle_part_zone">
                                                    <option id="hpp_middle_part_zone"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Part Count')}}</label>
                                                <input name="hpp_part_count" type="text" class="form-control"
                                                       required=""
                                                       id="hpp_part_count">
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
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-fill btn-primary"
                                                id="back">{{__('Back')}}</button>
                                    </div>
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


            var table1 = $('#table1').DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-product-middle-part-compute',
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
                        '/computing-product-middle-part-detail',
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
                                url: '/product-middle-part-destroy/' + data[8],
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
                    '/json-data-product-middle-part',
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

            // store new middle part requirement
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                $.ajax({
                    url: '/product-middle-part',
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
            // end store

            // update product requirement
            $("#form2").submit(function (event) {

                var data = $("#form2").serialize();
                var pmpid = $("#pmpid").val();
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

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/product-middle-part/' + pmpid,
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
            // end updating

            // fill data in edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form2').show();
                var data = table.row($(this).parents('tr')).data();
                $('#pmpid').val(data[8]);
                $('#hpp_part_count').val(data[4]);
                $('#hpp_middle_part_id').val(data[5]);
                $('#hpp_product_id').val(data[6]);
                $('#hpp_middle_part_zone').val(data[7]);
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
                templateResult: formatRepo_product,
                templateSelection: formatRepoSelection_product
                // allowClear: true

            });

            function formatRepo_product(repo) {

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

            function formatRepoSelection_product(repo) {
                return repo.text
            }

            // end

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
                templateSelection: formatRepoSelection_product_zone
            });
            function formatRepoSelection_product_zone(repo) {
                return repo.text || repo.id;
            }
            // end fill data in select part

            $('#back').on('click', function () {
                $('#table-form2').hide();
                $('#table-form').show();
                event.preventDefault();
            })

        });
    </script>
@endpush