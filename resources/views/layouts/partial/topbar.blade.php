<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">{{\Auth::user()->username}}</a>
        </div>

        <div class="navbar-wrapper">
            <a class="nav-link" href="{{route('admin.dashboard')}}" onclick="event.preventDefault();">
            {{--<i class="material-icons" href="{{route('admin.dashboard')}}">انگلیسی</i></a>--}}
        </div>


        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">


                <li class="nav-item">
                    <a class="nav-link" href="#pablo">

                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">exit_to_app</i>
                    </a>
                    <form id="logout-form" method="post" action="{{route('logout')}}" style="display:none">
                        @csrf
                    </form>
                </li>>

            </ul>
        </div>
    </div>
</nav>