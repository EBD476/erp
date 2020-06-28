@extends('layouts.app')

@section('title', '| Create Permission')

@section('content')
    @role('Admin')
    <div class="wrap main-content persian" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <h3><i class='fa fa-key pull-right'>{{__('Add Permission')}}</i></h3>
                        <br>
                        <form action="{{ route('permissions.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group label-floating">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$roles->isEmpty())
                                    <div class="col-md-4">
                                        <h4><i class='fa fa-user-plus pull-right'>{{__('Role')}}</i></h4>
                                        <br>
                                        <div class="card card-user">
                                            <div class="card-body">
                                                <p class="card-text">
                                                <div class="form-group">
                                                    @foreach ($roles as $role)
                                                        <div class="row">
                                                            <div class="author">
                                                                {{--<div class="block block-one"></div>--}}
                                                                {{--<div class="block block-two"></div>--}}
                                                                {{--<div class="block block-three"></div>--}}
                                                                <div class="block block-four"></div>
                                                                <div class="col-md-12">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>{{ucfirst($role->name)}}</label>
                                                                            <input type="checkbox" name="roles[]"
                                                                                   value="{{$role->id}}">
                                                                            {{--{{ Form::checkbox('roles[]',  $role->id ) }}--}}
                                                                            {{--{{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
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
                                @endif
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