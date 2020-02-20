@extends('layouts.app')

@section('title',__('Repository'))

@push('css')

@endpush

@section('content')
    {{--    @can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{__('Edit Part')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('repository-part.update',$repository->id)}}"
                              ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Part Id')}}</label>
                                        <input type="text" class="form-control" name="hrp_part_id" value="{{$repository->hrp_part_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Repository Name')}}</label>
                                        <input type="text" class="form-control" required=""
                                               aria-invalid="false" name="hrp_repository_id" value="{{$repository->hrp_part_id}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Count')}}</label>
                                        <textarea class="form-control" required=""
                                                  aria-invalid="false" name="hrp_part_count" >{{$repository->hrp_part_count}}</textarea>
                                    </div>
                                </div>
                            </div>
                                <a href="{{route('repository.index')}}" class="btn badge-danger">{{__('Back')}}</a>

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