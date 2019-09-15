@extends('layouts.app')

@section('title',__('Request'))

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Request')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('request.update',$Request->id)}}" ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product')}}</label>
                                        <input type="text" class="form-control" name="goods" value="{{$Request->goods}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Count')}}</label>
                                        <input type="text" class="form-control" name="goods_count" value="{{$Request->goods_count}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Description')}}</label>
                                        <input type="text" class="form-control" name="description" value="{{$Request->description}}">
                                    </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('User ID')}}</label>
                                        <input type="text" class="form-control" name="user_id" value="{{$Request->user_id}}">
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="bmd-label-floating">{{__('Request Date')}}</label>--}}
                                        {{--<input type="text" class="form-control" name="request_date" value="{{$Request->request_date}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Accept Level')}}</label>
                                        <input type="text" class="form-control" name="accept_level" value="{{$Request->accept_level}}">
                                    </div>

                                </div>
                            </div>

                            <a href="{{route('request.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
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
                                Project Implementors
                            </p>
                        </div>
                        </p>
                        <div class="card-description">

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                                <i class="fab fa-google-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>

@endsection

@push('scripts')

@endpush