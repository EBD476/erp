@extends('layouts.app')

@section('title', '| Add User')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class='col-lg-6'>

                <h3><i class='fa fa-user-plus'></i> Add User</h3>
                <hr>

                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    @method('POST')
                    {{--        {{ Form::open(array('url' => 'users')) }}--}}

                    <div class="form-group label-floating">
                        {{--<label class="control-label">Name</label>--}}
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    {{--<div class="form-group label-floating">--}}
                    {{--<label class="control-label">Email</label>--}}
                    {{--<input type="text" class="form-control" name="email" placeholder="Email">--}}
                    {{--</div>--}}

                    <div class="form-group label-floating">
                        {{--<label class="control-label">Email</label>--}}
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>

                    <div class="form-group label-floating">
                        {{--<label class="control-label">Email</label>--}}
                        <input type="text" class="form-control" name="device_id" placeholder="Device ID">
                    </div>

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('name', 'Name') }}--}}
                    {{--{{ Form::text('name', '', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('email', 'Email') }}--}}
                    {{--{{ Form::email('email', '', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    <div class='form-group'>
                        @foreach ($roles as $role)
                            <input type="checkbox" name="roles[]" value="{{$role->id}}">
                            <label class="control-label">{{ucfirst($role->name)}}</label>
                            {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                            {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}

                        @endforeach
                    </div>

                    <div class="form-group label-floating">
                        {{--<label class="control-label">Password</label>--}}
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="form-group label-floating">
                        {{--<label class="control-label">Confirm Password</label>--}}
                        <input type="password" class="form-control" name="password_confirmation"
                               placeholder="Confirm Password">
                    </div>

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('password', 'Password') }}<br>--}}
                    {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}

                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('password', 'Confirm Password') }}<br>--}}
                    {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}

                    {{--</div>--}}

                    <input type="submit" class="btn btn-block btn-primary" value="Add">
                    {{--        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                    {{--        {{ Form::close() }}--}}
                </form>
            </div>
        </div>
    </div>

@endsection