<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <!-- Branding Image -->
            
            @guest
            <a class="brand brand-name navbar-left" href="{{ url('/') }}">
                <img src="{{ asset('icon/FNlogo-mini-v2.png') }}" style="margin-top:3px;">
            </a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    &nbsp;
                    {{ config('app.name') }}
                </a>
            @else
            <a class="brand brand-name navbar-left" href="{{ url('/') }}">
                <img src="{{ asset('icon/FNlogo-mini-v2.png') }}" style="margin-top:3px;">
            </a>
                
                <a class="navbar-brand" href="/dashboard">
                    &nbsp;
                    {{ config('app.name') }}
                </a>
             @endguest
            
            
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            {{--  <ul class="nav navbar-nav">
                @guest
                    &nbsp;
                @endguest
            </ul>  --}}

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                
                    <li>
                        <div class="col-sm-3 col-md-12">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" id="searchItem" name="searchItem">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </li>              
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/notes">Notes</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{--  <li><a href="/notes/create"><i class="fa fa-plus" aria-hidden="true" title="Create Note"></i></a></li>  --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>

