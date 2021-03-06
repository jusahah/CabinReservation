@extends('member/home')

@section('pagename', 'Kohde: ' . $target->name)




@section('content')
<div class="row no-gutter">

    <div class="col-md-6 col-sm-12 col-sx-12">
    <div class="row no-gutter">
	    <div class="col-md-12 col-sm-12 col-sx-12">
				          <div class="panel panel-default">

				            <div class="panel-body">
				              <div class="list-group no-margin">

				                <a href="#" class="list-group-item">
				                  <h4 class="list-group-item-heading">Kuvaus</h4>
				                  <p class="list-group-item-text">{{$target->description}}</p>
				                </a>

				              </div>			            	

				            </div>
				            </div>
		</div>	
    	<div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="list-group no-margin">

			                <a href="#" class="list-group-item">
			                  <h4 class="list-group-item-heading">Tilastot</h4>
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:60%"></th>
			                      <th style="width:40%" class="hidden-phone"></th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	<tr>
				                  	<td>
				                  		Varauksia yht.
				                  	</td>
				                  	<td>
				                  		{{$target->numOfReservations()}} kpl
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Eniten varannut (määrä)
				                  	</td>
				                  	<td>
				                  		{{$target->infoMostActiveReserverInCount()}}
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Eniten varannut (päivissä)
				                  	</td>
				                  	<td>
				                  		{{$target->infoMostActiveReserverInDays()}}
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Varauksia odottamassa
				                  	</td>
				                  	<td>
				                  		{{$target->numOfReservationsPending()}} kpl
				                  	</td>
			                  	</tr>				                    

			                  </tbody>
			                </table>
			              </div>
			                 
			                </a>

			              </div>			            	

			            </div>
			            </div>
			            </div>	

	</div> 
	</div>
    <div class="col-md-6 col-sm-12 col-sx-12">
    <div class="row no-gutter">
    	<div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="list-group no-margin">

			                <a href="#" class="list-group-item">
			                <h4 class="list-group-item-heading">Asetukset</h4>
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:70%"></th>
			                      <th style="width:30%" class="hidden-phone"></th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	<tr>
				                  	<td>
				                  		Yksi varaus kerrallaan / käyttäjä
				                  	</td>
				                  	<td>
				                  	@if($target->allowTwoReservationsBySameUser == 0)
				                  		<span class="label label-danger">Pois päältä</span>
				                  	@else
				                  		<span class="label label-success">Päällä</span>
				                  	@endif	
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Varauksen minimikesto
				                  	</td>
				                  	<td>
				                  		{{$target->minReservationLength}} päivää
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Varauksen maksimikesto
				                  	</td>
				                  	<td>
				                  		{{$target->maxReservationLength}} päivää
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Email kun kohde varataan
				                  	</td>
				                  	<td>
				                  	@if($target->emailWhenSomebodyReserves == 0)
				                  		Ei kellekään
				                  	@elseif($target->emailWhenSomebodyReserves == 1)
				                  		Vain adminille
				                  	@else
				                  		Koko ryhmälle
				                  	@endif			
				                  	</td>
			                  	</tr>				                    
			                  	<tr>
				                  	<td>
				                  		Email kun varaus perutaan
				                  	</td>
				                  	<td>
				                  	@if($target->emailWhenSomebodyCancels == 0)
				                  		Ei kellekään
				                  	@elseif($target->emailWhenSomebodyCancels == 1)
				                  		Vain adminille
				                  	@else
				                  		Koko ryhmälle
				                  	@endif		
				                  	</td>
			                  	</tr>	
			                  	<!--
			                  	<tr>
				                  	<td>
				                  		Email kun info-viesti julkaistaan
				                  	</td>
				                  	<td>
				                  		Ei kellekään
				                  	</td>
			                  	</tr>
			                  	-->

			                  </tbody>
			                </table>
			              </div>			                  
			                </a>

			              </div>	
			              @if($isAdmin)		            	
			            <hr>
			            	<a href="{{route('muokkaakohdetta', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}" class="btn btn-primary">Muuta asetuksia</a>
			            @endif
			            
	
			            </div>

			            </div>
			            </div>
	</div>	
		            		            
</div>
</div>

<div class="row no-gutter">
    <div class="col-md-12 col-sm-12 col-sx-12">

			          <div class="panel panel-default">

			            <div class="panel-body">
			            <h4 class="list-group-item-heading">Varaukset</h4>
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:15%">Alkaa</th>
			                      <th style="width:15%" class="hidden-phone">Loppuu</th>
			                      <th style="width:30%" class="hidden-phone">Varaaja</th>
			                      <th style="width:30%" class="hidden-phone">Lisätiedot</th>
			                      <th style="width:10%" class="hidden-phone">Toimenpiteet</th>
			                    </tr>
			                  </thead>
			                  <tbody>

	@foreach ($target->reservations()->get()->sortBy('startdate') as $reservation) 

	
		                 
			                    <tr>

			                      <td>
			                        <span class="name">{{date('d.m.y', strtotime($reservation->startdate))}}</span>
			                      </td>
			                      <td class="hidden-phone">{{date('d.m.y', strtotime($reservation->enddate))}}</td>
			                      <td class="hidden-phone">
			                       {{$reservation->user->name}}
			                      </td>
			                      <td class="hidden-phone">{{$reservation->getNotesTrimmed(36)}}</td>
			                      <td class="hidden-phone">
			                      	@if($isAdmin)
			                        <a href="{{route('tuhoavaraus', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id, 'varausID' => $reservation->id])}}" class="btn btn-danger">Poista</a>
			                      	@elseif($me == $reservation->user->id && $reservation->canStillBeCancelled())
			                      	<a href="{{route('peruvaraus', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id, 'varausID' => $reservation->id])}}" class="btn btn-danger">Peru</a>
			                      	@endif

			                      </td>
			                    </tr>


@endforeach					                    

			                  </tbody>
			                </table>
			              </div>
			              </div>
			              </div>
			              </div>
			              </div>


    
@endsection


