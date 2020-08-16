@extends('layouts.app')

@section('title',__('Help Desk'))

@push('css')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Help Desk Send Ticket')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="height: 80vmin!important">
                                <table id="table2" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Title')}}
                                    </th>
                                    <th>
                                        {{__('Ticket Id')}}
                                    </th>
                                    <th>
                                        {{__('Priority')}}
                                    </th>
                                    <th>
                                        {{__('Status')}}
                                    </th>
                                    <th>
                                        {{__('Type')}}
                                    </th>
                                    <th>
                                        {{__('Create At')}}
                                    </th>
                                    <th>
                                        {{__('action')}}
                                    </th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Help Desk Receive Ticket')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="height: 80vmin!important">
                                <table id="table1" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-primary">
                                    <th>
                                        {{__('ID')}}
                                    </th>
                                    <th>
                                        {{__('Title')}}
                                    </th>
                                    <th>
                                        {{__('Sender')}}
                                    </th>
                                    <th>
                                        {{__('Ticket Id')}}
                                    </th>
                                    <th>
                                        {{__('Priority')}}
                                    </th>
                                    <th>
                                        {{__('Status')}}
                                    </th>
                                    <th>
                                        {{__('Type')}}
                                    </th>
                                    <th>
                                        {{__('Create At')}}
                                    </th>
                                    <th>
                                        {{__('action')}}
                                    </th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user" id="card-form1">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('Help Desk')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Title')}}</label>
                                                <input required="" type="text" name="hhd_title"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Type')}}</label>
                                                <select class="form-control" name="hhd_type">
                                                    @foreach($type as $types_1)
                                                        @if($role_id != '')
                                                            @foreach($role_id as $roles_id)
                                                                @if($types_1->id == $roles_id->hhd_type_id)
                                                                    <option value="{{$types_1->id}}">
                                                                        {{$types_1->th_name}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Priority')}}</label>
                                                <select class="form-control" name="hhd_priority">
                                                    @foreach($priority as $priority_1)
                                                        <option value="{{$priority_1->id}}">
                                                            {{$priority_1->hdp_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Ticket Status')}}</label>
                                                <select class="form-control" name="hhd_ticket_status" disabled>
                                                    @foreach($ticket as $tickets)
                                                        <option value="{{$tickets->id}}">
                                                            {{$tickets->ts_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Description')}}</label>
                                                <textarea type="text" required=""
                                                          aria-invalid="false" class="form-control"
                                                          name="hhd_problem"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="file" id="file">
                                </form>
                                <br>
                                <div class="col-md-12">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/help_desk-file-save')}}" class="dropzone" id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn badge-primary"
                                        id="submit-form">{{__('Send')}}</button>
                            </div>

                        </div>
                    </div>
                    <div class="card card-user" id="card-form2">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('show Message')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Title')}}</label>
                                                <input required="" type="text" name="hhd_title"
                                                       class="form-control"
                                                       id="hhd_title" disabled>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Type')}} </label>
                                                <input class="form-control" name="hhd_type"
                                                       id="hhd_type" disabled>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Ticket Status')}}</label>
                                                <input class="form-control" name="hhd_ticket_status"
                                                       id="hhd_ticket_status" disabled>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" id="send">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Sender')}}</label>
                                                <input class="form-control" id="hhd_sender" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Priority')}}</label>
                                                <input class="form-control" id="hdp_name" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Description')}}</label>
                                                <textarea type="text" required=""
                                                          aria-invalid="false" class="form-control"
                                                          id="hdp_description"
                                                          disabled></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">{{__('Response')}}</label>
                                                <textarea type="text" required=""
                                                          aria-invalid="false" class="form-control"
                                                          name="hhd_problem" id="hdp_response"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <input hidden id="ticket_id">
                                    <input hidden id="hhd_ticket_id">
                                    <input id="pdf_file_data" hidden>
                                </form>
                                <br>
                                <br>
                                <div class="col-md-12">
                                    <label style="margin-top: -20px;">{{__('File')}}</label>
                                    <button id="pdf_file" style="margin-left:33px; "
                                            class="btn-outline-light">{{__('Download Attached File')}}</button>
                                    <div class="card-body col-md-12 row">
                                        <form action="{{url('/help_desk-file-save')}}" class="dropzone" id="dropzone"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="file" class="form-control"
                                                       name="file" multiple>
                                                <div class="dz-image">
                                                    <img src="" id="file_uploaded">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <div class="row" id="check">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Verify Ticket')}}</label>
                                            <div class="form-check ">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox"
                                                           id="checkbox">
                                                    <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn badge-primary"
                                            id="back-submit-form">{{__('Back')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('#pdf_file').hide();

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");

            $('#card-form2').hide();

            // fill sender table
            $('#table2').on('click', 'button', function (event) {

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
                                url: '/help_desk-destroy/' + data[15],
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
            var table = $('#table2').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-help-desk',
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
                                "                                                                <a class=\"dropdown-item show-send\"\n" +
                                "                                                                >{{__('Show')}}</a>\n" +
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
            // end filling

            // fill data in edit form send
            $('#table2').on('click', '.show-send', function (event) {
                document.getElementById("hdp_response").disabled = true;
                $('#card-form1').hide();
                $('#card-form2').show();
                $('#check').hide();
                $('#send').hide();
                $('#receive').show();
                var data = table.row($(this).parents('tr')).data();
                $('#ticket_id').val(data[15]);
                $('#hhd_receiver').val(data[2]);
                $('#hdp_name').val(data[3]);
                $('#hhd_title').val(data[1]);
                $('#hhd_type').val(data[5]);
                $('#hhd_ticket_status').val(data[4]);
                $('#hdp_description').val(data[7]);
                $("#hdp_response").val(data[14]);
                $('#file_uploaded').attr('src', 'img/help_desk_request/' + data[13]);
                $('#pdf_file_data').val(data[13])
                if(data[13] != ''){
                    $('#pdf_file').show();
                }
            });
            // end filling


            $('#pdf_file').on('click', function (event) {
                window.open('img/help_desk_request/' + $('#pdf_file_data').val(), '_blank');
            });


            // fill receiver table
            $('#table1').on('click', 'button', function (event) {

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
                                url: '/help_desk-destroy/' + data[16],
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
                            $('#table1').DataTable().ajax.reload();
                        } else {
                            swal(
                                "{{__("Your imaginary file is safe!")}}",
                                {button: "{{__('Done')}}"}
                            );

                        }
                    });
            });
            var table2 = $('#table1').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-help-desk-r',
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
                                "                                                                <a class=\"dropdown-item show\"\n" +
                                "                                                                >{{__('Show')}}</a>\n" +
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
            // end filling

            // fill data in edit form receive
            $('#table1').on('click', '.show', function (event) {
                document.getElementById("hdp_response").disabled = false;
                $('#card-form1').show();
                $('#card-form2').show();
                $('#check').show();
                $('#send').show();
                $('#receive').hide();

                var data = table2.row($(this).parents('tr')).data();
                $('#ticket_id').val(data[16]);
                $('#hhd_ticket_id').val(data[3]);
                $('#hhd_sender').val(data[2]);
                $('#hdp_name').val(data[4]);
                $('#hhd_title').val(data[1]);
                $('#hhd_type').val(data[6]);
                $('#hhd_ticket_status').val(data[5]);
                $('#hdp_description').val(data[8]);
                $("#hdp_response").val(data[15]);
                $('#file_uploaded').attr('src', 'img/help_desk_request/' + data[14]);
                $('#pdf_file_data').val(data[14]);
                if(data[14] != ''){
                    $('#pdf_file').show();
                }

                // change ticket status
                var data = {id: $("#ticket_id").val()};
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/receive_show/' + data.id,
                    type: 'POST',
                    data: data,
                    method: 'put',
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        $('#table1').DataTable().ajax.reload();
                    },
                    cache: false,
                });

            })
            // end filling

            //////////////////////////////

            // store help desk
            $("#submit-form").on('click', function (event) {
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
                    url: '/help_desk',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form1").unblock(), 2000);
                        document.getElementById('form1').reset();
                        $('#table2').DataTable().ajax.reload();
                    },
                    cache: false,
                });
            });

            // verify ticket
            $('#checkbox').on('change', function (event) {

                if (event.target.checked) {
                    var data = {
                        id: $("#ticket_id").val(),
                        state: $(this)[0].checked == true ? 3 : 2,
                        hhd_response: $("#hdp_response").val(),
                        hhd_ticket_id: $("#hhd_ticket_id").val(),
                    };
                    $('#card-form2').block({
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
                        url: '/receive_verify/' + data.id,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            setTimeout($('#card-form2').unblock(), 2000);
                            $('#table1').DataTable().ajax.reload();
                            $('#card-form2').hide();
                            $('#card-form1').show();
                        },
                        cache: false,
                    });
                }
            })
            ;
            $('#back-submit-form').on('click', function (event) {
                $('#card-form2').hide();
                $('#card-form1').show();
            })
            ;

        })
        ;

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
                acceptedFiles: ".jpeg,.jpg,.pdf,.mp4",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    // اسم اینپوت و مقداری که باید به آن ارسال شود
                    $('#file').val(file.upload.filename);
                    $('#file_uploaded').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving
    </script>
@endpush