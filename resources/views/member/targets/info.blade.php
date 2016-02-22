@extends('member/home')

@section('pagename', 'Kohde: ' . $target->name)



@section('content')
<div class="row no-gutter">

    <div class="col-md-6 col-sm-12 col-sx-12">
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
    <div class="col-md-6 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="list-group no-margin">

			                <a href="#" class="list-group-item">
			                <h4 class="list-group-item-heading">Asetukset</h4>
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:70%">Asetus</th>
			                      <th style="width:30%" class="hidden-phone">Arvo</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  	<tr>
				                  	<td>
				                  		Yksi varaus kerrallaan / käyttäjä
				                  	</td>
				                  	<td>
				                  		<span class="label label-success">Kyllä</span>
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Varauksen minimikesto (päivissä)
				                  	</td>
				                  	<td>
				                  		2
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Varauksen maksimikesto (päivissä)
				                  	</td>
				                  	<td>
				                  		5
				                  	</td>
			                  	</tr>
			                  	<tr>
				                  	<td>
				                  		Email kun kohde varataan
				                  	</td>
				                  	<td>
				                  		Kaikille
				                  	</td>
			                  	</tr>				                    
			                  	<tr>
				                  	<td>
				                  		Email kun varaus perutaan
				                  	</td>
				                  	<td>
				                  		Ei kellekään
				                  	</td>
			                  	</tr>	
			                  	<tr>
				                  	<td>
				                  		Email kun info-viesti julkaistaan
				                  	</td>
				                  	<td>
				                  		Ei kellekään
				                  	</td>
			                  	</tr>

			                  </tbody>
			                </table>
			              </div>			                  
			                </a>

			              </div>			            	
			            <hr>
			            	<a href="{{route('muokkaakohdetta', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}" class="btn btn-primary">Muuta asetuksia</a>
			            
			            
	
			            </div>

			            </div>
			            </div>				            		            
</div>


<div class="row no-gutter">
    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">

			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:15%">Varaus alkaa</th>
			                      <th style="width:15%" class="hidden-phone">Varaus loppuu</th>
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
			                        <a href="{{route('tuhoavaraus', ['kohdeID' => $target->id, 'varausID' => $reservation->id])}}" class="btn btn-danger">Poista</a>
			                      	@elseif($me == $reservation->user->id)
			                      	<a href="{{route('peruvaraus', ['kohdeID' => $target->id, 'varausID' => $reservation->id])}}" class="btn btn-danger">Peru</a>
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


