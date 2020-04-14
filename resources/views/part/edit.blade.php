@extends('layouts.app')

@section('title',__('Parts'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin|product')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Name')}}</label>
                                            <input hidden name="part_id" id="part_id" value="{{$part->id}}">
                                            <input name="hp_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Code')}}</label>
                                            <input name="hp_code" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_code}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Model')}}</label>
                                            <input name="hp_part_model" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_part_model}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Provider')}}</label>
                                            <input name="hp_provider" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_provider}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Category Id')}}</label>
                                            <input name="hp_category_id" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_category_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Produce Date')}}</label>
                                            <input name="hp_produce_date" type="text" class="form-control"
                                                   aria-invalid="false" value="{{$part->hp_produce_date}}" id="test-date-id">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <label style="margin-top: -20px;">{{__('Image')}}</label>
                            <div class="card-body col-md-6 pr-md-1 row"
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
                                            <div class="dz-image" id="img-remove" style="margin-right: 20px">
                                                <img src={{asset('img/parts/'.$part->hp_part_image)}}>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <br>
                        </div>
                        <div class="row" style="direction: ltr">
                            <div class="card-footer">
                                <button id="sub_form1" type="submit"
                                        class="btn btn-fill btn-primary">{{__('Save')}}</button>
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
                                        {{--<img class="avatar" src="../assets/img/emilyz.jpg" alt="...">--}}
                                        <h5 class="title">Hanta IBMS</h5>
                                    </a>
                            <p class="description">
                                Product
                            </p>
                        </div>
                        </p>
                        <div class="card-description">

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
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $("#sub_form1").on('click', function (event) {
                var data = $("#form1").serialize();
                var part_id = $('#part_id').val();
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
                    url: '/part/' + part_id,
                    type: 'POST',
                    method: 'put',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/part";
                    },
                    cache: false,
                });
            });

            // calendr
            kamaDatepicker('test-date-id', {
                buttonsColor: "blue",
                forceFarsiDigits: true,
                nextButtonIcon: "fa fa-arrow-circle-right",
                previousButtonIcon: "fa fa-arrow-circle-left"
                // end calender
            });
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
                    $('#product_image').val(file.upload.filename);
                },
                error: function (file, response) {
                    return false;
                }
            };
        $("#img-remove").on('click', function () {
            $("#img-remove").remove();
        });
    </script>
@endpush