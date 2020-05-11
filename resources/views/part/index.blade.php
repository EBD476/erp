@extends('layouts.app')

@section('title',__('Parts'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title text-right font-weight-400">{{__('Part List')}}</h4>
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
                                        {{__('Size')}}
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
                    <div class="card card-user" id="card-form2">
                        <div class="card-body">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('New Part')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <form id="form2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Part Name')}}</label>
                                            <input name="hp_name" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Part Model')}}</label>
                                            <input name="hp_part_model" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Part Size')}}</label>
                                            <input name="hp_size" type="text" class="form-control" required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Main Unit')}}</label>
                                            <input name="hp_main_unit" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Category Id')}}</label>
                                            <input name="hp_category_id" type="number" class="form-control"
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Produce Date')}}</label>
                                            <input name="hp_produce_date" class="form-control"
                                                   required="" id="test-date-id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input name="hp_description" type="text" class="form-control"
                                                   aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="part_image" id="part_image">
                            </form>
                            <br>
                            <label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-12 row"
                                 style="display: flex ; border: 1px dashed;     margin-right: -35px;}">
                                <form action="{{url('/part-image-save')}}" class="dropzone" id="dropzone"
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
                            <button id="sub_form2" type="submit"
                                    class="btn btn-fill btn-primary">{{__('Save')}}</button>
                        </div>
                    </div>
                    <div class="card card-user" id="card-form1">
                        <div class="card-body">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Edit Part')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Part Name')}}</label>
                                                <input hidden name="part_id" id="part_id">
                                                <input name="hp_name" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false" id="hp_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Code')}}</label>
                                                <input name="hp_code" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false" id="hp_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Part Model')}}</label>
                                                <input name="hp_part_model" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false" id="hp_part_model">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Part Size')}}</label>
                                                <input name="hp_size" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false" id="hp_size">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Main Unit')}}</label>
                                                <input name="hp_main_unit" type="text" class="form-control"
                                                       required=""
                                                       aria-invalid="false" id="hp_main_unit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('Description')}}</label>
                                                <input name="hp_description" type="text" class="form-control"
                                                       aria-invalid="false" id="hp_description">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="part_image1" id="part_image1">
                                </form>
                                <label style="margin-top: -20px;">{{__('Image')}}</label>
                                <div class="card-body col-md-12 row"
                                     style="display: flex ; border: 1px dashed;     margin-right: -35px;}">
                                    <form action="{{url('/part-image-save')}}" class="dropzone"
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
                                                <div class="dz-image" id="img-remove"
                                                     style="margin-right: 20px">
                                                    <img src="" id="hp_image">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="direction: ltr">
                            <div class="card-footer">
                                <button id="sub_form1" type="submit"
                                        class="btn btn-fill btn-primary">{{__('Save')}}</button>
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
    <script src="{{asset('assets/js/plugins/dropzone.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            $('#card-form1').hide();

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
                                url: '/part-destroy/' + data[7],
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
                    '/json-data-part',
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
                    },],
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

            // update part
            $("#sub_form1").on('click', function (event) {
                var data = $("#form1").serialize();
                var part_id = $('#part_id').val();
                event.preventDefault();
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/part/' + part_id,
                    type: 'POST',
                    method: 'put',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#card-form1").unblock(), 2000);
                        $('#card-form1').hide();
                        $('#card-form2').show();
                        $('#table').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });
            // end update

            // store new part
            $("#sub_form2").on('click', function (event) {
                var data = $("#form2").serialize();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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
                $.ajax({
                    url: '/part',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#card-form2").unblock(), 2000);
                        document.getElementById('form2').reset();
                        $('#table').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });
            //end store

            // calendr
            kamaDatepicker('test-date-id', {
                buttonsColor: "blue",
                forceFarsiDigits: true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
                // end calender
            });

            // remove image
            $("#img-remove").on('click', function () {
                $("#img-remove").remove();
            });
            // end removing

            // fiil edit form
            $('#table').on('click', '.edit', function (event) {
                $('#card-form2').hide();
                $('#card-form1').show();
                var data = table.row($(this).parents('tr')).data();
                $('#part_id').val(data[7]);
                $('#hp_name').val(data[1]);
                $('#hp_code').val(data[2]);
                $('#hp_part_model').val(data[3]);
                $('#hp_size').val(data[4]);
                $('#hp_main_unit').val(data[8]);
                $('#hp_description').val(data[5]);
                $('#part_image1').val(data[6]);
                $('#hp_image').attr('src', 'img/parts/' + data[6]);
            })
            // end


            // remove image
            $("#hp_image").on('click', function () {
                // unlink image
                var data = {id: $('#part_id').val()};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/part-destroy-image/' + data.id,
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
    </script>
@endpush