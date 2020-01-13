@extends('layouts.admin')
@section('content')
<div class="container">
			
			<hr>		
			<div class="row justify-content-around">


                <ul class="nav nav-pills mb-3 col-12" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Prijavljeno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">U procesu</a>
                    </li>

                </ul>
                <div class="tab-content col-12" id="pills-tabContent">



                    <div class="tab-pane fade show active col-12 p-4" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="col-12">

                        <div class="d-flex row d-none d-sm-none d-md-flex mx-2">
                            <div class="col-6 d-none d-sm-flex font-weight-bold">Opis</div>
                            <div class="col-3 d-none d-sm-flex font-weight-bold">Adresa</div>
                            <div class="col-3 d-none d-sm-flex font-weight-bold">Proslijedi | Riješi</div>
                        </div>
                        <?php $count_prijavljeni=0;?>
                        @foreach($reports as $report)
                            @if($report->processed_at == null)
                                <?php $count_prijavljeni++ ?>
                            @endif
                        @endforeach
@if($count_prijavljeni!==0)
                            @foreach($reports as $report)
                            @if($report->processed_at == null)
                                <hr>
                                <div class="d-flex row mx-2">
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Opis</div>
                                    <div class="col-12 col-md-6 d-flex align-items-center p-3">{{$report->description}}</div>
                                    <!--<div class="col-5 d-flex d-sm-flex d-md-none font-weight-bold">Adresa:</div>-->
                                    <div class="col-8 col-md-3 d-flex align-items-center"><span class="d-sm-flex d-md-none font-weight-bold">Adresa:&nbsp&nbsp</span> {{$report->address}} </div>

                                    <div class="col-md-3 d-flex align-items-center"><a class="btn btn-blue my-3"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-long-arrow-alt-right"></i></a></div>

                                </div>
                            
                            @endif

                            @endforeach
                        @else
                            <hr>
                            <p class="my-3 mx-2">Nema novih prijava.</p>
                        @endif

                        </div>

                        </div>
                       
                        

                        <div class="tab-pane fade p-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class=" col-12">

                            <div class="d-flex row d-none d-sm-none d-md-flex mx-2">
                                <div class="col-6 d-none d-sm-flex font-weight-bold">Opis</div>
                                <div class="col-3 d-none d-sm-flex font-weight-bold">Adresa</div>
                                <div class="col-3 d-none d-sm-flex font-weight-bold">Proslijedi | Riješi</div>
                            </div>
                        <?php $count_u_procesu=0;?>
                        @foreach($reports as $report)
                            @if($report->processed_at !== null and $report->solved_at === null)
                                <?php $count_u_procesu++ ?>
                            @endif
                        @endforeach

							@if($count_u_procesu!==0)
							@foreach($reports as $report)
							@if($report->processed_at !== null and $report->solved_at === null)

                                <hr>
                                <div class="d-flex row mx-2">
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Opis</div>
                                    <div class="col-12 col-md-6 d-flex align-items-center p-3">{{$report->description}}</div>
                                    <!--<div class="col-5 d-flex d-sm-flex d-md-none font-weight-bold">Adresa:</div>-->
                                    <div class="col-8 col-md-3 d-flex align-items-center"><span class="d-sm-flex d-md-none font-weight-bold">Adresa:&nbsp&nbsp</span> {{$report->address}} </div>

                                    <div class="col-md-3 d-flex align-items-center"><a class="btn btn-yellow my-3"  href="{{url('/admin/report/completed/'. $report->id)}}"><i class="fas fa-long-arrow-alt-right"></i></a></div>

                                </div>
							@endif			
							@endforeach
                        @else
                            <hr>
                            <p class="my-3 mx-2">Nema prijava u procesu rješavanja.</p>
                        @endif


                    </div>
                      
                    </div>
                </div>


			
			</div>
</div>
		
  @endsection
 
