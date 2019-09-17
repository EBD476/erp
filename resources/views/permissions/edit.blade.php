@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

    <div class="wrap main-content" data-scrollbar>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-8">
                        <h3><i class='fa fa-key pull-right'> {{__('Edit')}} {{$permission->name}}</i></h3>
                        <div class='col-md-6'>
                            {{-- @include ('errors.list') --}}
                            <br>
                            <form action="{{ route('permissions.update',[$permission->id]) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>{{__('Permission Name')}}</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{$permission->name}}">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-block btn-primary" value="{{__('Send')}}">
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
        </div>
    </div>

@endsection