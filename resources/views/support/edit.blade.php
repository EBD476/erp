@extends('layouts.app')

@section('title',__('Response Support Request'))

@push('css')
    <link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                {{--<div class="col-md-12">--}}
                {{--@include('layouts.partial.Msg')--}}
                {{--</div>--}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Send Response')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Request Title')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" disabled
                                                   value="{{$request->hs_title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Response User Name')}}</label>
                                                    <input rows="4" cols="80"
                                                           class="form-control" disabled
                                                           value={{auth()->user()->name}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Name')}}</label>
                                            <input  rows="4" cols="80"
                                                    class="form-control"  disabled
                                                    value="{{$project->hp_project_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Owner')}}</label>
                                            <input  rows="4" cols="80"
                                                    class="form-control"  disabled
                                                    value="{{$project->hp_project_owner}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Owner Phone')}}</label>
                                            <input  rows="4" cols="80"
                                                    class="form-control"  disabled
                                                    value="{{$project->hp_project_owner_phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Type')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control"  disabled
                                                   value="{{$project_type->hp_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Address')}}</label>
                                            <input rows="4" cols="80"
                                                   class="form-control" id="hp_project_id" disabled
                                                   value="{{$project->hp_project_address}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('Project Description')}}</label>
                                            <textarea name="hs_description" rows="4" cols="80"
                                                      class="form-control" id="request_id"
                                                      disabled data-id="{{$request->id}}">{{$request->hs_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('Support Response')}}</label>
                                            <textarea name="hs_description" rows="4" cols="80"
                                                      class="form-control" id="hs_response"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Send')}}</button>
                                </div>
                            </form>
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
                        </p>
                        <div class="card-description">

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                                <i class="fab fa-google-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--@endcan--}}
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data =
                    {
                        id:$('#request_id').data('id'),
                        response : $('#hs_response').val(),
                    }
                event.preventDefault();
                $.blockUI();
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
                    url: '/support/'+data.id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method:'PUT',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/support";
                    },
                    cache: false,
                });
            });
        })
        ;
    </script></div>
    @endrole
@endpush