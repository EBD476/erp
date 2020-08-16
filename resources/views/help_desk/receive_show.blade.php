@extends('layouts.app')

@section('title','Title')

@push('css')
    <link href="{{asset('assets/css/dropzone.min.css')}}" rel="stylesheet"/>

@endpush

@section('content')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
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
                                                   value="{{$help_desks->hhd_title}}" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Type')}} </label>
                                            <input class="form-control" name="hhd_type"
                                                   value="{{$type_current->th_name}}" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Ticket Status')}}</label>
                                            <input class="form-control" name="hhd_ticket_status"
                                                   value="{{$ticket_status_current->ts_name}}" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row" id="send">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Sender')}}</label>
{{--                                            <input class="form-control" value="{{$user->name}}" disabled>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <input class="form-control" value="{{$priority_current->hdp_name}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Description')}}</label>
                                            <textarea type="text" required=""
                                                      aria-invalid="false" class="form-control"
                                                      disabled> {{$help_desks->hhd_problem}}</textarea>
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
                                <input hidden id="ticket_id" value="{{$help_desks->id}}">
                                <input hidden id="hhd_ticket_id" value="{{$help_desks->hhd_ticket_id}}">
                                <input id="pdf_file_data" value="{{$help_desks->hhd_file_atach}}" hidden>
                            </form>
                            <br>
                            <br>
                            <div class="col-md-12">
                                <label style="margin-top: -20px;">{{__('File')}}</label>
                                @if($help_desks->hhd_file_atach != '')
                                    <a href="{{asset('img/help_desk_request/' . $help_desks->hhd_file_atach)}}" target="_blank">{{__('Download Attached File')}}</a>
                                @endif
                                <div class="card-body col-md-12 row">
                                    <form action="{{url('/help_desk-file-save')}}" class="dropzone"
                                          id="dropzone"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input type="file" class="form-control"
                                                   name="file" multiple>
                                            <div class="dz-image">
                                                <img src="{{asset('img/help_desk_request/' . $help_desks->hhd_file_atach)}}" id="file_uploaded" >
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
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.dz-message').text("برای انتخاب فایل مورد نظر اینجا کلیک کنید");
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
                            window.location.href = '/home'
                        },
                        cache: false,
                    });
                }
            })
            ;
            $('#back-submit-form').on('click', function (event) {
                window.location.href = '/home'
            })
            ;
        });
        // end saving
    </script>
@endpush