<div id="card-body">
@extends('layouts.app')

@section('title',__('Conversation View'))

@push('css')
    <!-- Chat CSS -->
        <link href="https://mdbootstrap.com/css/addons-pro/chat.css" rel="stylesheet">
        <!-- Chat CSS - minified-->
        <link href="https://mdbootstrap.com/css/addons-pro/chat.min.css" rel="stylesheet">
    @endpush

    @section('content')
        @role('Admin|finance|dealership|repository|product|order|task')
        <div class="content persian">
            <div class="container-fluid">
                <div class="row">
                    {{--@endcan--}}
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">{{__('Conversation View')}}</h4>
                                        <p class="card-category"></p>
                                    </div>
                                    <div class="card purple lighten-4 chat-room">
                                        <div class="card-body">

                                            <!-- Grid row -->
                                            <div class="row px-2">

                                                <!-- Grid column -->
                                                <div class="col-md-6 col-xl-8 pr-md-4 px-lg-auto px-0">

                                                    <div class="chat-message">
                                                        <ul class="list-unstyled chat">
                                                            {{--show receive message--}}
                                                            @foreach($message_send as $messages_receive)
                                                                @if($messages_receive->hcv_receiver_user_id == auth()->user()->id)
                                                                    <li class="d-flex justify-content-between mb-4"
                                                                        style="direction: ltr">
                                                                        <div class="chat-body white p-3 ml-2 z-depth-1">
                                                                            <div class="header">
                                                                                @foreach($user_name as $requester_name)
                                                                                    @if($requester_name->id == $messages_receive->hcv_request_user_id)
                                                                                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg"
                                                                                             alt="avatar"
                                                                                             class="avatar rounded-circle mr-2 ml-0 z-depth-1">
                                                                                        <strong class="primary-font"
                                                                                                id="">{{$requester_name->name}}</strong>

                                                                                    @endif
                                                                                @endforeach
                                                                                <small class="pull-right text-muted"><i
                                                                                            class="far fa-clock"></i> {{$messages_receive->created_at->format('H:i')}}
                                                                                </small>
                                                                            </div>
                                                                            <hr class="w-100">
                                                                            <p class="mb-0">
                                                                                {{$messages_receive->hcv_message}}
                                                                            </p>
                                                                        </div>
                                                                    </li>
                                                                    <input hidden id="user_receive_id"
                                                                           data-user_receive_id="{{$messages_receive->hcv_request_user_id}}">
                                                                @endif
                                                            @endforeach
                                                            {{--end receive message--}}

                                                            {{--show send message--}}
                                                            @foreach($message_send as $message_request_send)
                                                                @if($message_request_send->hcv_request_user_id == auth()->user()->id )
                                                                    <li class="d-flex justify-content-between mb-4"
                                                                        style="direction: rtl">
                                                                        <div class="chat-body white p-3 z-depth-1">
                                                                            <div class="header">
                                                                                <strong class="primary-font">
                                                                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg"
                                                                                         alt="avatar"
                                                                                         class="avatar rounded-circle mr-0 ml-3 z-depth-1">
                                                                                    {{auth()->user()->name}}
                                                                                </strong>
                                                                                <small class="pull-right text-muted"><i
                                                                                            class="far fa-clock"></i> {{$message_request_send->created_at->format('H:i')}}
                                                                                </small>
                                                                            </div>
                                                                            <hr class="w-100">
                                                                            <p class="mb-0">
                                                                                {{$message_request_send->hcv_message}}
                                                                            </p>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            <form id="message-form">
                                                                <li class="white">
                                                                    <div class="form-group basic-textarea">
                                                                <textarea class="form-control pl-2 my-0"
                                                                          id="exampleFormControlTextarea2" rows="3"
                                                                          placeholder="{{__('Type your message here...')}}"></textarea>
                                                                    </div>
                                                                </li>
                                                                <button type="submit"
                                                                        class="btn btn-deep-purple btn-rounded btn-sm waves-effect waves-light float-right">
                                                                    {{__('Send')}}
                                                                </button>
                                                            </form>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <!-- Grid column -->

                                                <!-- Grid column -->
                                                <div class="col-md-6 col-xl-4 px-0">
                                                    <h6 class="font-weight-bold mb-3 text-center text-lg-right">{{__('Member')}}</h6>
                                                    <div class="white z-depth-1 px-3 pt-3 pb-0">
                                                        <ul class="list-unstyled friend-list">
                                                            {{--<li class="active grey lighten-3 p-2">--}}
                                                            {{--<a href="#" class="d-flex justify-content-between">--}}
                                                            {{--<img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg"--}}
                                                            {{--alt="avatar"--}}
                                                            {{--class="avatar rounded-circle d-flex align-self-center mr-2 z-depth-1">--}}
                                                            {{--<div class="text-small">--}}
                                                            {{--<strong>John Doe</strong>--}}
                                                            {{--<p class="last-message text-muted">Hello, Are you--}}
                                                            {{--there?</p>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="chat-footer">--}}
                                                            {{--<p class="text-smaller text-muted mb-0">Just now</p>--}}
                                                            {{--<span class="badge badge-danger float-right">1</span>--}}
                                                            {{--</div>--}}
                                                            {{--</a>--}}
                                                            {{--</li>--}}
                                                            @foreach($user_name as $users_name)
                                                                @if($users_name->id != auth()->user()->id)
                                                                    <li class="p-2">
                                                                        <a href="{{route('conversation_view.edit',$users_name->id)}}"
                                                                           class="d-flex justify-content-between member">
                                                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-1.jpg"
                                                                                 alt="avatar"
                                                                                 class="avatar rounded-circle d-flex align-self-center mr-2 z-depth-1">
                                                                            <div class="text-small">
                                                                                <strong>{{$users_name->name}}</strong>
                                                                                <p class="last-message text-muted">Lorem
                                                                                    ipsum
                                                                                    dolor
                                                                                    sit.</p>
                                                                                <input hidden
                                                                                       class="user_receive_id_null"
                                                                                       data-user_receive_id_null="{{$users_name->id}}">
                                                                            </div>

                                                                            @if($counter != null)
                                                                                <div class="chat-footer">
                                                                                    <p class="text-smaller text-muted mb-0">
                                                                                        Just now</p>
                                                                                    <span class="badge badge-danger float-right">{{$counter}}</span>
                                                                                </div>
                                                                            @else
                                                                                <div class="chat-footer">
                                                                                    @foreach($last_message as $last_messages)
                                                                                        @if($last_messages->hcv_request_user_id == $users_name->id and $find_last_message->created_at == $last_messages->created_at)
                                                                                            <p class="text-smaller text-muted mb-0">
                                                                                                {{$last_messages->created_at->format('H:i')}}</p>
                                                                                            <span class="text-muted float-right"><i
                                                                                                        class="fas fa-mail-reply"
                                                                                                        aria-hidden="true"></i></span>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif

                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                                <!-- Grid column -->

                                            </div>
                                            <!-- Grid row -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endrole
    @endsection
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#message-form").submit(function (event) {
                var data =
                    {
                        message: $('#exampleFormControlTextarea2').val(),
                        user_receive_id: $('#user_receive_id').data('user_receive_id') == null ? $('.user_receive_id_null').data('user_receive_id_null') : $('#user_receive_id').data('user_receive_id'),
                    }
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/conversation_view',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        $('#card-body').load(document.URL + '#card-body');
                    },
                    cache: false,
                });
            });
        });
    </script>
@endpush