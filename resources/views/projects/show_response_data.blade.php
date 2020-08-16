@extends('layouts.app')

@section('title',__('Response Support Request'))

@push('css')
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|order')
    <div class="content persian">
        <div class="container-fluid">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Show Response Detail')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form id="form1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Request Title')}}</label>
                                        <input rows="4" cols="80" id="title"
                                               class="form-control" disabled
                                               value="{{$request->hs_title}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Request User Name')}}</label>
                                        @foreach($user as $users)
                                            @if($users->id == $request->hs_request_user_id)
                                                <input rows="4" cols="80"
                                                       class="form-control" disabled
                                                       value="{{$users->name}}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Name')}}</label>
                                        <input rows="4" cols="80"
                                               class="form-control" disabled
                                               value="{{$project->hp_project_name}}">
                                        <input hidden id="id" value="{{$project->id}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Type')}}</label>
                                        <input rows="4" cols="80"
                                               class="form-control" disabled
                                               value="{{$project->hp_project_type}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Owner')}}</label>
                                        <input rows="4" cols="80"
                                               class="form-control" disabled
                                               value="{{$client->hc_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Owner Phone')}}</label>
                                        <input rows="4" cols="80"
                                               class="form-control" disabled
                                               value="{{$project->hp_project_owner_phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Address')}}</label>
                                        <textarea rows="4" cols="80"
                                                  class="form-control" disabled
                                        >{{$project->hp_project_address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Project Description')}}</label>
                                        <textarea rows="4" cols="80"
                                                  class="form-control"
                                                  disabled>{{$request->hs_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('Support Response')}}</label>
                                        <textarea rows="4" cols="80"
                                                  class="form-control" id="hs_response"
                                                  disabled>{{$request->hs_response}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if($request->hs_attach_file_from_support != "")
                                <a href="{{asset('img/support_response/' . $request->hs_attach_file_from_support)}}"
                                   target="_blank">{{__('Download Attached File')}}</a>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('New Project Description')}}</label>
                                        <textarea id="description" rows="4" cols="80"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="file" id="file">
                        </form>
                        <br>
                        <div class="col-md-12">
                            <label style="margin-top: -20px;">{{__('File')}}</label>
                            <div class="card-body col-md-12 row">
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
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="sub-btn"
                                class="btn btn-fill btn-primary">{{__('Submit')}}</button>
                        <button type="submit" id="back"
                                class="btn btn-fill btn-primary">{{__('Back')}}</button>
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
                                {{--<img class="avatar" src="../assets/img/emilyz.jpg" alt="...">--}}
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
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");


            $("#sub-btn").on('click', function (event) {

                var data =
                    {
                        title: $('#title').val(),
                        id: $('#id').val(),
                        description: $('#description').val(),
                        file: $('#file').val(),
                    };
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
                    },
                    cache: false,
                });
            });
        })
        ;

        $('#back').on('click', function (event) {
            window.location.href = '/projects'
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
                },
                error: function (file, response) {
                    return false;
                }
            };
        // end saving
    </script>
@endpush