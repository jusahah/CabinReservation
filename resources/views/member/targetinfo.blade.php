<h3>TArget info</h3>

<p>{{$target->description}}</p>

<h4>Reservations</h4>
<ul>
@foreach ($target->reservations()->get()->sortBy('startdate') as $reservation) 
	<li>{{$reservation->user->name}} | {{$reservation->startdate}} -> {{$reservation->enddate}}

	@if ($me == $reservation->user->id)
		<a href="{{route('peruvaraus', ['kohdeID' => $target->id, 'varausID' => $reservation->id])}}">Peru Varaus</a>
	@endif

	</li>
	
@endforeach

</ul>