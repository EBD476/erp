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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Request Date')}}</label>
                                        <input type="text" class="form-control" name="request_date" value="{{$Request->request_date}}">
                                    </div>
                                </div>
                            </div>

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