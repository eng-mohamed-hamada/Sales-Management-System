<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href={{asset("css/bootstrap.min.css")}}>
    <link href="{{ asset('css/css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet"> --}}
    <script src={{asset("js/html5shiv.min.js")}}></script>
    <script src={{asset("js/respond.min.js")}}></script>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="container-fluid">
            <div class="row">                    
                      <div class="login-container col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-right">
                        <div class="panel panel-default">
                            <div class="login-logo-container text-center">
                            <img class="img-responsive img-circle img-thumbnail" src="{{asset("images/default.jpg")}}">
                            </div>
            
                            <div class="panel-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>

    <!-- Scripts -->
    <script src={{asset("js/jquery-3.2.1.min.js")}}></script>
    <script src={{asset("js/bootstrap.min.js")}}></script>
    <script src="{{asset("js/js.js")}}"></script>
    <script src="{{asset("js/jquery.nicescroll.min.js")}}"></script>
</body>
</html>
