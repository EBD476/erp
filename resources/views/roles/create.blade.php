@extends('layouts.app')

@section('title', '| Add Role')

@section('content')
    @role('Admin')
    <div class="wrap main-content" data-scrollbar>
        <div class="content persian">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class='fa fa-key pull-right'>{{__('Add Role')}}</i></h3>
                        <hr>
                        {{-- @include ('errors.list') --}}

                        {{--    {{ Form::open(array('url' => 'roles')) }}--}}

                        <form action="{{ route('roles.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4><i class='fa fa-user-plus pull-right'>{{__('Permissions')}}</i></h4>
                                    <br>
                                    <div class="card card-user">
                                        <div class="card-body">
                                            <p class="card-text">
                                            <div class="form-group">
                                                @foreach ($permissions as $permission)
                                                    <div class="row">
                                                    <div class="author">
                                                            {{--<div class="block block-one"></div>--}}
                                                            {{--<div class="block block-two"></div>--}}
                                                            {{--<div class="block block-three"></div>--}}
                                                            <div class="block block-four"></div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>{{ucfirst($permission->name)}}</label>
                                                                        <input type="checkbox" name="permissions[]"
                                                                               value="{{$permission->id}}">
                                                                        {{--{{ Form::checkbox('permissions[]',  $permission->id ) }}--}}
                                                                        {{--{{ Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-block btn-primary"
                                               value="{{__('Send')}}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endrole
@endsection