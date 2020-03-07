@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-8">
                        <div class='col-lg-6'>
                            <h3><i class='fa fa-key pull-right'>{{__('Edit Role:')}}{{$role->name}}</i></h3>
                            <hr>
                            {{-- @include ('errors.list')
                         --}}
                            {{--    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}--}}

                            <form action="{{ route('roles.update',[$role->id]) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group label-floating">
                                    <label class="control-label">{{__('Role Name')}}</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{$role->name}}">
                                </div>

                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('name', 'Role Name') }}--}}
                                {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
                                {{--</div>--}}

                                {{--<h5><b>Assign Permissions</b></h5>--}}
                                @foreach ($permissions as $permission)

                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                    <label class="control-label">{{ucfirst($permission->name)}}</label>

                                    {{--{{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}--}}
                                    {{--{{Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}

                                @endforeach
                                <br>
                                <input type="submit" class="btn btn-block btn-primary" value="{{__('Send')}}">
                                {{--    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}--}}

                                {{--    {{ Form::close() }}   --}}
                            </form>
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
        </div></div>
    @endrole
@endsection