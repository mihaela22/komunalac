@extends('layouts.admin')
@section('content')
	<div class="container">
		<h1 class="my-3">Prikaz prijava</h1>

		<div class="row justify-content-around">
			<div class="nav flex-column nav-pills col-md-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-svi-tab" data-toggle="pill" href="#v-pills-svi" role="tab" aria-controls="v-pills-svi" aria-selected="true">Svi</a>
				<a class="nav-link" id="v-pills-u_procesu-tab" data-toggle="pill" href="#v-pills-u_procesu" role="tab" aria-controls="v-pills-u_procesu" aria-selected="false">U procesu</a>
				<a class="nav-link" id="v-pills-rijeseno-tab" data-toggle="pill" href="#v-pills-rijeseno" role="tab" aria-controls="v-pills-rijeseno" aria-selected="false">Riješeno</a>
				<a class="nav-link" id="v-pills-prijavljeno-tab" data-toggle="pill" href="#v-pills-prijavljeno" role="tab" aria-controls="v-pills-prijavljeno" aria-selected="false">Prijavljeno</a>
				<a class="nav-link" id="v-pills-banirani-tab" data-toggle="pill" href="#v-pills-banirani" role="tab" aria-controls="v-pills-banirani" aria-selected="false">Blokirani</a>

			</div>

			<div class="tab-content col-md-9  m-3" id="v-pills-tabContent">
				<div class="tab-pane fade active show" id="v-pills-svi" role="tabpanel" aria-labelledby="v-pills-svi-tab">
					<div class="table">

						<div class="d-flex row d-none d-sm-none d-md-flex">
							<div class="col-2 d-none d-sm-flex font-weight-bold">Datum prijave</div>
							<div class="col-2 d-none d-sm-flex font-weight-bold">Datum u procesu</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum rješenja</div>
                            <div class="col-4 d-none d-sm-flex font-weight-bold">Email</div>
							<div class="col-2 d-none d-sm-flex font-weight-bold">Detalji</div>
						</div>
                        @if(!empty($reports))
					@foreach($reports as $report)
							<hr>
							<div class="d-flex row">
								<div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum prijave</div>
								<div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->reported_at}}</div>
                                <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum u procesu</div>
                                @if ($report->processed_at !== NULL)
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->processed_at}}</div>
                                @else
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                @endif
                                <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum rješenja</div>
                                @if ($report->solved_at !== NULL)
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->solved_at}}</div>
                                @else
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                @endif
                                <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Email</div>
                                <div class="col-12 col-md-4 d-flex align-items-center p-3">{{$report->user->email}}</div>
								<!--<div class="col-5 d-flex d-sm-flex d-md-none font-weight-bold">Adresa:</div>
								<div class="col-8 col-md-3 d-flex align-items-center"><span class="d-sm-flex d-md-none font-weight-bold">Adresa:&nbsp&nbsp</span> {{$report->address}} </div>
-->
<!-- baned -->
								@if($report->user->ban == 2)
									<div class="col-2 col-md-2 d-flex align-items-center justify-self-sm-end"><a class="btn btn-red"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
									<!-- rjeseni -->
									@elseif($report->solved_at != null)
									<div class="col-md-2 d-flex align-items-center"><a class="btn btn-green"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
									<!-- prijavljeni -->
									@elseif($report->processed_at == null and $report->solved_at == null)
									<div class="col-md-2 d-flex align-items-center"><a class="btn btn-blue"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
									<!-- u procesu -->
									@elseif($report->processed_at != null and $report->solved_at == null and $report->user->ban != 2)
									<div class="col-md-2 d-flex align-items-center"><a class="btn btn-yellow"  href="{{url('/admin/report/completed/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
								@endif
							</div>
					@endforeach
                            @else
                            <hr>
                            <p class="my-3 mx-2">Nema prijava u procesu rješavanja.</p>
                        @endif
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-u_procesu" role="tabpanel" aria-labelledby="v-pills-u_procesu-tab">


						<div class="table">

                            <div class="d-flex row d-none d-sm-none d-md-flex">
                                <div class="col-2 d-none d-sm-flex font-weight-bold">Datum prijave</div>
                                <div class="col-2 d-none d-sm-flex font-weight-bold">Datum u procesu</div>
                                <div class="col-2 d-none d-sm-flex font-weight-bold">Datum rješenja</div>
                                <div class="col-4 d-none d-sm-flex font-weight-bold">Email</div>
                                <div class="col-2 d-none d-sm-flex font-weight-bold">Detalji</div>
                            </div>
