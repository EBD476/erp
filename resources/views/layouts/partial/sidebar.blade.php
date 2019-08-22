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
            <li class="{{Request::is('admin/production*' ? 'active':'')}} ">
                <a class="nav-link" href="{{Route('production.index')}}">
                    <i class="material-icons">
                        business
                    </i>
                    <p>{{__('Production')}}</p>
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
