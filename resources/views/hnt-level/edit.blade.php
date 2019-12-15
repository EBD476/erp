@extends('layouts.app')

@section('title',__('HNT Level'))


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
                            <h4 class="card-title ">{{__('Edit Level')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Level Name')}}</label>
                                            <input id="name" name="hp_process_name" type="text" class="form-control" required=""
                                                   aria-invalid="false"
                                                   data-name="{{$level->hp_process_name}}"
                                            value="{{$level->hp_process_name}}" >
                                        </div>
                                    </div>
                                </div>
                                <input id="id"  class="hidden" data-id="{{$level->id}}">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Level ID')}}</label>
                                            <input id="lid" name="hp_process_id" type="number" class="form-control" required=""
                                                   aria-invalid="false"
                                                   data-lid="{{$level->hp_process_id}}"
                                                   value="{{$level->hp_process_id}}">
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
                        var data = {
                            id: $('#id').data('id'),
                            name: $('#name').data('name'),
                            lid: $('#lid').data('lid'),
                        };
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
                        //token
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/level/' + data.id,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function (data) {
                                alert(data.response);
                                setTimeout($.unblockUI, 2000);
                            },
                            cache: false,
                        });
                    });
                });
            </script>
    @endpush