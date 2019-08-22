@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

    <div class='col-lg-6 '> <!--col-lg-offset-1-->

        <h3><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h3>
        <hr>

        <form action="{{ route('users.update',[$user->id]) }}" method="post">
            @csrf
            @method('PUT')
            {{--        {{ Form::open(array('url' => 'users')) }}--}}

            <div class="form-group label-floating">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}">
            </div>

            {{--<div class="form-group label-floating">--}}
                {{--<label class="control-label">Email</label>--}}
                {{--<input type="text" class="form-control" name="email" placeholder="Email">--}}
            {{--</div>--}}

            <div class="form-group label-floating">
                <label class="control-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{$user->username}}">
            </div>

            {{--<div class="form-group label-floating">--}}
                {{--<label class="control-label">Email</label>--}}
                {{--<input type="text" class="form-control" name="email" placeholder="Email">--}}
            {{--</div>--}}

            <div class="form-group label-floating">
                <label class="control-label">Device ID</label>
                <input type="text" class="form-control" name="device_id" placeholder="Device ID" value="{{$user->device_id}}">
            </div>

        {{--<div class="form-group">--}}
            {{--{{ Form::label('name', 'Name') }}--}}
            {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('email', 'Email') }}--}}
            {{--{{ Form::email('email', null, array('class' => 'form-control')) }}--}}
        {{--</div>--}}

        <h5><b>Give Role</b></h5>

        <div class='form-group'>
            @foreach ($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->id}}">
                <label class="control-label">{{ucfirst($role->name)}}</label>
                {{--{{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}--}}
                {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}

            @endforeach
        </div>

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Password') }}<br>--}}
            {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
            {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

        {{--</div>--}}

            <div class="form-group label-floating">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="form-group label-floating">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
            </div>

            <input type="submit" class="btn btn-block btn-primary" value="Edit">
        {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

        {{--{{ Form::close() }}--}}

    </div>

        </div>
    </div>

@endsection