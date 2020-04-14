@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    @role('Admin')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Increase inventory Product')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product Name')}}</label>
                                            <select class="form-control" name="hr_product_id">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product Stock')}}</label>
                                            <input type="text" class="form-control" required=""
                                                   aria-invalid="false" name="hr_product_stock">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Provider')}}</label>
                                            <select class="form-control"
                                                    aria-invalid="false" name="hr_provider_code">
                                                @foreach($provider as $providers)
                                                    <option value="{{$providers->id}}">
                                                        {{$providers->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Provider')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Comment')}}</label>
                                            <textarea class="form-control" required=""
                                                      aria-invalid="false" name="hr_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Increase inventory Middle Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product Name')}}</label>
                                            <select class="form-control" name="hr_product_id">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product Stock')}}</label>
                                            <input type="text" class="form-control" required=""
                                                   aria-invalid="false" name="hr_product_stock">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Provider')}}</label>
                                            <select class="form-control"
                                                    aria-invalid="false" name="hr_provider_code">
                                                @foreach($provider as $providers)
                                                    <option value="{{$providers->id}}">
                                                        {{$providers->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-light">
                                                <a class="pointer" href="#" data-toggle="modal"
                                                   data-target="#modalRegisterForm">
                                                    {{__('Add New Provider')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                            <input class="form-control" required=""
                                                   aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Comment')}}</label>
                                            <textarea class="form-control" required=""
                                                      aria-invalid="false" name="hr_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="bmd-label-floating">{{__('Status Return Part')}}</label>--}}
                                {{--<input class="form-control" required=""--}}
                                {{--aria-invalid="false" name="hr_status_return_part">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="row form-group">
                                    <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>
                                    <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--//Provider Details Modal//--}}
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{__('New Provider')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="modal_form" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <div class="form-group" data-success="right">
                                <label class="bmd-label-floating" style="float: right">{{__('Name')}}</label>
                                <input class="form-control" name="hp_name">
                            </div>
                        </div>
                        <div class="md-form mb-5">
                            <label class="bmd-label-floating" style="float: right">{{__('Phone')}}</label>
                            <input name="hp_phone" type="number" class="form-control" required=""
                                   aria-invalid="false">
                        </div>
                        <div class="md-form mb-5">
                            <label class="bmd-label-floating" style="float: right">{{__('Address')}}</label>
                            <input name="hp_address" type="text" class="form-control" required=""
                                   aria-invalid="false">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" id="modal_form"
                                class="btn btn-deep-orange">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--end modal--}}
    @endrole
@endsection

@push('scripts')
    <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#form1").submit(function (event) {
                var data = $("#form1").serialize();
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
                    url: '/repository',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        window.location.href = "/repository";
                    },
                    cache: false,
                });
            });
            $("#modal_form").submit(function (event) {
                var data = $("#modal_form").serialize();
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/provider',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        setTimeout($.unblockUI, 2000);
                        $("#modalRegisterForm").modal('hide');
                        $("#provider").append('<option selected>' + data.provider + '</option>');

                    },
                    cache: false,
                });
            });
        });
    </script>
    {{--datapicker--}}
    <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
    <script>
        kamaDatepicker('test-date-id', {
            buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"
        });
    </script>
@endpush