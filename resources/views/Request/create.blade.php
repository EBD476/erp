@extends('layouts.app')

@section('title',__('Request'))

@push('css')
    <link href="{{asset('backend/css/style/kamadatepicker.min.css')}}" rel="stylesheet" />
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
                            <h4 class="card-title ">{{__('Add New Request')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('request.store')}}" ENCTYPE="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product')}}</label>
                                            <input type="text" class="form-control" name="goods">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Product Count')}}</label>
                                            <input type="text" class="form-control" name="goods_count">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('User ID')}}</label>
                                            <select class="form-control" name="user_id">
                                                @foreach($user as $user)
                                                    <option value="{{$user->id}}">
                                                        <label class="bmd-label-floating">{{__('User ID')}}</label>
                                                        {{$user->id}}
                                                        {{$user->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" >{{__('Request Date')}}</label>
                                            <input type="text" id="test-date-id" class="form-control" name="request_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Accept Level')}}</label>
                                            <input type="text" class="form-control" name="accept_level">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Description')}}</label>
                                            <textarea type="text" class="form-control" name="description"></textarea>
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

@endsection

@push('scripts')
    <script src="{{asset('backend/js/src/kamadatepicker.min.js')}}"></script>
    <script>
        kamaDatepicker('test-date-id', { buttonsColor: "blue",
            forceFarsiDigits: true,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left"});
    </script>
@endpush