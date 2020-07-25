@extends('layouts.app')

@section('title', __('Edit Permission'))

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class="col-md-8">
                <div class="card">
                    <div class="col-lg-12 ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit')}} {{$permission->name}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class='col-md-6'>
                            {{-- @include ('errors.list') --}}
                            <br>
                            <form action="{{ route('permissions.update',[$permission->id]) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>{{__('Permission Name')}}</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{$permission->name}}">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-block btn-primary" value="{{__('Send')}}">
                            </form>
                        </div>
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
                    <div class="card-description">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection