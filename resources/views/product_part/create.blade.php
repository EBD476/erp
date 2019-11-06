@extends('layouts.app')

@section('title',__('Products'))


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
                            <h4 class="card-title ">{{__('New Product Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Part Name')}}</label>
                                            <select id="part_id" class="form-control" name="hpp_part_id">
                                                @foreach($part_id as $parts_id)
                                                    <option value={{$parts_id->id}}>
                                                        {{$parts_id->hp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Model')}}</label>
                                            <select class="form-control" name="hp_part_model">
                                            @foreach($part_id as $parts_id)
                                                <option>
                                                    {{$parts_id->hp_part_model}}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Product Name')}}</label>
                                            <select class="form-control" name="hpp_product_id">
                                                @foreach($product_id as $products_id)
                                                    <option value={{$products_id->id}}>
                                                        {{$products_id->hp_product_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Count')}}</label>
                                            <input name="hpp_part_count" type="text" class="form-control" required=""
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
                            <p class="description">
                                Product
                            </p>
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
                    url: '/product_part',
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
@endpush