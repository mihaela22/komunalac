@extends('layouts.app')

@section('content')
<div id="wrapper">
        <div class="form-container">
            <span class="form-heading">Ponovno upiši lozinku</span>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <!--INPUT KORISNIKA-->
            <div class="input-group">
                <i class="far fa-envelope"></i>
                    <input type="e-mail" placeholder="EMAIL*" id="email" class=" @error('email') is-invalid @enderror" name="email"   autocomplete="email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <span class="bar"></span>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                    <input type="password" placeholder="LOZINKA*" id="password"  class=" @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="bar"></span>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                    <input type="password" placeholder="PONOVI LOZINKU*" id="password-confirm" class="@error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" required>
                    <span class="bar"></span>
            </div>
            <div class="input-group">
                <button type="submit" class="submit-button-right">
                    <i class="fab fa-telegram-plane"></i>
                </button>
            </div>
        </form>
        </div>
    </div>
@endsection
