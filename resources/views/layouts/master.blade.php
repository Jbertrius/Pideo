
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="Pideo" />
    <meta name="keywords" content="html, pideo, streaming, social network, web design" />
    <meta name="author" content="Jbertrius" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <link rel="manifest" href="/manifest.json">
   <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script src="{{ elixir('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var UserId = "{{ Auth::user()->webpushid->count()  }}";
        var permission = '{{ trans('notification.actionMessage') }}';

     </script>

    <script type="text/javascript" src="{{asset('js/webpush.js')}}"></script>



    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/favicons/apple-touch-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/favicons/apple-touch-icon-60x60.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicons/favicon-32x32.png" sizes="32x32')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicons/favicon-16x16.png" sizes="16x16')}}">
    <link rel="manifest" href="{{asset('img/favicons/manifest.json')}}">
    <link rel="shortcut icon" href="{{asset('img/favicons/favicon.ico')}}">
    <meta name="msapplication-TileColor" content="#00a8ff">
    <meta name="msapplication-config" content="img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">




    <!--[if lt IE 9]>
    {{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
    {{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->

    <!-- Styles -->

    @yield('style')
    <link rel="stylesheet" type="text/css"   href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>











</head>


<body>


@yield('contenu')



<!-- Scripts -->




  <script src="//js.pusher.com/3.2.0/pusher.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{asset('js/editPic.js')}}"></script>

@yield('script')
</body>
</html>