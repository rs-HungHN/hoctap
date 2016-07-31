<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" > <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('appname') - @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        @yield('css')
        <style type="text/css" media="screen">
            .background{
                background-color: #673AB7;
                height: 250px;
            }
        </style>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    </head>
    <body  ng-app="elearning">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @include('template.frontend.navbar')
        <div class="background fixed-style">
            
        </div>
        <div class="blue" style="margin-top: -78px">
            @yield('content')
        </div>
        <script type="text/javascript" src="{{ asset('public/components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/components/angular/angular.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/components/angular-aria/angular-aria.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/components/angular-animate/angular-animate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/components/angular-material/angular-material.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/frontend/app.js') }}"></script>
        @yield('js')
    </body>
</html>