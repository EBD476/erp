@extends('layouts.app')

@section('title',__('Verifier'))

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
                            <h4 class="card-title ">{{__('Add New Verifier')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('verifier.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Process Id')}}</label>
                                            <input type="text" class="form-control" name="process_id">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <input type="text" class="form-control" name="hp_priority">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Verify ID')}}</label>
                                            <select class="form-control" name="hp_verifier_id">
                                                @foreach($verifier_id as $verify)
                                                    <option value={{$verify->id}}>{{$verify->name}}</option>
                                                @endforeach
                                            </select>
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