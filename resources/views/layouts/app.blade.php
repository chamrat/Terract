
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset("/Images/terract.png" ) !!}"/>
    <title>Terract</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
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
                <img srcset="/Images/terract.png" id="logo">
                <a class="navbar-brand" >
                    <p onclick="goHome();">Terract</p>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    @can('view-property')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                Property<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @can('create-property')
                                    <li><a href="{{ route('create_property') }}">New Property</a></li>
                                @endcan
                                @can('view-property')
                                    <li><a href="{{ route('list_property') }}">List Properties</a></li>
                                @endcan
                                @can('create-property-unit')
                                    <li><a href="{{ route('create_unit') }}">New Property Unit</a></li>
                                @endcan
                                @can('view-property-unit')
                                    <li><a href="{{ route('list_units') }}">List Property Units</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('create-invite')
                        <li><a href="{{ route('invite_tenant') }}">Invite Tenant</a></li>
                    @endcan
                    @can('view-payment')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                Payment<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @can('create-payment')
                                    <li><a href="{{ route('make_payment') }}">Make Payment</a></li>
                                @endcan
                                @can('view-payment')
                                    <li><a href="{{ route('view_payment') }}">View Payment</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('view-issue')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                Issue<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @can('create-issue')
                                    <li><a href="{{ route('create_issue') }}">Report an Issue</a></li>
                                @endcan
                                @can('view-issue')
                                    <li><a href="{{ route('view_issues') }}">View Issues</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('forum')
                        <li><a href="{{ route('chatter.home')}}">Forums</a> </li>
                    @endcan
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                               aria-haspopup="true" v-pre>
                                {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@yield('js')
</body>
</html>