@extends('layouts.app')

@section('title',__('Bank'))


@section('content')
    {{--    @can('browse-menu-user')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{__('New Bank')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input name="hfb_name" type="text" class="form-control" required=""
                                                       aria-invalid="false"   >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Bank Account Number')}}</label>
                                                <input name="hfb_bank_account_number" type="text" class="form-control" required=""
                                                       aria-invalid="false"   >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Account ID')}}</label>
                                                <input name="hfb_account_id" type="text" class="form-control" required=""
                                                       aria-invalid="false"   >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Branch')}}</label>
                                                <input name="hfb_branch" type="text" class="form-control" required=""
                                                       aria-invalid="false"   >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Address')}}</label>
                                                <input name="hfb_address" type="text" class="form-control" required=""
                                                       aria-invalid="false"   >
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
                                   {{__('Priority')}}
                                </p>
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
                    url: '/finance_bank',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
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