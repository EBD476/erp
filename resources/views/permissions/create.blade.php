@extends('layouts.app')

@section('title', '| Create Permission')

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-8">
                        <div class='col-lg-6'>

                {{-- @include ('errors.list') --}}

                <h3><i class='fa fa-key pull-right'>{{__('Add Permission')}}</i> </h3>
                <br>

                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group label-floating">
                        <label>{{__('Name')}}</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    {{--                {{ Form::open(array('url' => 'permissions')) }}--}}

                    {{--<div class="form-group">--}}
                    {{--                    {{ Form::label('name', 'Name') }}--}}
                    {{--                    {{ Form::text('name', '', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}

                    @if(!$roles->isEmpty())

{{--                        <h4 class="pull-right">{{__('Assign Permission to Roles')}}</h4>--}}

                        @foreach ($roles as $role)
                            <div class="row">
                            <div class="col-md-4">
                            <input type="checkbox" name="roles[]" value="{{$role->id}}">
                            <label class="control-label">{{ucfirst($role->name)}}</label>
                            {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                            {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                            </div>
                            </div>
                        @endforeach
                    @endif
                    <br><br>
                    <input type="submit" class="btn btn-block btn-primary" value="{{__('Send')}}">
                </form>
                {{--{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                {{--{{ Form::close() }}--}}

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
        </div>
    </div>
    @endrole
@endsection