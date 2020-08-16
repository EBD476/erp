@extends('layouts.app')

@section('title',__('Message'))

@push('css')
    <link href="{{asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush
@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            {{--Receive message cartable--}}
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
                                                           name="name" id="name" disabled
                                                           value="{{$conversation_name->name}}">
                                                    <input id="user_receive_id" name="user_receive_id[]" hidden
                                                           value="{{$conversation->hcv_request_user_id}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>{{__('Message')}}</label>
                                                    <textarea class="form-control" id="message_give"
                                                              disabled>{{$conversation->hcv_message}}</textarea>
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
        </div>
        {{--end message cartable--}}
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");

            // reply message
            $("#sub-btn-form2").on('click',function (event) {
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
                        window.location.href = "/home";
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