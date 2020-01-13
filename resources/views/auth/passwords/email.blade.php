@extends('layouts.app')

@section('content')
<div id="wrapper">
        <div class="form-container">
            <span class="form-heading">Nova lozinka</span>
        <form method="POST" action="{{ route('password.email') }}">
            <!--INPUT KORISNIKA-->
            @csrf
            <div class="input-group">
                <i class="far fa-envelope"></i>
                    <input type="e-mail" placeholder="EMAIL*" id="email" class=" @error('email') is-invalid @enderror" name="email"   autocomplete="email" required>
                <span class="bar"></span>
            </div>
            <div class="input-group">
                <button type="submit" class="submit-button-right">
                    <i class="fab fa-telegram-plane"></i>
                </button>
            </div>
        </form>
        @if (session('status'))
            <div class="alert alert-success" style="display: flex;
    justify-content: center;
    padding-top: 3rem; color: #444;" role="alert">
                {{ session('status') }}
            </div>
         @endif
        </div>
</div>
@endsection
