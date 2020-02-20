@extends('layouts.app')

@section('title',__('Parts'))


@section('content')
    {{--    @can('browse-menu-user')--}}
    <div class="content persian">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.Msg')
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{__('Edit Part')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form id="form1" action="{{route('part.update',$part->id)}}">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Name')}}</label>
                                            <input name="hp_name" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Code')}}</label>
                                            <input name="hp_code" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_code}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Part Model')}}</label>
                                            <input name="hp_part_model" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_part_model}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Provider')}}</label>
                                            <input name="hp_provider" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_provider}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Category Id')}}</label>
                                            <input name="hp_category_id" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_category_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                        <div class="form-group">
                                            <label>{{__('Produce Date')}}</label>
                                            <input name="hp_produce_date" type="text" class="form-control" required=""
                                                   aria-invalid="false" value="{{$part->hp_produce_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">{{__('Save')}}</button>
                                </div>
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
                                    Product
                                </p>
                            </div>
                            </p>
                            <div class="card-description">

                            </div>
                        </div>
                        <div class="card-footer">
                            {{--<div class="button-container">--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">--}}
                            {{--<i class="fab fa-facebook"></i>--}}
                            {{--</button>--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">--}}
                            {{--<i class="fab fa-twitter"></i>--}}
                            {{--</button>--}}
                            {{--<button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">--}}
                            {{--<i class="fab fa-google-plus"></i>--}}
                            {{--</button>--}}
                            {{--</div>--}}
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
                                Product
                            </p>
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
    {{--@endcan--}}
@endsection

@push('scripts')

@endpush