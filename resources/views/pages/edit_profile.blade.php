@extends('layouts.app')
@section('content')

    <div id="wrapper">
        <div class="form-container">
            <span class="form-heading">Uredi profil</span>
                <form method="POST" action="{{ url('/update_profile/'.$user_data->id) }}">
                    {{method_field('PUT')}}
                            @csrf
                     <!--INPUT KORISNIKA-->
                    <div class="input-group">
                        <input type="text" placeholder="IME" id="name" class=" @error('name') is-invalid @enderror" name="name"  autocomplete="name" value="{{$user_data->name}}" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                            
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="PREZIME" id="surname" class=" @error('surname') is-invalid @enderror" name="surname" autocomplete="surname" value="{{$user_data->surname}}"autofocus>
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <input type="tel" placeholder="BROJ TELEFONA" id="phone" class=" @error('phone') is-invalid @enderror" name="phone"  autocomplete="phone"  value="{{$user_data->phone}}" autofocus>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="bar"></span>
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
