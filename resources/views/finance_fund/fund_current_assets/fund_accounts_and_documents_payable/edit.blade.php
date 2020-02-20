@extends('layouts.app')

@section('title',__('Fund Accounts And Documents Payable'))


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
                            <h4 class="card-title ">{{__('Edit Fund Accounts And Documents Payable')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Invoice Number')}}</label>
                                            <input name="hfaadp_invoice_number" type="number" class="form-control"
                                                   required=""
                                                   aria-invalid="false" id="hfaadp_invoice_number"
                                                   data-id="{{ $fund_accounts_document_payables->id}}"
                                                   value="{{ $fund_accounts_document_payables->hfaadp_invoice_number}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Invoice Description')}}</label>
                                            <input name="hfaadp_invoice_description" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false" id="hfaadp_invoice_description"
                                                   value="{{$fund_accounts_document_payables->hfaadp_invoice_description}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Invoice Date')}}</label>
                                            <input name="hfaadp_invoice_date" type="number" class="form-control"
                                                   required=""
                                                   aria-invalid="false" id="hfaadp_invoice_date"
                                                   value="{{$fund_accounts_document_payables->hfaadp_invoice_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Invoice Amount')}}</label>
                                            <input name="hfaadp_invoice_amount" type="number" class="form-control"
                                                   required=""
                                                   aria-invalid="false" id="hfaadp_invoice_amount"
                                                   value="{{$fund_accounts_document_payables->hfaadp_invoice_amount}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Attache File')}}</label>
                                            <input type="file" name="hfaadp_attache_file" class="form-control"
                                                   required=""
                                                   aria-invalid="false">
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
                                id: $("#hfaadp_invoice_number").data('id'),
                                hfaadp_invoice_number: $("#hfaadp_invoice_number").val(),
                                hfaadp_invoice_description: $("#hfaadp_invoice_description").val(),
                                hfaadp_invoice_date: $("#hfaadp_invoice_date").val(),
                                hfaadp_invoice_amount: $("#hfaadp_invoice_amount").val(),
                                hfaadp_attache_file: $("#hfaadp_attache_file").val(),
                            }
                        event.preventDefault();
                        $.blockUI();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '/fund_accounts_document_payable/' + data.id,
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