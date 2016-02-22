@extends('member/home')

@section('pagename', 'Kohteen tiedot')



@section('content')
    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">

			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:20%">Varaus alkaa</th>
			                      <th style="width:20%" class="hidden-phone">Varaus loppuu</th>
			                      <th style="width:20%" class="hidden-phone">Varaaja</th>
			                      <th style="width:30%" class="hidden-phone">Lisätiedot</th>
			                      <th style="width:10%" class="hidden-phone">Toimenpiteet</th>
			                    </tr>
			                  </thead>
			                  <tbody>

	@foreach ($target->reservations()->get()->sortBy('startdate') as $reservation) 

	
		                 
			                    <tr>

			                      <td>
			                        <span class="name">{{$reservation->startdate}}</span>
			                      </td>
			                      <td class="hidden-phone">{{$reservation->enddate}}</td>
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


    
@endsection


