@extends('layouts.app')

@section('title',__('Message'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin|product|finance|dealership|repository|order|task|support|qc|delivery|install')
    <div class="content persian">
        <div class="container-fluid">
            {{--Receive message cartable--}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="card_1">
                        <div class="card-header">
                            <h3 class="card-title"> {{__('Receive Message List')}}</h3>
                            <h6 class="title d-inline">
                                <button class="btn btn-primary" href="#" id="compose"
                                        data-toggle="modal"
                                        data-target="#modalRegisterForm">{{__('Compose')}}</button>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table1" cellspacing="0" width="100%"
                                       style="text-align: right">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Sender Name')}}
                                        </th>
                                        <th>
                                            {{__('Message')}}
                                        </th>
                                        <th>
                                            {{__('Created at')}}
                                        </th>
                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="card-form1">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Compose Message')}}</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <form id="form1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label>{{__('Send Message TO')}}</label>
                                                <div class="form-group">
                                                    <select name="user_receive_id[]"
                                                            class="form-control select-receiver-user"
                                                            multiple="multiple">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>{{__('Message')}}</label>
                                                    <textarea name="message" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="file" id="file">
                                    </form>
                                    <br>
                                    <div class="col-md-8">
                                        <label style="margin-top: -20px;">{{__('File')}}</label>
                                        <div class="card-body col-md-12 row">
                                            <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                                  id="dropzone"
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
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="sub-btn-form1"
                                            class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                    <button id="back_form1"
                                            class="btn btn-fill btn-primary">{{__('Back')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--reply box--}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="card-form2">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title" id="request_user"></h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <form id="form2">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>{{__('Name')}}</label>
                                                    <input class="form-control"
                                                           name="name" id="name" disabled>
                                                    <input id="user_receive_id" name="user_receive_id[]" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>{{__('Message')}}</label>
                                                    <textarea class="form-control" id="message_give"
                                                              disabled></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>{{__('Reply')}}</label>
                                                    <textarea name="message" type="text" class="form-control"
                                                              required=""
                                                              aria-invalid="false"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="file" id="file2">
                                        <input id="file_data" hidden>
                                    </form>
                                    <br>
                                    <div class="col-md-8">
                                        <label style="margin-top: -20px;">{{__('File')}}</label>
                                        <button id="file_show" style="margin-left:33px; "
                                                class="btn-outline-light">{{__('Download Attached File')}}</button>
                                        <div class="card-body col-md-12 row">
                                            <form action="{{url('/request-message-file-save')}}" class="dropzone"
                                                  id="dropzone"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group">
                                                    <input type="file" class="form-control"
                                                           name="file2" multiple>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="sub-btn-form2"
                                            class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                    <button id="back_form2"
                                            class="btn btn-fill btn-primary">{{__('Back')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end message cartable--}}

            {{--Send message cartable--}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="card_2">
                        <div class="card-header">
                            <h3 class="card-title"> {{__('Send Message List')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="table2" cellspacing="0" width="100%"
                                       style="text-align: right">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            {{__('ID')}}
                                        </th>
                                        <th>
                                            {{__('Receiver Name')}}
                                        </th>
                                        <th>
                                            {{__('Message')}}
                                        </th>
                                        <th id="created_at">
                                            {{__('Created at')}}
                                        </th>
                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--inbox--}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="card-form3">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title" id="receive_user"></h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <button id="file_show_inbox"
                                                        class="btn-outline-light">{{__('Download Attached File')}}</button>
                                              <br>
                                                <label>{{__('Name')}}</label>
                                                <input class="form-control"
                                                       name="name_show" id="name_show" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Message')}}</label>
                                                <textarea class="form-control" id="message_send" disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                   <input id="file_data_inbox" hidden>
                                    <div class="card-footer">
                                       <button id="back_form3"
                                                class="btn btn-fill btn-primary">{{__('Back')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end message cartable--}}
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('#card-form1').hide();
            $('#card-form2').hide();
            $('#card-form3').hide();

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");


            var table = $('#table1').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-message-receive',
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
                                "                                                                <a class=\"dropdown-item reply\"\n" +
                                "                                                                >{{__('Reply')}}</a>\n" +
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
            var table2 = $('#table2').on('draw.dt', function (e, settings, json, xhr) {

            }).DataTable({
                "processing":
                    true,
                "serverSide":
                    true,
                "ajax":
                    '/json-data-message-send',
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

            // compose message
            $("#sub-btn-form1").on('click', function (event) {
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
                    url: '/conversation_view',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($("#form1").unblock(), 2000);
                        document.getElementById('form1').reset();
                        $('#table1').DataTable().ajax.reload();
                        $('#table2').DataTable().ajax.reload();
                        $('#card-form1').hide();
                        $('#card_1').show();
                    },
                    cache: false,
                });
            });

            // reply message
            $("#sub-btn-form2").on('click', function (event) {
                var data = $("#form2").serialize();
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
                    url: '/conversation_view',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($('#form2').unblock(), 2000);
                        $('#table1').DataTable().ajax.reload();
                        $('#table2').DataTable().ajax.reload();
                        $('#card-form2').hide();
                        $('#card_1').show();
                    },
                    cache: false,
                });
            });

            // fill data in reply form
            $('#table1').on('click', '.reply', function (event) {
                var data = table.row($(this).parents('tr')).data();
                // update status
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/update-status/' + data[4],
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method: 'put',
                    async: false,
                    success: function (data) {
                    },
                    cache: false,
                });
                $('#card_1').hide();
                $('#card-form2').show();
                $('#id').val(data[4]);
                $('#user_receive_id').val(data[5]);
                $('#message_give').val(data[2]);
                $('#name').val(data[1]);
                $('#request_user').text("{{__('Reply Message')}} " + data[1] + " ");
                $('#file_data').val(data[6]);
                if (data[6] != '') {
                    $('#file_show').show();
                }
                // end
            });
            // end filling

            // fill data in show form
            $('#table2').on('click', '.show', function (event) {
                var data = table2.row($(this).parents('tr')).data();
                // update status
                $('#card_2').hide();
                $('#card-form3').show();
                $('#message_send').val(data[2]);
                $('#name_show').val(data[1]);
                $('#receive_user').text("{{__('Show Message')}} " + data[1] + " ");
                $('#file_data_inbox').val(data[6]);
                if (data[6] != '') {
                    $('#file_show_inbox').show();
                }
                // end
            });
            // end filling

            // compose form show
            $('#compose').on('click', function () {
                $('#card_1').hide();
                $('#card-form1').show();
            });
            {{--end message cartable--}}

            // back to message list
            $('#back_form1').on('click', function () {
                $('#card-form1').hide();
                $('#card_1').show();
            });
            $('#back_form2').on('click', function () {
                $('#card-form2').hide();
                $('#card_1').show();

            });
            $('#back_form3').on('click', function () {
                $('#card-form3').hide();
                $('#card_2').show();

            });
            // end back

            // select receiver
            $(".select-receiver-user").select2({
                ajax: {
                    dir: "rtl",
                    language: "fa",
                    url: '/fill-data-limited-user',
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
                placeholder: ('انتخاب کاربر'),
                dir: "rtl",
                templateResult: formatRepo,
                templateSelection: formatRepoSelection2,
                tags: true,
                tokenSeparators: [',', ' ']
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

                $container.find(".select2-result-repository__statistics").text("{{__('Position')}}" + " : " + repo.position + " " + "{{__('Name')}}" + " : " + repo.text);

                return $container;
            }

            function formatRepoSelection2(repo) {
                return repo.text || repo.id;
            }

            // end

//          onclick on table cell
            {{--$('#table1').on('click', 'td', function () {--}}
                {{--var data = table.row($(this).parents('tr')).data();--}}
                {{--// update status--}}
                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--}--}}
                {{--});--}}

                {{--$.ajax({--}}
                    {{--url: '/update-status/' + data[4],--}}
                    {{--type: 'POST',--}}
                    {{--data: data,--}}
                    {{--dataType: 'json',--}}
                    {{--method: 'put',--}}
                    {{--async: false,--}}
                    {{--success: function (data) {--}}
                    {{--},--}}
                    {{--cache: false,--}}
                {{--});--}}
                {{--$('#card_1').hide();--}}
                {{--$('#card-form2').show();--}}
                {{--$('#id').val(data[4]);--}}
                {{--$('#user_receive_id').val(data[5]);--}}
                {{--$('#message_give').val(data[2]);--}}
                {{--$('#name').val(data[1]);--}}
                {{--$('#request_user').text("{{__('Reply Message')}} " + data[1] + " ");--}}
                {{--$('#file_data').val(data[6]);--}}
                {{--if (data[6] != '') {--}}
                    {{--$('#file_show').show();--}}
                {{--}--}}
                {{--// end--}}
            {{--});--}}
            {{--$('#table2').on('click', 'td', function () {--}}
                {{--var data = table2.row($(this).parents('tr')).data();--}}
                {{--// update status--}}
                {{--$('#card_2').hide();--}}
                {{--$('#card-form3').show();--}}
                {{--$('#message_send').val(data[2]);--}}
                {{--$('#name_show').val(data[1]);--}}
                {{--$('#receive_user').text("{{__('Show Message')}} " + data[1] + " ");--}}
                {{--$('#file_data_inbox').val(data[6]);--}}
                {{--if (data[6] != '') {--}}
                    {{--$('#file_show_inbox').show();--}}
                {{--}--}}
                {{--// end--}}
            {{--});--}}

            // download data file
            $('#file_show').on('click', function (event) {
                window.open('img/request_message_file/' + $('#file_data').val(), '_blank');
            });

            $('#file_show_inbox').on('click', function (event) {
                window.open('img/request_message_file/' + $('#file_data_inbox').val(), '_blank');
            });
            // end
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
                acceptedFiles: ".jpeg,.jpg,.pdf,.mp4",
                addRemoveLinks: true,
                timeout: 5000,
                success: function (file, response) {
                    // اسم اینپوت و مقداری که باید به آن ارسال شود
                    $('#file').val(file.upload.filename);
                    $('#file2').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving
    </script>
@endpush