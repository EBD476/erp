@extends('layouts.app')

@section('title',__('Help Desk Type'))


@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Help Desk Type')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input id="th_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" data-id="{{$types->id}}">
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
                            <p class="description">
                                {{__('Help Desk Type')}}
                            </p>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data = {
                    th_name: $('#th_name').val(),
                    id: $('#th_name').data('id'),
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
                $.ajax({
                    url: '/type' + data.id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/type";
                    },
                    cache: false,
                });
            });
        });
    </script>
@endpush