@extends('layouts.app')

@section('title',__('Bank'))


@section('content')
    {{--@can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Bank Information')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input name="hfb_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$finance_bank->hfb_name}}"
                                                   id="hfb_name"
                                                   data-id="{{$finance_bank->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Bank Account Number')}}</label>
                                            <input name="hfb_bank_account_number" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false"
                                                   value="{{$finance_bank->hfb_bank_account_number}}"
                                                   id="hfb_bank_account_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Account ID')}}</label>
                                            <input name="hfb_account_id" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$finance_bank->hfb_account_id}}"
                                                   id="hfb_account_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Branch')}}</label>
                                            <input name="hfb_branch" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$finance_bank->hfb_branch}}"
                                                   id="hfb_branch">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Address')}}</label>
                                            <input name="hfb_address" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$finance_bank->hfb_address}}"
                                                   id="hfb_address">
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
                var data =
                    {
                        id: $("#hfb_name").data('id'),
                        hfb_name: $("#hfb_name").val(),
                        hfb_bank_account_number: $("#hfb_bank_account_number").val(),
                        hfb_account_id: $("#hfb_account_id").val(),
                        hfb_branch: $("#hfb_branch").val(),
                        hfb_address: $("#hfb_address").val(),
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
                    url: '/finance_bank/' + data.id,
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