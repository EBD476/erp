@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class='col-lg-8'>
                        <h3><i class='fa fa-user-plus pull-right'> {{__('Edit')}} {{$user->name}}</i></h3>
                        <hr>
                        <form action="{{ route('users.update',[$user->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Username')}}</label>
                                        <input type="text" class="form-control" name="username"
                                               value="{{$user->username}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Device ID')}}</label>
                                        <input type="number" class="form-control" name="device_id"
                                               value="{{$user->device_id}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Password')}}</label>
                                        <input type="password" class="form-control" name="password"
                                               value="{{$user->password}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class='form-group'>
                                @foreach ($roles as $role)
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="col-md-3">
                                                <label>{{ucfirst($role->name)}}</label>
                                                <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                                {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                                                {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <input type="submit" class="btn btn-block btn-primary col-md-2" value="{{__('Send')}}">
                            </div>
                        </form>
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

@endsection