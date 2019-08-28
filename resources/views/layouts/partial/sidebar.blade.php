<div class="sidebar" data="purple">
    <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"-->
    <div class="sidebar-wrapper">
        <div class="logo">
            {{--<a href="javascript:void(0)" class="simple-text logo-mini">--}}

            {{--</a>--}}
            <a href="javascript:void(0)" class="simple-text logo-normal">
                {{--H&nbsp;&nbsp;A&nbsp;&nbsp;N&nbsp;&nbsp;T&nbsp;&nbsp;A--}}
                <small>Hanta Smart Home</small>
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('projects.index') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{__('Manage Projects')}}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('order.index') }}">
                    <i class="tim-icons icon-app"></i>
                    <p>{{__('Orders')}}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('map')}}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{__('Projects Map')}}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index')}}">
                    <i class="tim-icons icon-bulb-63"></i>
                    <p>{{__('Manage Products')}}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p> {{__('Manage Users')}}</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{__('Manage Roles')}}</p>
                </a>
            </li>
            <li>
                <a href="./tables.html">
                    <i class="tim-icons icon-coins"></i>
                    <p>{{__('Manage Finance')}}</p>
                </a>
            </li>
            <li>
                <a href="./tables.html">
                    <i class="tim-icons icon-settings"></i>
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
    </div>
</div>