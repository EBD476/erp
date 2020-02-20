@extends('layouts.app')

@section('title',__('Repository'))

@push('css')
    <link href="{{asset('assets/css/kamadatepicker.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Add New Repository')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form id="form1" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Name')}}</label>
                                        <select class="form-control" name="hr_product_id">
                                            @foreach($product as $products)
                                                <option value=" {{$products->id}}">
                                                    {{$products->hp_product_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Stock')}}</label>
                                        <input type="text" class="form-control" required=""
                                               aria-invalid="false" name="hr_product_stock">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hr_entry_date" id="test-date-id"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Exit Date')}}</label>
                                        <input class="form-control"
                                               aria-invalid="false" name="hr_exit" id="test-date-id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Contradiction')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hr_contradiction">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Comment')}}</label>
                                        <textarea class="form-control" required=""
                                                  aria-invalid="false" name="hr_comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Return Value')}}</label>
                                        <input class="form-control" required=""
                                               aria-invalid="false" name="hr_return_value">
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
                            <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
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