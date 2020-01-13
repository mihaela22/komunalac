@extends('layouts.app')

@section('content')
    <div class="container_overlay2">
        <div class="container_overlay">
            <div class="row justify-content-center">

            </div>
        </div>
        <div class="container_glavni">

            <div style="width: 100%; height: 100%; margin: 0; display:flex; z-index: 1000">
                <div style="z-index: 1000; position: relative" class="fancy-button">
                    <div class="left-frills frills"></div>
                    <a href="{{ url('create_report')}}"><div class="button" >Kreiraj prijavu!</div></a>
                    <div class="right-frills frills"></div>
                </div>
            </div>
            <script>
                $(function(){
                    $(".fancy-button").mousedown(function(){
                        $(this).bind('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function(){
                            $(this).removeClass('active');
                        })
                        $(this).addClass("active");
                    });
                });
            </script>

        </div>
    </div>

@endsection