@extends('layouts.app')

@section('title',__('Bank Account'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

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
                                            <select class="form-control" name="hba_bank_id">
                                                @foreach($bank as $banks)
                                                    <option value="{{$bank->id}}">
                                                        {{$bank->hfb_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Bank Account Number')}}</label>
                                            <select class="form-control" name="hba_account_number">
                                                @foreach($bank as $banks_number)
                                                    <option value="{{$banks_number->hfb_bank_account_number}}">
                                                        {{$banks_number->hfb_bank_account_number}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Balance')}}</label>
                                            <input name="hba_balance" type="text" class="form-control" required=""
                                                   aria-invalid="false" id="hba_balance">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Debt')}}</label>
                                            <input name="hba_debt" type="text" class="form-control" required=""
                                                   aria-invalid="false" id="hba_debt">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Crediting')}}</label>
                                            <input name="hba_crediting" type="text" class="form-control" required=""
                                                   aria-invalid="false" id="hba_crediting">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Deduction Date')}}</label>
                                            <input name="hba_deduction_date" type="text" class="form-control"
                                                   required=""
                                                   aria-invalid="false"  id="test-date-id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Deposit Date')}}</label>
                                            <input name="hba_deposit_date" type="text" class="form-control" required=""
                                                   aria-invalid="false" id="test-date-id-1">
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
            <script src="{{asset('assets/js/kamadatepicker.min.js')}}"></script>
            <script>
                kamaDatepicker('test-date-id', {
                    buttonsColor: "blue",
                    forceFarsiDigits: true,
                    nextButtonIcon: "fa fa-arrow-circle-right",
                    previousButtonIcon: "fa fa-arrow-circle-left"
                });
            </script>
            <script>
                kamaDatepicker('test-date-id-1', {
                    buttonsColor: "blue",
                    forceFarsiDigits: true,
                    nextButtonIcon: "fa fa-arrow-circle-right",
                    previousButtonIcon: "fa fa-arrow-circle-left"
                });
            </script>
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