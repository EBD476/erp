@extends('layouts.app')

@section('title',__('Middle Part'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
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
                            <h4 class="card-title text-right font-weight-400">{{__('Middle Part List')}}</h4>
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
                                        {{__('Code')}}
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
                        <div class="card-body">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('New Middle Part')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input name="hmp_name" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false">
                                            </div>
                                        </div>
                                    </div>
                                    @if($status->hpscsn_activation == 1)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Serial Number')}}</label>
                                                    <input name="hmp_serial_number" type="text" class="form-control"
                                                           aria-invalid="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{__('Part Number')}}</label>
                                                    <input name="hmp_part_number" type="text" class="form-control"
                                                           aria-invalid="false">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Model')}}</label>
                                                <input name="hmp_middle_part_model" type="text"
                                                       class="form-control"
                                                       required=""
                                                       aria-invalid="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Property')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-product-property"
                                                        name="hmp_middle_part_property"></select>
                                            </div>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm1">
                                                    {{__('Add New Property')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Color')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-item-color"
                                                        name="hmp_middle_part_color"></select>
                                            </div>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Color')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Voltage')}}</label>
                                            <div class="form-group">
                                                <input class="form-control"
                                                        name="hmp_voltage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Description')}}</label>
                                                <textarea name="hmp_description" type="number"
                                                          class="form-control"
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="part_image" id="part_image">
                                </form>
                                <br>
                                <label style="margin-top: -20px;">{{__('Image')}}</label>
                                <div class="card-body col-md-12 row">
                                    <form action="{{url('/middle-part-image-save')}}" class="dropzone" id="dropzone"
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
                                <div class="card-footer">
                                    <button id="sub_form1" type="submit"
                                            class="btn btn-fill btn-primary">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card card-user" id="card-form2">
                        <div class="card-body">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Edit Middle Part')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input hidden name="id" id="id">
                                                <input name="hmp_name" id="hmp_name" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Code')}}</label>
                                                <input name="hmp_serial_number" id="hmp_serial_number" type="text"
                                                       class="form-control" required=""
                                                       aria-invalid="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Model')}}</label>
                                                <input name="hmp_middle_part_model" id="hmp_middle_part_model"
                                                       type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Property')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-product-property"
                                                        name="hmp_middle_part_property">
                                                    <option id="hmp_middle_part_property"></option>
                                                </select>
                                            </div>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm1">
                                                    {{__('Add New Property')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Color')}}</label>
                                            <div class="form-group">
                                                <select class="form-control select-item-color"
                                                        name="hmp_middle_part_color">
                                                    <option id="hmp_middle_part_color"></option>
                                                </select>
                                            </div>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Color')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{__('Voltage')}}</label>
                                            <div class="form-group">
                                                <input class="form-control"
                                                       name="hmp_voltage" id="hmp_voltage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Description')}}</label>
                                                <textarea name="hmp_description" id="hmp_description" type="number"
                                                          class="form-control"
                                                          aria-invalid="false"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="part_image1" id="part_image1">
                                </form>
                                <br>
                                <label style="margin-top: -20px;">{{__('Image')}}</label>
                                <div class="card-body col-md-12 row">
                                    <form action="{{url('/middle-part-image-save')}}" class="dropzone"
                                          id="dropzone"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file">
                                            </div>
                                            <div class="dz-preview dz-processing dz-image-preview dz-complete">
                                                <div class="dz-image">
                                                    <img src="" id="hp_image">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="row" style="direction: ltr">
                            <div class="card-footer">
                                <button id="sub_form2" type="submit"
                                        class="btn btn-fill btn-primary">{{__('Save')}}</button>
                            </div>
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
                                   for="orangeForm-name" style="display: flex;">{{__('Color')}}</label>
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
                            <div class="form-group">
                                <label style="display: flex;margin-top: -40px;margin: -20px;margin-right: 4px;">{{__('Items')}}</label>
                                <select name="hpp_property_items" class="select-item-item form-control"></select>
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

    <script>
        $(document).ready(function () {

            $('.dz-message').text("برای انتخاب تصویر مورد نظر اینجا کلیک کنید");


            $('#card-form2').hide();

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
                                url: '/middle-part-destroy/' + data[11],
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
                    '/json-data-middle-part',
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

            // store new middle part
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
                    url: '/middle-part',
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
            // end

            // update middle part
            $("#sub_form2").on('click', function (event) {
                var data = $("#form2").serialize();
                var id = $('#id').val();
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
                    url: '/middle-part/' + id,
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
            // end updating

            // create new color
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
            // end

            // create new property
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
                        $("#modalRegisterForm1").modal('hide');
                        $("#hp_product_property").append('<option selected  value="' + data.id + '">' + data.name + data.item + '</option>');

                    },
                    cache: false,
                });
            });
            // end

            // fill data in edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form1').hide();
                $('#card-form2').show();
                var data = table.row($(this).parents('tr')).data();
                $('#id').val(data[11]);
                $('#hmp_name').val(data[1]);
                $('#hmp_middle_part_model').val(data[3]);
                $('#hmp_serial_number').val(data[2]);
                $('#hmp_middle_part_property').val(data[8]);
                $('#hmp_voltage').val(data[6]);
                $('#hmp_middle_part_color').val(data[7]);
                $('#hmp_description').val(data[9]);
                $('#hp_image').attr('src', 'img/middle_parts/' + data[10]);

            })
            // endfilling

            // select prpperty
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

            // product property item
            $(".select-item-item").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
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
                dropdownParent: $("#modal_form"),
                theme: "bootstrap",
                placeholder: ('انتخاب آیتم محصول'),
                dir: "rtl",
            });
            // end

            // calendr
            kamaDatepicker('test-date-id', {
                buttonsColor: "blue",
                forceFarsiDigits: true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
            });
            // end calender

            // remove image
            $("#hp_image").on('click', function () {

                // unlink image
                var data = {id: $('#id').val()};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/middle-part-destroy-image/' + data.id,
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

        // drop zone
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
                    $('#part_image').val(file.upload.filename);
                    $('#part_image1').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // enddropzone
    </script>
@endpush