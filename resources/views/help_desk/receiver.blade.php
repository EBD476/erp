@extends('layouts.app')

@section('title',__('Receiver Page'))

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
                            <h4 class="card-title ">{{__('show Message')}}</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Title')}}</label>
                                            <input required="" type="text" name="hhd_title" class="form-control"
                                                   value="{{$help_desks->hhd_title}}" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Type')}} </label>
                                            @foreach($type as $types)
                                                @if($types->id == $help_desks->hhd_type)
                                                    <input class="form-control" name="hhd_ticket_status"
                                                           value="{{$types->th_name}}"
                                                           disabled>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Ticket Status')}}</label>
                                            @foreach($ticket as $tickets)
                                                @if($tickets->id == $help_desks->hhd_ticket_status)
                                                    <input class="form-control" name="hhd_ticket_status"
                                                           value="{{$tickets->ts_name}}"
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
                                                @if($users->id == $help_desks->hhd_receiver_user_id)
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
                                            @foreach($priority as $priorities_1)
                                                @if($priorities_1->id == $help_desks->hhd_priority)
                                                    <input class="form-control" value="{{$priorities_1->hdp_name}}"
                                                           disabled>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Description')}}</label>
                                            <textarea type="text" required=""
                                                      aria-invalid="false" class="form-control"
                                                      name="hhd_problem"
                                                      disabled>{{$help_desks->hhd_problem}}</textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">{{__('Verify Ticket')}}</label>
                                            <div class="form-check ">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           data-id="{{$help_desks->id}}"
                                                           id="checkbox"
                                                    >
                                                    <span class="form-check-sign">
                                                                <span class="check"></span>
                                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            <script src="{{asset('assets/js/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $('#checkbox').on('change', function (event) {
                        if (event.target.checked) {
                            var data = {
                                id: $("#checkbox").data('id'),
                                state: $(this)[0].checked == true ? 3 : 2,
                            };
                            $.blockUI({
                                message: '{{__('please wait...')}}', css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .5,
                                    color: '#fff'
                                }
                            });
                            //token
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: '/receive_verify/' + data.id,
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                async: false,
                                success: function (data) {
                                    setTimeout($.unblockUI, 2000);
                                },
                                cache: false,
                            });
                        }
                    });
                });
            </script>
    @endpush