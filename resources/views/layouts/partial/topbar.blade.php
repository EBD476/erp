<nav class="navbar navbar-expand-lg fixed-top bg-gradient-light p-md-0 text-danger">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize d-inline">
                <button class="minimize-sidebar btn btn-link btn-just-icon" rel="tooltip"
                        data-original-title="Sidebar toggle" data-placement="right">
                    <i class="tim-icons icon-align-center visible-on-sidebar-regular"></i>
                    <i class="tim-icons icon-bullet-list-67 visible-on-sidebar-mini"></i>
                </button>
            </div>
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand font-weight-bold" href="javascript:void(0)">@yield('title')</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav @if (app()->getLocale() == 'fa') mr-auto @else ml-auto @endif">
                <li class="search-bar input-group">
                    <button class="btn btn-link" id="search-button" data-toggle="modal"
                            data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                        <span class="d-lg-none d-md-block">Search</span>
                    </button>
                </li>
                <li class="dropdown nav-item">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @foreach($help_desk as $check_status)
                                <div class="notification d-none d-lg-block d-xl-block"></div>
                        @endforeach
                        <i class="tim-icons icon-sound-wave"></i>
                        <p class="d-lg-none">
                            Notifications
                        </p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">

                        <li class="nav-link"><a href="{{route('projects.show_all_response')}}"
                                                class="nav-item dropdown-item">{{__('Support Response List')}}</a>
                        </li>
                        {{--@foreach($support_response as $responses)--}}
                        {{--@if($responses->hs_request_user_id == auth()->user()->id)--}}
                        {{--<li class="nav-link">--}}
                        {{--<a href="{{route('projects.show_response',$responses->id)}}"--}}
                        {{--class="nav-item dropdown-item">--}}

                        {{--{{auth()->user()->name}}--}}

                        {{--{{__('Responded To Your Request')}}--}}

                        {{--{{$responses->hs_title}}--}}

                        {{--{{__('Responded')}}--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        {{--@endforeach--}}

                        @foreach($help_desk as $help_desks_top_bar)
                                <li class="nav-link">
                                    <a href="{{route('help_desk.receive_show',$help_desks_top_bar->id)}}"
                                       class="nav-item dropdown-item">
                                        {{__('You Have One Ticket')}}
                                        @foreach($type as $types_top_bar)
                                            @if($types_top_bar->id == $help_desks_top_bar->hhd_type)
                                                {{$types_top_bar->th_name}}
                                            @endif
                                        @endforeach
                                        @foreach($priority as $priorities)
                                            @if($priorities->id == $help_desks_top_bar->hhd_priority)
                                                {{$priorities->hdp_name}}
                                            @endif
                                        @endforeach
                                        @foreach($user as $user_all)
                                            @if($user_all->id == $help_desks_top_bar->hhd_request_user_id)
                                                {{__('From')}}
                                                {{$user_all->name}}
                                            @endif
                                        @endforeach
                                        {{__('H')}}
                                    </a>
                                </li>
                        @endforeach
                        {{--<li class="nav-link"><a href="javascript:void(0)" class="nav-item --}}
                        {{--dropdown-item">Another notification</a></li>--}}
                        {{--<li class="nav-link"><a href="javascript:void(0)" class="nav-item --}}
                        {{--dropdown-item">Mike John responded to your email</a></li>--}}
                        {{--<li class="nav-link"><a href="javascript:void(0)" class="nav-item --}}
                        {{--dropdown-item">Another one</a></li>--}}
                    </ul>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="photo">
                            <img src="{{asset('assets/images/user.jpg')}}" alt="Profile Photo">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">
                            Log out
                        </p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <h5 class="dropdown-item">{{__('Current User:')}}{{auth()->user()->username}}</h5>
                        {{--<li class="dropdown-divider"></li>--}}
                        {{--<li class="nav-link">--}}
                        {{--<a href="javascript:void(0)" class="nav-item dropdown-item">{{__('Profile')}}</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-link">--}}
                        {{--<a href="javascript:void(0)" class="nav-item dropdown-item">{{__('Settings')}}</a>--}}
                        {{--</li>--}}
                        {{--<li class="dropdown-divider"></li>--}}
                        {{--<h5 class="dropdown-item">{{__('language')}}</h5>--}}
                        {{--<li class="nav-link">--}}
                        {{--<a class="nav-item dropdown-item" href="{{url('/locale/en')}}">{{__('English')}}</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-link">--}}
                        {{--<a class="nav-item dropdown-item" href="{{url('/locale/fa')}}">{{__('Persian')}}</a>--}}
                        {{--</li>--}}
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a class="nav-item dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            {{--<a href="javascript:void(0)" class="nav-item dropdown-item">--}}
                            {{--Log out--}}
                            {{----}}
                            {{--</a>--}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </div>
        </div>
    </div>
</div>
