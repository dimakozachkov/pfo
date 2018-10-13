<!DOCTYPE html>
<html lang="{{ app('translator')->getLocale() }}">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>{{ config('app.name') }}</title>
        <meta name="description" content="">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <meta property="og:image" content="path/to/image.jpg">
        <link rel="shortcut icon" href="http://prayfororphan.info/template/pfo/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="http://prayfororphan.info/template/pfo/img/favicon/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72"
              href="http://prayfororphan.info/template/pfo/img/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114"
              href="http://prayfororphan.info/template/pfo/img/favicon/apple-touch-icon-114x114.png">

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#000">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#000">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    </head>

    <body style="background: #f7f7f7;">

        @include('client.components.topside')

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">

                        @include('client.components.menu')

                    </div>
                    <div class="col-md-9">
                        @include('client.components.content')

                    </div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
        <script src="{{ asset('assets/select2/vendor/jquery-2.1.0.js') }}"></script>
        <script src="{{ asset('js/jquery.freetile.js') }}"></script>
        <script src="{{ asset('js/init.js') }}"></script>
        <script src="{{ asset('js/scripts.min.js') }}"></script>
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        @yield('scripts')

    </body>

</html>