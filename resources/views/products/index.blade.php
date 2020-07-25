@extends('layouts.app')

@section('title',__('Products'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/switchery.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
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
                                        {{__('Status')}}
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
                    <div class="card card-user" id="card-form1">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('New Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Name')}}</label>
                                            <input name="hp_product_name" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                @if($status->hpscsn_activation == 1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Serial Number')}}</label>
                                            <input name="hp_serial_number" type="text" class="form-control"
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Part Number')}}</label>
                                            <input name="hp_part_number" type="text" class="form-control"
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Model')}}</label>
                                            <input name="hp_product_model" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>{{__('Product Color')}}</label>
                                        <div class="form-group">
                                            <select class="select-item-color form-control" name="hp_product_color_id">
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm">
                                                {{__('Add New Color')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-12">
                                        <label>{{__('Product Property')}}</label>
                                        <div class="form-group">
                                            <select class="select-product-property form-control"
                                                    name="hp_product_property">
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm1">
                                                {{__('Add New Property')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Size')}}</label>
                                            <input name="hp_product_size" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Voltage')}}</label>
                                            <input name="hp_voltage" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input name="hp_description" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_image" id="product_image">
                            </form>
                            <br>
                            <label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-12 row">
                                <form action="{{url('/product-image-save')}}" class="dropzone" id="dropzone"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="file" class="form-control"
                                               name="file" multiple>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>
                        <div class="card-footer">
                            <button id="sub_form1" type="submit"
                                    class="btn btn-fill btn-primary">{{__('Save')}}</button>
                        </div>
                    </div>
                    <div class="card card-user" id="card-form2">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Name')}}</label>
                                            <input name="hp_product_name" id="hp_product_name" type="text"
                                                   class="form-control" required=""
                                                   aria-invalid="false">
                                            <input id="hp_product_id" hidden>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Model')}}</label>
                                            <input name="hp_product_model" id="hp_product_model" type="text"
                                                   class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>{{__('Product Color')}}</label>
                                        <div class="form-group">
                                            <select class="select-item-color form-control" name="hp_product_color_id">
                                                <option id="hp_product_color_id"></option>
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm">
                                                {{__('Add New Color')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-12">
                                        <label>{{__('Product Property')}}</label>
                                        <div class="form-group">
                                            <select class="select-product-property form-control"
                                                    name="hp_product_property">
                                                <option id="hp_product_property"></option>
                                            </select>
                                        </div>
                                        <div class="text-light">
                                            <a class="pointer" href="#" data-toggle="modal"
                                               data-target="#modalRegisterForm1">
                                                {{__('Add New Property')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row select-to-input">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Product Size')}}</label>
                                            <input name="hp_product_size" id="hp_product_size" class="form-control"
                                                   required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Voltage')}}</label>
                                            <input name="hp_voltage" type="text" class="form-control" required=""
                                                   aria-invalid="false" id="hp_voltage">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input name="hp_description" id="hp_description" type="text"
                                                   class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_image1" id="product_image1">
                            </form>
                            <br>
                            <label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-12 row"
                                 style="display: flex ; border: 1px dashed;     margin-right: -35px;}">
                                <form action="{{url('/product-image-save')}}" class="dropzone" id="dropzone"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="file" class="form-control"
                                               name="file" multiple>
                                    </div>
                                    <div class="dz-image">
                                        <img src="" id="hp_image">
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>
                        <div class="card-footer">
                            <button id="sub_form2" type="submit"
                                    class="btn btn-fill btn-primary">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--//product color modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('Add New Color')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            {{--<i class="fas fa-user prefix grey-text"></i>--}}
                            <label class="bmd-label-floating" data-error="wrong"
                                   data-success="right"
                                   for="orangeForm-name" style="display: flex;">{{__('Product Color Name')}}</label>
                            <input type="text" id="orangeForm-name" class="form-control validate"
                                   name="hn_color_name">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="submit_modal_color"
                                class="btn btn-deep-orange">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--//End color modal//--}}

    {{--//property modal//--}}
    <div class="modal fade" id="modalRegisterForm1" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('Add New Property')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="modal_form" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            {{--<i class="fas fa-user prefix grey-text"></i>--}}
                            <label style="display: flex;">{{__('Property Name')}}</label>
                            <input name="hpp_property_name" type="text" class="form-control" required=""
                                   aria-invalid="false">
                        </div>
                        <div class="md-form mb-5">
                            {{--<i class="fas fa-envelope prefix grey-text"></i>--}}
                            <label style="display: flex;margin-top: -40px;margin: -20px;margin-right: 4px;">{{__('Items')}}</label>
                            <div class="form-group">
                                <select name="hpp_property_items"
                                        class="select-product-property-items form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-deep-orange">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--//End property modal//--}}

    @endrole


@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/switchery.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.dz-message').text("برای انتخاب تصویر مورد نظر اینجا کلیک کنید");


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
                                url: '/product-destroy/' + data[13],
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

                $('.js-switch').each(function () {

                    var data = table.row($(this).parents('tr')).data();
                    var switchery = new Switchery($(this)[0], $(this).data());

                    data[12] == 1 ? $(this)[0].click() : 0;

                    $(this)[0].onchange = function () {
                        var cdata = table.row($(this).parents('tr')).data();
                        var data = {
                            id: cdata[13],
                            hp_status: $(this)[0].checked == true ? 1 : 0
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
                    '/json-data-product',
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
                                "                                                               <a class=\"dropdown-item edit\"\n" +
                                "                                                                >{{__('Edit')}}</a>\n" +
                                "                                                                <button class=\"dropdown-item deleted\" id=\"deleted\" type=\"submit\">{{__('Delete')}}</button>\n" +
                                "                                                            </div>\n" +
                                "                                                        </div>"
                        }
                    }, {
                        "targets": -2,
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
            });

            // update product
            $("#sub_form2").on('click', function (event) {
                var data = $("#form2").serialize();
                var hp_product_id = $('#hp_product_id').val();
                event.preventDefault();
                $("#card-form2").block({
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
                    url: '/product/' + hp_product_id,
                    type: 'POST',
                    method: 'put',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#card-form2").unblock(), 2000);
                        $('#card-form2').hide();
                        $('#card-form1').show();
                        $('#table').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });
            // end update

            // store new product
            $("#sub_form1").on('click', function (event) {
                var data = $("#form1").serialize();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#card-form1").block({
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
                    url: '/product',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#card-form1").unblock(), 2000);
                        document.getElementById('form1').reset();
                        $('#table').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });
            //end store

            // select property
            $(".select-product-property").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-product-property',
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
                placeholder: ('انتخاب مشخصه ظاهری محصول'),
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__color'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__statistics").text("{{__('Property')}}" + " : " + repo.text + " " + repo.hppi_items_name);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.text || repo.id;
            }

            // end

            // fill data in select product property items
            $(".select-product-property-items").select2({
                dir: "rtl",
                language: "fa",
                ajax: {
                    url: '/json-data-fill-data-product-item',
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
                placeholder: ('انتخاب آیتم مشخه ظاهری محصول'),
                dropdownParent: $('#modalRegisterForm1'),
            });
            // end fill data in select product property items


            // select color
            $(".select-item-color").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/json-data-fill-data-product-color',
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

            $("#submit_modal_color").on('click', function (event) {
                var data =
                    {
                        hn_color_name: $("#orangeForm-name").val()
                    }
                event.preventDefault();

                $("#submit_modal_color").block({
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
                    url: '/product-color',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblock, 2000);
                        $("#modalRegisterForm").find("input").val("");
                        $("#modalRegisterForm").modal('hide');
                        $("#hp_product_color_id").append('<option selected value="' + data.id + '">' + data.name + '</option>');

                    },
                    cache: false,
                });
            });

            $("#modal_form").submit(function (event) {
                var data = $("#modal_form").serialize();
                event.preventDefault();
                $("#modal_form").block({
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
                    url: '/product-property',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblock);
                        $("#modalRegisterForm1").find("input").val("");
                        $("#modalRegisterForm1").find("input").val("");
                        $("#modalRegisterForm1").modal('hide');
                        $("#hp_product_property").append('<option selected  value="' + data.id + '">' + data.name + data.item + '</option>');

                    },
                    cache: false,
                });
            });

            // calender

            // fiil edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form1').hide();
                $('#card-form2').show();
                var data = table.row($(this).parents('tr')).data();
                $('#hp_product_id').val(data[13]);
                $('#hp_product_name').val(data[2]);
                $('#hp_product_model').val(data[3]);
                $('#hp_product_color_id').val(data[9]);
                $('#hp_product_property').val(data[8]);
                $('#hp_product_size').val(data[7]);
                $('#hp_description').val(data[10]);
                $('#product_image').val(data[11]);
                $('#hp_voltage').val(data[6]);
                $('#hp_image').attr('src', 'img/products/' + data[11]);
            })
            // end

            // remove image
            $("#hp_image").on('click', function () {

                // unlink image
                var data = {id: $('#hp_product_id').val()};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/product-destroy-image/' + data.id,
                    type: 'delete',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                    },
                    cache: false,
                });
                $("#hp_image").remove();

            });
            //end removing

        });


        // save image
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                // فایل نوع آبجکت است
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + '-' + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    // اسم اینپوت و مقداری که باید به آن ارسال شود
                    $('#product_image').val(file.upload.filename);
                    $('#product_image1').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving


    </script>
@endpush