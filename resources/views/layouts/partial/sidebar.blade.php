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


        <div class="container" style="margin-top: 20px; display: block ;padding-right: 0px;padding-left: 0">
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex ">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
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
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
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
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 150px">
                    <i class="tim-icons icon-coins"></i>
                    {{__('Agreement')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('agreement.index') }}">
                        <i class="tim-icons icon-coins"></i>
                        {{__('Agreement Management')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 150px">
                    <i class="tim-icons icon-coins"></i>
                    {{__('Finance')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('agreement.index') }}">
                        <i class="tim-icons icon-coins"></i>
                        {{__('Finance Product')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('agreement.index') }}">
                        <i class="tim-icons icon-coins"></i>
                        {{__('fund')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('agreement.index') }}">
                        <i class="tim-icons icon-coins"></i>
                        {{__('hazine jari')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-app"></i>
                    {{__('Product')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{Route('product.index')}}">
                        <i class="tim-icons icon-app" style="size: 8px"></i>
                        {{__('Product')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{route('repository_requirement.index')}}">
                        <i class="tim-icons icon-bullet-list-67"></i>
                        {{__('Product Requirement')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{route('repository-part.index')}}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Part Repository')}}
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
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex ">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-molecule-40"></i>
                    {{__('Project')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('projects.index') }}">
                        <i class="tim-icons icon-paper"></i>
                        {{__('Projects Management')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('map')}}">
                        <i class="tim-icons icon-square-pin"></i>
                        {{__('Projects Map')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
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
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-wallet-43"></i>
                    {{__('Install')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{Route('install.index')}}">
                        <i class="tim-icons icon-wallet-43"></i>
                        {{__('Install Management')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{Route('delivery.index')}}">
                        <i class="tim-icons icon-wallet-43"></i>
                        {{__('Delivery Management')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-headphones"></i>
                    {{__('Help Desk')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('help_desk.index') }}">
                        <i class="tim-icons icon-headphones"></i>
                        {{__('Help Desk')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('priority.index') }}">
                        <i class="tim-icons icon-headphones"></i>
                        {{__('Priority')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('type.index') }}">
                        <i class="tim-icons icon-headphones"></i>
                        {{__('Type')}}
                    </a>
                    <a class="dropdown-item nav-link" href="{{ route('ticket.index') }}">
                        <i class="tim-icons icon-headphones"></i>
                        {{__('Ticket Status')}}
                    </a>
                </div>
            </div>
            <div class="dropdown dropleft float-right" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
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
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
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
            <div class="dropdown dropleft float-right bg-transparent" style="display: flex">
                <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        style="padding-right: 10px;padding-left: 160px">
                    <i class="tim-icons icon-single-02"></i>
                    {{__('Setting')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item nav-link" href="{{ route('level.index') }}">
                        <i class="tim-icons icon-single-02"></i>
                        {{__('HNT Level')}}
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>











<!-- Sidebar -->
<ul class="nav">
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
            <p>{{__('Dashboard')}}</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#componentsExamples" aria-expanded="false">
            <i class="tim-icons icon-coins" style="float: right"></i>
            <p>
                {{__('Order')}}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="componentsExamples" style="">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('order.index') }}">
                        {{--<span class="sidebar-mini">B</span>--}}
                        <span class="sidebar-normal"> {{__('Order')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
            <i class="tim-icons icon-coins" style="float: right"></i>
            <p>
                {{__('Agreement')}}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse " id="formsExamples">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('agreement.index') }}">
                        {{--<span class="sidebar-mini">Rf</span>--}}
                        <span class="sidebar-normal">{{__('Agreement Management')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
            <i class="tim-icons icon-coins" style="float: right"></i>
            <p>
                {{__('Finance')}}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse " id="tablesExamples">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href={{ route('agreement.index') }}>
                        {{--<span class="sidebar-mini">RT</span>--}}
                        <span class="sidebar-normal">{{__('Finance Product')}}</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../tables/extended.html">
                        {{--<span class="sidebar-mini">ET</span>--}}
                        <span class="sidebar-normal">{{__('fund')}}</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../tables/bootstrap-table.html">
                        {{--<span class="sidebar-mini">BT</span>--}}
                        <span class="sidebar-normal">{{__('hazine jari')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#mapsExamples" aria-expanded="true">
            <i class="tim-icons icon-app" style="float: right"></i>
            <p>
                {{__('Product')}}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse show" id="mapsExamples" style="">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('repository_requirement.index')}}">
                        {{--<span class="sidebar-mini">GM</span>--}}
                        <span class="sidebar-normal">{{__('Product Requirement')}}</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{Route('product.index')}}">
                        {{--<span class="sidebar-mini">VM</span>--}}
                        <span class="sidebar-normal">{{__('Product')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="../charts.html">
            <i class="nc-icon nc-chart-bar-32" style="float: right"></i>
            <p>Charts</p>
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="../calendar.html">
            <i class="nc-icon nc-single-copy-04" style="float: right"></i>
            <p>Calendar</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
            <i class="nc-icon nc-puzzle-10" style="float: right"></i>
            <p>
                Pages
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse " id="pagesExamples">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="../pages/login.html">
                        <span class="sidebar-mini">LP</span>
                        <span class="sidebar-normal">Login Page</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../pages/register.html">
                        <span class="sidebar-mini">RP</span>
                        <span class="sidebar-normal">Register Page</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../pages/lock.html">
                        <span class="sidebar-mini">LSP</span>
                        <span class="sidebar-normal">Lock Screen Page</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link" href="../pages/user.html">
                        <span class="sidebar-mini">UP</span>
                        <span class="sidebar-normal">User Page</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link" href="#lbd">
                        <span class="sidebar-mini">MCS</span>
                        <span class="sidebar-normal">More coming soon...</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->
