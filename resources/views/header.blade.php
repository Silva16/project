<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>

    </title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body>
    <div class="main">
        <header>
            <ul>
                <li>
                    <a href="http:\\10.10.10.10\project\">Página Principal</a>
                </li>
                <li>
                    {!! HTML::linkRoute('projects.index', 'Projectos') !!}
                </li>
                <li>
                    <a href="resources/views/projects/list">Autores</a>
                </li>
                {{--<li>
                    <input type="button" class="button1" value="Login" onclick="window.location='{{ url("auth/login") }}'">
                </li>--}}
                @if (Auth::check() && Auth::user()->role == 1 || Auth::check() && Auth::user()->role == 2)
                    <li >
                        {!! HTML::linkRoute('dashboard.index', 'Dashboard') !!}
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->role == 4)
                    <li >
                        {!! HTML::linkRoute('users.index', 'Gestão de Utilizadores') !!}
                    </li>
                @endif
                <div class="pull-right">
                <li>
                    <input type="text" style="margin-top: -4px" class="search-query" placeholder="Search">
                </li>
                @if (Auth::guest())
                <li>
                    <a href="{{ url('/auth/login') }}">Login</a>
                </li>
                @endif
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
                </div>
            </ul>
            <div class="logo">
                <img  id="logo" alt="logo" src="http:\\10.10.10.10\project\css\imagens\logo.png" />
            </div>
            <div id="barra">

            </div>
        </header>
@yield('content')

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>