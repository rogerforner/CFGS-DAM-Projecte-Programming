<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('dashboard/users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\UserController@index') }}">Users</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/departments') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\DepartmentController@index') }}">Departments</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/professional-modules') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\ProfessionalModuleController@index') }}">Professional Modules</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/training-units') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\TrainingUnitController@index') }}">Training Units</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/temaries') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\TemaryController@index') }}">Temaries</a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/access-tokens') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('Web\AccessTokenController@index') }}">Access Tokens</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>