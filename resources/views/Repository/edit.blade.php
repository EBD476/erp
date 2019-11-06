@extends('layouts.app')

@section('title',__('Repository'))

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
                        <h4 class="card-title ">{{__('Edit New Repository')}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('repository.update',$Repositories->id)}}"
                              ENCTYPE="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Id')}}</label>
                                        <input type="text" class="form-control" name="hr_product_id"
                                               value="{{$Repositories->hr_product_id}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Product Stock')}}</label>
                                        <input type="text" class="form-control" name="hr_product_stock"
                                               value="{{$Repositories-> hr_product_stock}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Comment')}}</label>
                                        <input type="text" class="form-control" name="hr_comment"
                                               value="{{$Repositories-> hr_comment}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Entry Date')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_entry_date" value="{{$Repositories-> hr_entry_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Exit')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_exit" value="{{$Repositories-> hr_exit}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Contradiction')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_contradiction" value="{{$Repositories-> hr_contradiction}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Provider Code')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_provider_code" value="{{$Repositories-> hr_provider_code}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Return Value')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_return_value" value="{{$Repositories-> hr_return_value}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">{{__('Status Return Part')}}</label>
                                        <input class="form-control" required=""
                                                  aria-invalid="false" name="hr_status_return_part" value="{{$Repositories-> hr_status_return_part}}">
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