<?php $count_p=0;?>
                            @foreach($reports as $report)
                                @if($report->processed_at != null and $report->solved_at == null and $report->user->ban != 2)
                                    <?php $count_p++ ?>
                                    @endif
                                @endforeach
                            @if($count_p!==0)
                            @foreach($reports as $report)

                                    @if($report->processed_at != null and $report->solved_at == null and $report->user->ban != 2)
                                    <hr>
                                    <div class="d-flex row">
                                        <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum prijave</div>
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->reported_at}}</div>
                                        <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum u procesu</div>
                                        @if ($report->processed_at !== NULL)
                                            <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->processed_at}}</div>
                                        @else
                                            <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                        @endif
                                        <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum rješenja</div>
                                        @if ($report->solved_at !== NULL)
                                            <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->solved_at}}</div>
                                        @else
                                            <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                        @endif
                                        <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Email</div>
                                        <div class="col-12 col-md-4 d-flex align-items-center p-3">{{$report->user->email}}</div>
                                        <div class="col-md-2 d-flex align-items-center"><a class="btn btn-yellow"  href="{{url('/admin/report/completed/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
                                    </div>
                                    @endif

                            @endforeach
                            @else
                                <hr>
                                <p class="my-3 mx-2">Nema prijava u procesu rješavanja.</p>
                            @endif
						</div>


				</div>
				<div class="tab-pane fade" id="v-pills-rijeseno" role="tabpanel" aria-labelledby="v-pills-rijeseno-tab">

					<div class="table">

                        <div class="d-flex row d-none d-sm-none d-md-flex">
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum prijave</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum u procesu</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum rješenja</div>
                            <div class="col-4 d-none d-sm-flex font-weight-bold">Email</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Detalji</div>
                        </div>
                        <?php $count_rijeseno=0;?>
                        @foreach($reports as $report)
                            @if($report->solved_at != null)
                                <?php $count_rijeseno++ ?>
                            @endif
                        @endforeach
                        @if($count_rijeseno!==0)
                        @foreach($reports as $report)

                                @if($report->solved_at != null)

                                <hr>
                                <div class="d-flex row">
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum prijave</div>
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->reported_at}}</div>
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum u procesu</div>
                                    @if ($report->processed_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->processed_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum rješenja</div>
                                    @if ($report->solved_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->solved_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Email</div>
                                    <div class="col-12 col-md-4 d-flex align-items-center p-3">{{$report->user->email}}</div>
                                    <div class="col-md-2 d-flex align-items-center"><a class="btn btn-green"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
                                </div>
                                @endif
                        @endforeach
                        @else
                            <hr>
                            <p class="my-3 mx-2">Nema rješenih prijava.</p>
                        @endif
					</div>

				</div>
				<div class="tab-pane fade" id="v-pills-prijavljeno" role="tabpanel" aria-labelledby="v-pills-prijavljeno-tab">

					<div class="table">

                        <div class="d-flex row d-none d-sm-none d-md-flex">
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum prijave</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum u procesu</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum rješenja</div>
                            <div class="col-4 d-none d-sm-flex font-weight-bold">Email</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Detalji</div>
                        </div>
                        <?php $count_prijavljeno=0;?>
                        @foreach($reports as $report)
                            @if($report->processed_at == null and $report->solved_at == null and $report->user->ban !== 2)
                                <?php $count_prijavljeno++ ?>
                            @endif
                        @endforeach
                        @if($count_prijavljeno!==0)
                        @foreach($reports as $report)

                                @if($report->processed_at == null and $report->solved_at == null  and $report->user->ban !== 2)

                                <hr>
                                <div class="d-flex row">
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum prijave</div>
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->reported_at}}</div>
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum u procesu</div>
                                    @if ($report->processed_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->processed_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum rješenja</div>
                                    @if ($report->solved_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->solved_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Email</div>
                                    <div class="col-12 col-md-4 d-flex align-items-center p-3">{{$report->user->email}}</div>
                                    <div class="col-md-2 d-flex align-items-center"><a class="btn btn-blue"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
                                </div>
                                @endif
                        @endforeach
                        @else
                            <hr>
                            <p class="my-3 mx-2">Nema prijava koje nisu u procesu rješavanja.</p>
                        @endif
					</div>

				</div>

				<div class="tab-pane fade" id="v-pills-banirani" role="tabpanel" aria-labelledby="v-pills-banirani-tab">

					<div class="table">

                        <div class="d-flex row d-none d-sm-none d-md-flex">
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum prijave</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum u procesu</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Datum rješenja</div>
                            <div class="col-4 d-none d-sm-flex font-weight-bold">Email</div>
                            <div class="col-2 d-none d-sm-flex font-weight-bold">Detalji</div>
                        </div>

                        <?php $count_ban=0;?>
                        @foreach($reports as $report)
                            @if($report->user->ban == 2)
                                <?php $count_ban++ ?>
                            @endif
                        @endforeach
                        @if($count_ban!==0)
                        @foreach($reports as $report)
                                @if($report->user->ban == 2)
                                <hr>
                                <div class="d-flex row">
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum prijave</div>
                                    <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->reported_at}}</div>
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum u procesu</div>
                                    @if ($report->processed_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->processed_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Datum rješenja</div>
                                    @if ($report->solved_at !== NULL)
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3">{{$report->solved_at}}</div>
                                    @else
                                        <div class="col-12 col-md-2 d-flex align-items-center p-3"><i class="fas fa-times"></i></div>
                                    @endif
                                    <div class="col-12 d-flex d-sm-flex d-md-none font-weight-bold">Email</div>
                                    <div class="col-12 col-md-4 d-flex align-items-center p-3">{{$report->user->email}}</div>
                                    <div class="col-md-2 d-flex align-items-center"><a class="btn btn-red"  href="{{url('/admin/report/'. $report->id)}}"><i class="fas fa-info"></i></a></div>
                                </div>
                                @endif

                        @endforeach
                        @else
                            <hr>
                            <p class="my-3 mx-2">Nema prijava blokiranih korisnika.</p>
                        @endif

				</div>


			</div>
		</div>
	</div>
    </div>

@endsection
