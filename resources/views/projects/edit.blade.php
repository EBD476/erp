@extends('layouts.app')

@section('title',__('Project'))

@push('css')

@endpush

@section('content')
    @can('browse-menu-user')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Project')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('project.update',$Projects_State->id)}}" ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Name')}}</label>
                                        <input type="text" class="form-control" name="Name" value="{{$Projects_State->Name}}">
                                    </div>

                                </div>
                            </div>

                            <a href="{{route('project.index')}}" class="btn badge-danger">{{__('Back')}}</a>

                            <button type="submit" class="btn badge-primary">{{__('Send')}}</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @endcan
@endsection

@push('scripts')

@endpush