@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class='col-lg-4 col-lg-offset-4'>
                <h3><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h3>
                <hr>
                {{-- @include ('errors.list')
             --}}
                {{--    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}--}}

                <form action="{{ route('roles.update',[$role->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group label-floating">
                        <label class="control-label">{{__('Role Name')}}</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{$role->name}}">
                    </div>

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('name', 'Role Name') }}--}}
                    {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    <h5><b>Assign Permissions</b></h5>
                    @foreach ($permissions as $permission)

                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                        <label class="control-label">{{ucfirst($permission->name)}}</label>

                        {{--{{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}--}}
                        {{--{{Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}

                    @endforeach
                    <br>
                    <input type="submit" class="btn btn-block btn-primary" value="Edit">
                    {{--    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}--}}

                    {{--    {{ Form::close() }}   --}}
                </form>
            </div>
        </div>
    </div>

@endsection