@extends('layouts.app')

@section('title',__('Edit Verifier'))

@push('css')

@endpush

@section('content')
{{--    @can('browse-menu-user')--}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.partial.Msg')
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Verifier')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('verifier.update',$verifier->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Process Id')}}</label>
                                            <input type="text" class="form-control" name="process_id" value="{{$verifier->process_id}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <input type="text" class="form-control" name="hp_priority" value="{{$verifier->hp_priority}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Verify ID')}}</label>
                                            <input type="text" class="form-control" name="hp_verifier_id" value="{{$verifier->hp_verifier_id}}">
                                        </div>

                                    </div>
                                </div>
                                <a href="{{route('verifier.index')}}" class="btn badge-danger">{{__('Back')}}</a>

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