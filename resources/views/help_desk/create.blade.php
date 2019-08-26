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
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Add New Help Desk')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('help_desk.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Type')}}</label>
                                            <input type="text" class="form-control" name="hhd_type">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Problem')}}</label>
                                            <input type="text" class="form-control" name="hhd_problem">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <input type="text" class="form-control" name="hhd_priority" id="1">
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
            </div>
        </div>
    {{--@endcan--}}
@endsection

@push('scripts')

@endpush