<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Virtual Carving Show</title>
    <link rel="icon"
          href="https://cdn3.iconfinder.com/data/icons/construction-tools-filled-color-1/300/15544012Untitled-3-512.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">

    <!-- Styles -->
    <link href="{{ asset('css/minimal.css') }}" rel="stylesheet">


    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Social media --}}
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <meta property="og:url" content="https://entryform.richmondcarvers.com"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Virtual Carving Show"/>
    <meta property="og:description" content="Virtual Carving Show"/>
    <meta property="og:image" content="https://entryform.richmondcarvers.com/storage/carving_61_42_0.jpg"/>

    @csrf

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167953053-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-167953053-1');
    </script>

</head>

<body>
@yield('content')
</body>
</html>
