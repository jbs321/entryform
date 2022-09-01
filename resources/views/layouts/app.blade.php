<?php
$user = \Illuminate\Support\Facades\Auth::user();
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Virtual Carving Show</title>
    <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/construction-tools-filled-color-1/300/15544012Untitled-3-512.png">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    {{-- Social media --}}
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <meta property="og:url"           content="https://entryform.richmondcarvers.com" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Virtual Carving Show" />
    <meta property="og:description"   content="Virtual Carving Show" />
    <meta property="og:image"         content="https://entryform.richmondcarvers.com/storage/carving_61_42_0.jpg" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167953053-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-167953053-1');
    </script>

</head>

<style>
    .hidden {
        display: none !important;
    }
</style>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Richmond Carvers - Carving Show 2022
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('My Carvings') }}</a></li>
                        <li><a class="nav-link" href="http://richmondcarvers.com">RichmondCarvers.com</a></li>
                    @else
                        <li>
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fname . " " . Auth::user()->lname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <?php if($user->is_admin): ?>

                                    <a class="dropdown-item" href="{{ route('admin') }}">
                                        Admin Dashboard
                                    </a>

                                    <a class="dropdown-item" href="/tickets">
                                        Tickets (Under Construction)
                                    </a>

                                    <a class="dropdown-item" href="/admin/payments">
                                        Payments
                                    </a>
                                <?php endif; ?>

                                    <a class="dropdown-item" href="/">
                                        My Carvings
                                    </a>

                                    <a class="dropdown-item" href="/user/{{$user->id}}/edit">
                                        My Profile
                                    </a>

                                    <a class="dropdown-item" href="/user/{{$user->id}}/view-payments">
                                        My Payments
                                    </a>

                                    <a class="dropdown-item" href="http://richmondcarvers.com">
                                        Richmondcarvers.com
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
