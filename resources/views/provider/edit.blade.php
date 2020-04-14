@extends('layouts.app')

@section('title',__('Products Parts'))


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
                            <h4 class="card-title ">{{__('Edit Provider')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input id="provider-id" data-id="{{$provider->id}}" class="form-control" name="hp_name" value="{{$provider->hp_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Phone')}}</label>
                                            <input name="hp_phone" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$provider->hp_phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Address')}}</label>
                                            <input name="hp_address" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false" value="{{$provider->hp_address}}">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6 pr-md-1">--}}
                                {{--<div class="form-group">--}}
                                {{--<label>{{__('Account Number')}}</label>--}}
                                {{--<input name="hp_account_number" disabled--}}
                                {{--class="form-control"    value="{{$provider->hp_account_number}}">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-fill btn-primary">{{__('Save')}}</button>
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
                        {{--<div class="button-container">--}}
                        {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">--}}
                        {{--<i class="fab fa-facebook"></i>--}}
                        {{--</button>--}}
                        {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">--}}
                        {{--<i class="fab fa-twitter"></i>--}}
                        {{--</button>--}}
                        {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">--}}
                        {{--<i class="fab fa-google-plus"></i>--}}
                        {{--</button>--}}
                        {{--</div>--}}
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
                var data = $("#form1").serialize();
                var provider =$('#provider-id').data('id');
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
                    url: '/provider/' + provider,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    method:'put',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/provider";
                    },
                    cache: false,
                });
            });
        });
    </script>
@endpush