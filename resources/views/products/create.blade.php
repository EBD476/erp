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
                            <div class="card-header">
                                <h5 class="title">{{__('New Product')}}</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route('products.store')}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Product Name')}}</label>
                                                <input name="product_name" type="text" class="form-control"  placeholder="{{__('Product Name')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Product Model')}}</label>
                                                <input name="product_model" type="text" class="form-control"  placeholder="{{__('Product Model')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                            <div class="form-group">
                                                <label>{{__('Product Price')}}</label>
                                                <input name="product_price" type="text" class="form-control"  placeholder="{{__('Product Price')}}" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary">{{__('Save')}}</button>
                            </div>
                            </form>
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

@endpush