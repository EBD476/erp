@extends('layouts.app')

@section('title',__('Help Desk'))

@push('css')

@endpush

@section('content')
    {{--@can('browse-menu-user')--}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.partial.Msg')
                    </div>
                    <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Help Desk')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('help_desk.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Type')}}</label>
                                            <input type="text" class="form-control" required=""
                                                   aria-invalid="false" name="hhd_type">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Problem')}}</label>
                                            <input type="text" required=""
                                                   aria-invalid="false" class="form-control" name="hhd_problem">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <input type="number" required=""
                                                   aria-invalid="false" class="form-control" name="hhd_priority" id="1">
                                        </div>

                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label class="bmd-label-floating">{{__('File Atach')}}</label>--}}
                                            {{--<input type="file" class="form-control" name="hhd_file_atach">--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label class="bmd-label-floating">{{__('Verify')}}</label>--}}
                                            {{--<input type="checkbox" class="form-control" name="hhd_verify">--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                <a href="{{route('help_desk.index')}}" class="btn badge-danger">{{__('Back')}}</a>
                                <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
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
    {{--@endcan--}}
@endsection

@push('scripts')

@endpush