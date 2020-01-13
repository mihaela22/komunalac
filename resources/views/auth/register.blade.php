@extends('layouts.app')

@section('content')
    <div id="wrapper">
        <div class="form-container">
            <!--<div class="go-back" >
                <a href="{{route('login')}}">
                <i class="far fa-hand-point-left"></i></a>
            </div>-->
            <span class="form-heading">Stvori račun</span>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                     <!--INPUT KORISNIKA-->
                    <div class="input-group">
                        <input type="text" placeholder="IME" id="name" class=" @error('name') is-invalid @enderror" name="name"  autocomplete="name" autofocus>
                            
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="PREZIME" id="surname" class=" @error('surname') is-invalid @enderror" name="surname" autocomplete="surname">
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <input type="tel" placeholder="BROJ TELEFONA" id="phone" class=" @error('phone') is-invalid @enderror" name="phone"  autocomplete="phone">
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <i class="far fa-envelope"></i>
                        <input type="e-mail" placeholder="EMAIL*" id="email" class=" @error('email') is-invalid @enderror" name="email"   autocomplete="email" >
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="LOZINKA*" id="password"  class=" @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" >
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="PONOVI LOZINKU*" id="password-confirm" class="@error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" >
                        <span class="bar"></span>
                    </div>
                     <!--Checkbox-->
                    <div class="input-group">
                        <input type="checkbox" class="gdpr-1"><span>Registracijom prihvaćaš opće uvjete <a href="{{url('/gdpr')}}">izjave o zaštiti osobnih podataka.</a></span>
                        
                    </div>
                   
                    <div class="input-group">
                        <input type="checkbox" class="gdpr"><span>Suglasan/na sam da se moja e-mail adresa pohranjuje i obrađuje u svrhu primanja obavijesti i informacija o prijavljenom problemu.
                        </span>
                    </div>
                    <!--Submit button-->
                    
                    
                    <div class="input-group">
                        <button type="submit" class="submit-button-right">
                            <i class="fab fa-telegram-plane"></i>
                        </button>
                    </div>
                    
                </form>
        </div>
    </div>

@endsection
