<!--<header class="masthead mb-auto bg-dark">
    <div class="inner">
        <h3 class="masthead-brand text-center">{{config('app.name','WSN')}}</h3>
        <nav class="nav nav-masthead navbar-light bg-dark justify-content-center">
            <a class="nav-link active" href="/">Home</a>
            <a class="nav-link" href="/blogmain">Blog</a>
            <a class="nav-link" href="/about">about</a>
        </nav>
    </div>
</header>-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        @guest
            <a class="navbar-brand" href="{{ url('/posts') }}">
                WSN
            </a>
        @else
            @can('admins-only',Auth::user())
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            @endcan
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contactUs">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about" tabindex="-1" aria-disabled="true">About</a>
                    </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative; padding-left: 50px;" v-pre>
                            <img  src="/storage/profile_pictures/{{Auth::user()->profile_picture }}" style="width: 32px; height: 32px; position: absolute;  left: 10px; border-radius: 50%;" >
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="/profile/show">
                                {{ Auth::user()->name }} Profile page
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
