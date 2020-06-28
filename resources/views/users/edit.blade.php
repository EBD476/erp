@extends('layouts.app')

@section('title', '| Edit User')

@section('content')
    @role('Admin')
    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class='col-lg-12'>
                <div class="card">
                    <div class="card-body">
                        <h3><i class='fa fa-user-plus pull-right'> {{__('Edit')}} {{$users->name}}</i></h3>
                        <hr>
                        <form action="{{ route('users.update',[$users->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{$users->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Username')}}</label>
                                                <input type="text" class="form-control" name="username"
                                                       value="{{$users->username}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('Current Password')}}</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>{{__('New Password')}}</label>
                                                <input type="password" class="form-control" name="newPassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4><i class='fa fa-user-plus pull-right'>{{__('Role')}} {{$users->name}}</i></h4>
                                    <br>
                                    <div class="card card-user">
                                        <div class="card-body">
                                            <p class="card-text">
                                            <div class="form-group">
                                                @foreach ($roles as $role)
                                                    <div class="row">
                                                        <div class="author">
                                                            {{--<div class="block block-one"></div>--}}
                                                            {{--<div class="block block-two"></div>--}}
                                                            {{--<div class="block block-three"></div>--}}
                                                            <div class="block block-four"></div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>{{ucfirst($role->name)}}</label>
                                                                        <input type="checkbox" name="roles[]"
                                                                               value="{{$role->id}}">
                                                                        {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                                                                        {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-block btn-primary"
                                           value="{{__('Send')}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    @role('finance|dealership|repository|product|geust|order|task')
    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class='col-lg-8'>
                <div class="card">
                    <div class="card-body">
                        <h3><i class='fa fa-user-plus pull-right'> {{__('Edit')}} {{$users->name}}</i></h3>
                        <hr>
                        <form action="{{ route('users.update',[$users->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="name" value="{{$users->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Username')}}</label>
                                        <input type="text" class="form-control" name="username"
                                               value="{{$users->username}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Current Password')}}</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('New Password')}}</label>
                                        <input type="password" class="form-control" name="newPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" class="btn btn-block btn-primary col-md-2" value="{{__('Send')}}">
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
                        <div class="card-description">

                        </div>
                    </div>
                    {{--<div class="card-footer">--}}
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
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection