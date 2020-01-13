@extends('layouts.app')

@section('content')
<div id="wrapper">
<div class="form-container-login">
    <form method="POST" action="{{ route('login')}}">
            @csrf
            <div class="logo-image">
                <img class="logo-image1"src="{{asset('img/logo10.png')}}" width="140" alt="logo">
            </div>
            <div class="title">
                <span>Prijava</span>
            </div>
            <!--INPUT KORISNIKA-->
            <div class="input-group">
                <i class="far fa-fw fa-envelope"></i>
                <input placeholder="EMAIL" id="email" type="email"  class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" style="color: #444;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <span class="bar"></span>
            </div>

            <div class="input-group">
               <i class="fas fa-fw fa-lock"></i>
                <input placeholder="PASSWORD" id="password" type="password" class=" @error('password') is-invalid @enderror" name="password"  required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" style=" color: #444;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <span class="bar"></span>
            </div>

            <!--Checkbox--> <!-- moj class u inputu --> <!--class="cb-position"-->
            <div class="checkbox-container">
                <span><input class="form-check-input" type="checkbox" name="remember" id="remember" value=" {{ old('remember') ? 
                'checked' : '' }}"> <span class="text">Zapamti me!</span></span>
                   
                <button type="submit" class="submit-button" >
                    <i class="fab fa-telegram-plane"></i>
                </button>
               
            </div>
            <div class="forgot-pass">
                <a href="{{ route('password.request') }}" class="nova-lozinka">Zaboravio/la si lozinku? <br> Nemaš brige, klikni me i slijedi upute!</a>
                 
            </div>

            <!--Social links-->
            <!--<p><strong>ili</strong></p>
            <div class="social-links-container">
                <a href="#"><button class="social-links">
                    <i class="fab fa-google-plus-g"></i>
                </button></a>
                </a href="#"><button class="social-links">
                    <i class="fab fa-facebook"></i>
                </button></a>
            </div>-->
            
            <!--Registracija button-->
            <div class="register">
                <span><strong>Nisi registriran/na?</strong>
                    
                    <button class="stvori-racun"><a class="a-stvori-r" href="{{ route('register')}}">Stvori račun</a></button>
                    
                </span>
            </div>
    </form>
</div>
</div>

@endsection
