@extends('layouts.app')

@section('title', __('Add Role'))

@section('content')
    @role('Admin')
    <div class="wrap main-content" data-scrollbar>
        <div class="content persian">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="col-lg-12 ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">{{__('Add Role')}}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('roles.store') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label>{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                    @foreach ($permissions as $permission)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="col-md-8">
                                                        <label>{{ucfirst($permission->name)}}</label>
                                                        <input type="checkbox" name="permissions[]"
                                                               value="{{$permission->id}}"> </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-block btn-primary"
                                                   value="{{__('Send')}}">
                                        </div>

                                    </div>
                                </form>

                            </div>
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
                                </div>
                                </p>
                                <div class="card-description">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
@endsection