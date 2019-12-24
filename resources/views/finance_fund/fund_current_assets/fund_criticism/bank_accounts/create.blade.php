@extends('layouts.app')

@section('title',__('Bank Account'))


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
                                <h4 class="card-title ">{{__('New Bank Account')}}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form id="form1">
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input name="hba_bank_id" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_bank_id"
                                                       data-id="{{$bank_account->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Balance')}}</label>
                                                <input name="hba_balance" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_balance"
                                                       data-id="{{$bank_account->hba_balance}}">
                                            </div>
                                        </div>
                                    </div> <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Debt')}}</label>
                                                <input name="hba_debt" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_debt"
                                                       data-id="{{$bank_account->hba_debt}}">
                                            </div>
                                        </div>
                                    </div> <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Crediting')}}</label>
                                                <input name="hba_crediting" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_crediting"
                                                       data-id="{{$bank_account->hba_crediting}}">
                                            </div>
                                        </div>
                                    </div> <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Deduction Date')}}</label>
                                                <input name="hba_deduction_date" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_deduction_date">
                                            </div>
                                        </div>
                                    </div> <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Deposit Date')}}</label>
                                                <input name="hba_deposit_date" type="text" class="form-control" required=""
                                                       aria-invalid="false"  id="hba_deposit_date">
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
                var data = $("#form1").serialize();
                event.preventDefault();
                $.blockUI();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/bank_account',
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