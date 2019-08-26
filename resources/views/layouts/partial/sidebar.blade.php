<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a class="simple-text logo-normal" style="padding-right: 30px">
           {{__('Creative Tim')}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{Request::is('admin/dashboard*' ? 'active':'')}} ">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            @can('browse-menu-user')

            @can('browse-menu')
            <li class="{{Request::is('admin/user*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('user.index')}}">
                    <i class="material-icons">account_box</i>
                    <p>{{__('account_box')}}</p>
                </a>
            </li>
            @endcan
            @can('browse-menu-pr-s')
            <li class="{{Request::is('admin/order*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('order.index')}}">
                    <i class="material-icons">
                        business
                    </i>
                    <p>{{__('Order')}}</p>
                </a>
            </li>
            <li class="{{Request::is('admin/product*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('product.index')}}">
                    <i class="material-icons">account_box</i>
                    <p>{{__('Product')}}</p>
                </a>
            </li>
            <li class="{{Request::is('admin/repository*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('repository.index')}}">
                    <i class="material-icons">account_box</i>
                    <p>{{__('Repository')}}</p>
                </a>
            </li>
            <li class="{{Request::is('admin/repository_requirement*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('repository_requirement.index')}}">
                    <i class="material-icons">account_box</i>
                    <p>{{__('Product Requirement')}}</p>
                </a>
            </li>
            @endcan

            @can('browse-menu-pj-s')
            <li class="{{Request::is('admin/project*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('project.index')}}">
                    <i class="material-icons">account_box</i>
                    <p>{{__('Project')}}</p>
                </a>
            </li>

                    <li class="{{Request::is('admin/repository*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('repository.index')}}">
                            <i><img src="https://img.icons8.com/wired/30/000000/repository.png"></i>
                            <p>{{__('Repository')}}</p>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/repository_requirement*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('repository_requirement.index')}}">
                            <i>
                                <img src="https://img.icons8.com/dotty/30/000000/used-product.png">
                            </i>
                            <p>{{__('Product Requirement')}}</p>
                        </a>
                    </li>
                @endcan

                @can('browse-menu-pj-s')
                    <li class="{{Request::is('admin/project*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('project.index')}}">
                            <i><img src="https://img.icons8.com/dotty/30/000000/project.png"></i>
                            <p>{{__('Project')}}</p>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/request*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('request.index')}}">
                            <i><img src="https://img.icons8.com/dotty/30/000000/request-service.png"></i>
                            <p>{{__('Request')}}</p>
                        </a>
                    </li>

                    <li class="{{Request::is('admin/verifier*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('verifier.index')}}">
                            <!-- For IE9 or below. -->
                            <i >
                                <img src="https://img.icons8.com/dotty/30/000000/approval.png">                            </i>
                            <p>{{__('Verifier')}}</p>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/help_desk*' ? 'active':'')}} ">
                        <a class="nav-link" href="{{Route('help_desk.index')}}">
                            <i><img src="https://img.icons8.com/dotty/30/000000/request-service.png"></i>
                            <p>{{__('Help Desk')}}</p>
                        </a>
                    </li>
                @endcan

            @endcan
            {{--@endrole--}}

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
            <li class="{{Request::is('admin/order*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('order.index')}}">
                    <i>
                        <img src="https://img.icons8.com/dotty/30/000000/todo-list.png">
                    </i>
                    <p>{{__('Order')}}</p>
                </a>
            </li>



            @endcan

            @endcan

            <li class="nav-item ">
                <a class="nav-link" href="./map.html">
                    <i class="material-icons">location_ons</i>
                    <p>{{__('Map')}}</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./notifications.html">
                    <i class="material-icons">notifications</i>
                    <p>{{__('Notifications')}}</p>
                </a>
            </li>


            <!-- <li class="nav-item active-pro ">
                  <a class="nav-link" href="./upgrade.html">
                      <i class="material-icons">unarchive</i>
                      <p>Upgrade to PRO</p>
                  </a>
              </li> -->
        </ul>
    </div>
</div>



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
            <li >
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
