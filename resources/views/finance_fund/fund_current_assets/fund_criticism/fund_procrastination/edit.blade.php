@extends('layouts.app')

@section('title',__('Procrastination'))


@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Procrastination')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input name="hfp_user_id" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$procrastination->hfp_user_id}}"
                                                   id="hfp_user_id"
                                                   data-id="{{$procrastination->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Type')}}</label>
                                            <input name="hfp_type_id" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$procrastination->hfp_type_id}}"
                                                   id="hfp_type_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Amount')}}</label>
                                            <input name="hfp_amount" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$procrastination->hfp_amount}}"
                                                   id="hfp_amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input name="hfp_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$procrastination->hfp_name}}"
                                                   id="hfp_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Receive Name')}}</label>
                                            <input name="hfp_user_id_receive" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$procrastination->hfp_user_id_receive}}"
                                                   id="hfp_user_id_receive">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Save')}}</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--@endcan--}}
        @endsection

        @push('scripts')
            <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $("#form1").submit(function (event) {
                        var data =
                            {
                                id: $("#hfp_user_id").data('id'),
                                hfp_user_id: $("#hfp_user_id").val(),
                                hfp_type_id: $("#hfp_type_id").val(),
                                hfp_amount: $("#hfp_amount").val(),
                                hfp_name: $("#hfp_name").val(),
                                hfp_user_id_receive: $("#hfp_user_id_receive").val(),
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
                            url: '/procrastinations/' + data.id,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            method: 'put',
                            async: false,
                            success: function (data) {
                                setTimeout($.unblockUI, 2000);
                                location.reload();
                            },
                            cache: false,
                        });
                    });
                });
            </script>
    @endpush