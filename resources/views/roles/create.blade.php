@extends('layouts.app')

@section('title', '| Add Role')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-8">
                        <div class='col-lg-6'>

                            <h3><i class='fa fa-key pull-right'>{{__('Add Role')}}</i> </h3>
                            <hr>
                            {{-- @include ('errors.list') --}}

                            {{--    {{ Form::open(array('url' => 'roles')) }}--}}

                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                @method('POST')

                                <div class="form-group label-floating">
                                    <label>{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('name', 'Name') }}--}}
                                {{--{{ Form::text('name', null, array('class' => 'form-control')) }}--}}
                                {{--</div>--}}

                              {{--<div class="row col-md-8">--}}
                                  {{--<h5 class="pull-right"><b>{{__('Assign Permissions')}}</b></h5>--}}
                              {{--</div>--}}

                                <div class='form-group'>
                                    @foreach ($permissions as $permission)

                                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                        <label class="control-label">{{ucfirst($permission->name)}}</label>

                                        {{--{{ Form::checkbox('permissions[]',  $permission->id ) }}--}}
                                        {{--{{ Form::label($permission->name, ucfirst($permission->name)) }}<br>--}}

                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-block btn-primary" value="{{__('Send')}}">

                                    </div>
                                </div>
                            </form>
                            {{--    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}--}}

                            {{--    {{ Form::close() }}--}}

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
@endsection