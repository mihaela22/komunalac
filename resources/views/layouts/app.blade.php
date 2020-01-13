<!DOCTYPE html>
<?php 

function current_page ($url = "/") {
    return request()->path() == $url;
}
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Komunalac') }}</title>
    
    <!-- Scripts -->

    <script src={{ asset ('anime/anime.min.js') }}></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="shortcut icon" href="{{ asset('img/logo-web.png') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    <link rel="stylesheet" href="{{ asset('css/button.css')}}">
    
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</head>
<body class="new-body">

    <header>
           @if(current_page('login') or current_page('register'))
           @else
            
            <a class="logo-1" href="{{ url('/home') }}"><img src="{{ asset('storage/img/logo.png') }}" height="30" width="70" alt="logo" class="logo"></a>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <nav>
                <ul>
                    @auth
                        <li><a href="{{ url('imbex') }}">Sve prijave</a></li>
                        <li><a href="{{ url('about') }}">O nama</a></li>
                        <li><a href="{{ url('reports') }}">Moje prijave</a></li>
                        <li><a href="{{ route('profile.update',Auth::user()->id) }}">Uredi profil</a></li>
                        <li><a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>
                    @else
                        <li><a href="{{ url('about') }}">O nama</a></li>
                        <li><a href="{{route('login')}}">Prijava</a></li>
                        <li><a href="{{route('register')}}">Registracija</a></li>
                        
                    @endauth 
                </ul>
            </nav>
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>   
            @endif
            
            
        </header>
             
   @yield('content')
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6FqehalRgD7zrzJULENjSzuxaCQXV4bo&callback=initMap&libraries=places">
</script>
</body>
</html>
