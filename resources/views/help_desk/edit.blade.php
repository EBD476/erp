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
                            <h4 class="card-title ">{{__('Edit')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('help_desk.update',$help_desks->id)}}"
                                  ENCTYPE="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Title')}}</label>
                                            <input required="" type="text" name="hhd_title" class="form-control"
                                                   value="{{$help_desks->hhd_title}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Type')}}</label>
                                            <select class="form-control" name="hhd_type">
                                                @foreach($type as $types_1)
                                                    <option value="{{$types_1->id}}">
                                                        {{$types->th_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Ticket Status')}}</label>
                                                @foreach($ticket as $tickets)
                                                    @if($tickets->id == $help_desk->hhd_ticket_status)
                                                        <input class="form-control" name="hhd_ticket_status" value="{{$tickets->ts_name}}"
                                                               disabled>
                                                    @endif
                                                @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Receiver')}}</label>
                                                @foreach($user as $users)
                                                    @if($users->id == $help_desk->hhd_receiver_user_id)
                                                        <input class="form-control" value="{{$users->name}}" disabled>
                                                    @endif
                                                @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Priority')}}</label>
                                            <select class="form-control" name="hhd_priority">
                                                @foreach($priority as $priority_1)
                                                    <option value="{{$priority_1->id}}">
                                                        {{$priority_1->hdp_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Description')}}</label>
                                            <textarea type="text" required=""
                                                      aria-invalid="false" class="form-control"
                                                      name="hhd_problem">{{$help_desks->hhd_problem}}</textarea>
                                        </div>

                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="bmd-label-floating">{{__('File Atach')}}</label>--}}
                                {{--<input type="file" class="form-control" name="hhd_file_atach" value="{{$help_desk->hhd_file_atach}}">--}}
                                {{--</div>--}}

                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label class="bmd-label-floating">{{__('Verify')}}</label>--}}
                                {{--<input type="checkbox" class="form-control" name="hhd_verify" value="{{$help_desk->hhd_verify}}">--}}
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
                                Help Desk
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