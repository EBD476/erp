@extends('layouts.app')

@section('title', '| Create Permission')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">

            <div class='col-lg-4 col-lg-offset-4'>

                {{-- @include ('errors.list') --}}

                <h3><i class='fa fa-key'></i> Add Permission</h3>
                <br>

                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group label-floating">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    {{--                {{ Form::open(array('url' => 'permissions')) }}--}}

                    {{--<div class="form-group">--}}
                    {{--                    {{ Form::label('name', 'Name') }}--}}
                    {{--                    {{ Form::text('name', '', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    @if(!$roles->isEmpty())

                        <h4>Assign Permission to Roles</h4>

                        @foreach ($roles as $role)
                            <input type="checkbox" name="roles[]" value="{{$role->id}}">
                            <label class="control-label">{{ucfirst($role->name)}}</label>
                            {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                            {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                        @endforeach
                    @endif
                    <br><br>
                    <input type="submit" class="btn btn-block btn-primary" value="Add">
                </form>
                {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                {{--{{ Form::close() }}--}}

            </div>
        </div>
    </div>

@endsection