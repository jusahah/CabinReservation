@extends('member/home')

@section('pagename', 'Varaus 2/2 - Valitse päivämäärät')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			            				              <div class="list-group no-margin">

				 
				                  <h4 class="list-group-item-heading">Valittu kohde: {{$target->name}}</h4>
				                  
				             

				              </div>	
			             
			            </div>
			          </div>
			        <div class="row no-gutter">
			          <div class="col-md-4 col-sm-6 col-sx-12">
			          <div class="panel panel-green">
									<div class="panel-heading">

										<div class="alert alert-danger" id="javascriptoff">Javascript-tuki vaaditaan!</div>
										<ul class="links">
											<li>
		
											</li>
										</ul>
									</div>
									<div class="panel-body">
										<div id='calendar' style="width: 400px; height: 400px;"></div>
									</div>
								</div>
			        </div>
			          <div class="col-md-8 col-sm-6 col-sx-12">
			          <div class="panel panel-green">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<form method="POST" action="{{route('luokohde', ['ryhmaID' => $global_ryhmaID])}}">
								        {!! csrf_field() !!}
								        <p><i>Voit lisätä päivämäärät joko kirjoittamalla ne muodossa '2016-01-01' tai klikkaamalla kalenterista!</i></p>
								        <div class="form-group">
								            <label for="exampleInputEmail1">Alkaa (pvm)</label>
								            
								            <input type="text" name="name" placeholder="2015-01-01" class="form-control">
								        </div>

								        <div class="form-group">
								            <label for="exampleInputEmail1">Loppuu (pvm)</label>
								           
								            <input type="text" name="description" class="form-control" placeholder="2015-01-02">
								        </div>
								        <hr>
								        <div class="form-group">
								            <label for="exampleInputEmail1">Lisätiedot muille ryhmän jäsenille (max. 512 merkkiä)</label>
								            <textarea name='notes' class="form-control input-lg"></textarea>
								        </div>          
             							<p><i>Ennen varauksen vahvistamista, tarkistathan vielä, että päivämäärät ovat oikein. Varaus ei mene lävitse jos
             							päivämäärät ovat väärät (esim. sisältävät päiviä, jotka joku toinen on jo varannut).</i></p>
								        <div>
								            <button type="submit" class="btn btn-primary">Vahvista uusi varaus</button>
								        </div>
								    </form>
									</div>
								</div>
			        </div>			        
			        </div>
			        </div>
@endsection


@section('customJS')

<script>

	$(document).ready(function() {

		$('#javascriptoff').hide();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2016-01-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
			@foreach ($target->reservations as $reservation)

				{
					title: '{{$reservation->user->name}}',
					start: '{{$reservation->startdate}}',
					end: '{{$reservation->enddate}}',
					url: '{{route("varausinfo", ["ryhmaID" => $global_ryhmaID, "kohdeID" => $target->id, "varausID" => $reservation->id])}}',
				},


			@endforeach

				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-01-28'
				}
			]
		});
		
	});

</script>



@endsection