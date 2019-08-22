@extends('layouts.app')

@section('title', '| Add Role')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class='col-lg-4 col-lg-offset-4'>

                <h3><i class='fa fa-key'></i> Add Role</h3>
                <hr>
                {{-- @include ('errors.list') --}}

                {{--    {{ Form::open(array('url' => 'roles')) }}--}}

                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group label-floating">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('name', 'Name') }}--}}
                    {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    <h5><b>Assign Permissions</b></h5>

                    <div class='form-group'>
                        @foreach ($permissions as $permission)

                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label class="control-label">{{ucfirst($permission->name)}}</label>

                            {{--{{ Form::checkbox('permissions[]',  $permission->id ) }}--}}
                            {{--{{ Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}

                        @endforeach
                    </div>

                    <input type="submit" class="btn btn-block btn-primary" value="Add">
                </form>
                {{--    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                {{--    {{ Form::close() }}--}}

            </div>
        </div>
    </div>
@endsection