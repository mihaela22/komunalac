@extends('layouts.app')
@section('content')

  
 <span class="moje-prijave"><h1>O nama</h1></span>
<div class="section">   
	<div class="card" >
        <h2>Fix.IT</h2>
    </div>
<div class="card-1-2-5">
    <div class="column">
        <div class="description">
        	
                <p class="p_about_us">
            Fix.it je web platforma i mobilna aplikacija za sustav prijave uočenih problema vezanih za infrastrukturu grada i komunalno redarstvo sa geografskom
            lokacijom, slikom, opisom i praćenjem procesa rješavanja prijavljenih problema.</p>
            
            
                <p class="p_about_us">
            Aplikacija je osmišljena u namjeri da se građanima Grada Rijeke olakša prijava i pregled komunalnih problema te zaprimanje povratnih informacija o rješavanju problema, ali i omogući nadležnim službama bolju evidenciju i uvid u postojeće probleme.</p>
           
                <p class="p_about_us-1">
            Primjeri problema koji se mogu prijaviti putem Fix.IT aplikacije:</p> 
        <ul class="ul_primjer">
            <li class="li_primjer"><i class="fas fa-tools fa_tools_about_us"></i>&nbsp;&nbsp;Oštećenja javnih površina</li>
            <li class="li_primjer"><i class="fas fa-tools fa_tools_about_us"></i>&nbsp;&nbsp;Neadekvatno odlaganje otpada</li>
            <li class="li_primjer"><i class="fas fa-tools fa_tools_about_us"></i>&nbsp;&nbsp;Neispravna javna rasvjeta</li>
        </ul>
        </div>
    </div>
</div>
<div class="card-1-2-3">
<div id="wrapper-1">
    <div class="form-container-3">
        <span class="form-heading-6">Kontaktirajte nas</span>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
        <form method="POST" action="{{route('contactus.store')}}" id="contact_us_form">
        	@csrf
        	<div class="input-group">
                <i class="far fa-envelope"></i>
                    <input type="email" placeholder="EMAIL*" id="email_contact_us" class=" @error('email') is-invalid @enderror" name="email"   autocomplete="email" required >
                    <span class="bar"></span>
            </div>
            <div class="input-group">
                    <input type="text" placeholder="NASLOV" id="naslov_poruke" class=" {{ $errors->has('name') ? 'has-error' : '' }}" name="name">
                    <span class="bar"></span>
            </div>
            <div class="input-group">
                    <input type="text" placeholder="PORUKA" id="textarea_contact_us" class=" {{ $errors->has('message') ? 'has-error' : '' }}" name="message" rows="5" cols="150">
                    <span class="bar"></span>
            </div>
            <div class="input-group">
                <button type="submit" name="contact_us_submit" class="submit-button-right" value="Pošalji">
                    <i class="fab fa-telegram-plane"></i>
                </button>
            </div>
        
        </form>
    </div>
</div>
</div>
</div>



@endsection