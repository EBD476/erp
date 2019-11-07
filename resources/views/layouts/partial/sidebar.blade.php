<div class="sidebar" data="purple">
    <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"-->
    <div class="sidebar-wrapper">
        <div class="logo">
            {{--<a href="javascript:void(0)" class="simple-text logo-mini">--}}

            {{--</a>--}}


            <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                            class="mdi mdi-gauge"></i><span
                            class="hide-menu">{{__('Dashboard')}} </span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                </ul>
            </li>


            <a href="javascript:void(0)" class="simple-text logo-normal">
                {{--H&nbsp;&nbsp;A&nbsp;&nbsp;N&nbsp;&nbsp;T&nbsp;&nbsp;A--}}
                <small>Hanta Smart Home</small>
            </a>
        </div>


        <div class="container" style="margin-top: 20px; display: block ;padding-right: 0px;padding-left: 0">
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex ">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    {{__('Dashboard')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('home') }}">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        {{__('Dashboard')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 150px">
                    <i class="tim-icons icon-coins"></i>
                    {{__('Orders')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('order.index') }}">
                        <i class="tim-icons icon-coins"></i>
                        {{__('Orders')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-app"></i>
                    {{__('Product')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{Route('product.index')}}">
                        <i class="tim-icons icon-app" style="size: 8px"></i>
                        {{__('Product')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{route('products.index')}}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Manage Products')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{route('repository_requirement.index')}}">
                        <i class="tim-icons icon-bullet-list-67"></i>
                        {{__('Product Requirement')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('part.index')}}">
                        <i class="tim-icons icon-settings-gear-63"></i>
                        {{__('Parts')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('product_part.index')}}">
                        <i class="tim-icons icon-settings-gear-63"></i>
                        {{__('Product Parts')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-molecule-40"></i>
                    {{__('Project')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('projects.index') }}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Manage Projects')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('map')}}">
                        <i class="tim-icons icon-square-pin"></i>
                        {{__('Projects Map')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-wallet-43"></i>
                    {{__('Repository')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{Route('repository.index')}}">
                        <i class="tim-icons icon-wallet-43"></i>
                        {{__('Repository')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('repository_create.index')}}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Repository Management')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-headphones"></i>
                    {{__('Help Desk')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('help_desk.index') }}">
                        <i class="tim-icons icon-headphones"></i>
                        {{__('Help Desk')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-settings"></i>
<<<<<<< HEAD
                    {{__('Request')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('request.index') }}">
                        <i class="tim-icons icon-settings"></i>
                        {{__('Request')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-user-run"></i>
                    {{__('Users')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('users.index') }}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Manage Users')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('roles.index')}}">
                        <i class="tim-icons icon-user-run"></i>
                        {{__('Manage Roles')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{route('verifier.index')}}">
                        <i class="tim-icons icon-check-2"></i>
                        {{__('Verifier')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-single-02"></i>
                    {{__('Client')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('client.index') }}">
                        <i class="tim-icons icon-single-02"></i>
                        {{__('Client')}}
                    </a>
                </div>
            </div>


        </div>


=======
                    <p>{{__('Settings')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('product.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Product')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('part.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Parts')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('product_part.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Product Parts')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('repository_create.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Repository Management')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('repository.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Repository')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('repository_requirement.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Product Requirement')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('request.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Request')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('client.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Client')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('verifier.index')}}">
                    <!-- For IE9 or below. -->
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Verifier')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{Route('help_desk.index')}}">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Help Desk')}}</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./map.html">
                    <i><img src="https://img.icons8.com/dotty/30/000000/marker.png"></i>
                    <p>{{__('Map')}}</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./notifications.html">
                    <i><img src="https://img.icons8.com/dotty/30/000000/push-notifications.png"></i>
                    <p>{{__('Notifications')}}</p>
                </a>
            </li>
            {{--<li>--}}
            {{--<a href="./typography.html">--}}
            {{--<i class="tim-icons icon-align-center"></i>--}}
            {{--<p>Typography</p>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="./rtl.html">--}}
            {{--<i class="tim-icons icon-world"></i>--}}
            {{--<p>RTL Support</p>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="active-pro">--}}
            {{--<a href="./upgrade.html">--}}
            {{--<i class="tim-icons icon-spaceship"></i>--}}
            {{--<p>Upgrade to PRO</p>--}}
            {{--</a>--}}
            {{--</li>--}}
        </ul>
>>>>>>> 6da1309d62f45fdd1a204ba670d7797be9c74d50
    </div>
</div>