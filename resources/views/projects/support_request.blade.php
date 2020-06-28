@extends('layouts.app')

@section('title',__('Support Request'))

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Support Request')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Request Title')}}</label>
                                            <input name="hp_project_name" rows="4" cols="80"
                                                   class="form-control" id="title"
                                                   value="{{$request_support->hs_title}}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input name="hp_project_name" rows="4" cols="80"
                                                   class="form-control" id="hp_project_id"
                                                   data-id="{{$request_support->id}}" disabled
                                                   value="{{$request_support->hp_project_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="hs_description" rows="4" cols="80"
                                                      class="form-control" id="hs_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="file" id="file">
                            </form>
                            <br>
                            <div class="col-md-8">
                                <label style="margin-top: -20px;">{{__('File')}}</label>
                                <div class="card-body col-md-12 row"
                                     style="display: flex ; border: 1px dashed;     margin-right: -35px;}">
                                    <form action="{{url('/request-file-save')}}" class="dropzone" id="dropzone"
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary"
                                        id="submit-form">{{__('Send')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="javascript:void(0)">
                                    <h5 class="title">Hanta IBMS</h5>
                                </a>
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
            <script src="{{asset('assets/js/plugins/dropzone.js')}}"></script>
            <script>
                $(document).ready(function () {

                    $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");

                    $("#submit-form").on('click', function (event) {
                        var data =
                            {
                                id: $("#hp_project_id").data('id'),
                                description: $("#hs_description").val(),
                                title: $("#title").val(),
                                file: $("#file").val()
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
                            url: '/support_request',
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function (data) {
                                setTimeout($.unblockUI, 2000);
                                window.location.href = "/projects";
                            },
                            cache: false,
                        });
                    });
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
                        acceptedFiles: ".jpeg,.jpg,.pdf,",
                        addRemoveLinks: true,
                        timeout: 5000,
                        success: function (file, response) {
                            // اسم اینپوت و مقداری که باید به آن ارسال شود
                            $('#file').val(file.upload.filename);
                        },
                        error: function (file, response) {
                            return false;
                        }
                    };
                // end saving
            </script>
    @endpush