@extends('layouts.app')

@section('title', '| Add User')

@section('content')
    @role('Admin')
    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class='col-lg-8'>

                        <h3><i class='fa fa-user-plus pull-right'>{{__('Add User')}}</i></h3>
                        <hr>

                        <form action="{{ route('users.store') }}" method="post">
                            @csrf
                            @method('POST')
                            {{--        {{ Form::open(array('url' => 'users')) }}--}}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Username')}}</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Device ID')}}</label>
                                        <input type="number" class="form-control" name="device_id">
                                    </div>
                                </div>

                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('name', 'Name') }}--}}
                                {{--{{ Form::text('name', '', array('class' => 'form-control')) }}--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('email', 'Email') }}--}}
                                {{--{{ Form::email('email', '', array('class' => 'form-control')) }}--}}
                                {{--</div>--}}
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Password')}}</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group   ">
                                        <label>{{__('Confirm Password')}}</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('password', 'Password') }}<br>--}}
                                {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
                                {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

                                {{--</div>--}}
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

                            {{--        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                            {{--        {{ Form::close() }}--}}
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
        @endrole
        @role('super admin')
        <div class="wrap main-content" data-scrollbar>
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <div class='col-lg-8'>

                            <h3><i class='fa fa-user-plus pull-right'>{{__('Add User')}}</i></h3>
                            <hr>

                            <form action="{{ route('users.store') }}" method="post">
                                @csrf
                                @method('POST')
                                {{--        {{ Form::open(array('url' => 'users')) }}--}}

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('Name')}}</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('Username')}}</label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('Email')}}</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{__('Device ID')}}</label>
                                            <input type="number" class="form-control" name="device_id">
                                        </div>
                                    </div>

                                    {{--<div class="form-group">--}}
                                    {{--{{ Form::label('name', 'Name') }}--}}
                                    {{--{{ Form::text('name', '', array('class' => 'form-control')) }}--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    {{--{{ Form::label('email', 'Email') }}--}}
                                    {{--{{ Form::email('email', '', array('class' => 'form-control')) }}--}}
                                    {{--</div>--}}
                                    <div class="col-md-4">
                                        <div class="form-group   ">
                                            <label>{{__('Password')}}</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group   ">
                                            <label>{{__('Confirm Password')}}</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>
                                    {{--<div class="form-group">--}}
                                    {{--{{ Form::label('password', 'Password') }}<br>--}}
                                    {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
                                    {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

                                    {{--</div>--}}
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
                                    <input type="submit" class="btn btn-block btn-primary col-md-2"
                                           value="{{__('Send')}}">
                                </div>

                                {{--        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                                {{--        {{ Form::close() }}--}}
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
            @endrole
@endsection