@extends('member/home')

@section('pagename', 'Ryhmän etusivu | ' . $targetgroupname)



@section('content')


<div class="row no-gutter">
    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel">
									<div class="panel-heading">

										<div class="alert alert-danger" id="javascriptoff">Javascript-tuki vaaditaan!</div>
										<ul class="links">
											<li>
											</li>
										</ul>
									</div>
									<div class="panel-body">
												<p><span class="label label-danger">HUOMIO!</span> Kalenteri näyttää kaikkien ryhmän kohteiden kaikki varaukset! Jos haluat tarkastella yksittäisen kohteen varaustilannetta, aloita sivuvalikon linkistä <i>Kohdeluettelo</i></p>

										<div id='calendar' style="margin: auto;"></div>
									</div>
					  </div>   
	</div>
</div>
@endsection


@section('customJS')

<script>

	var alkuunDate;
	var loppuunDate;

	function validateTextarea() {
		console.log("VALIDATING NOTES INPUT");
		var text = $('#notesArea').val();

		if (text.length > 512) {
			$('#notesBlock').removeClass('has-warning has-success').addClass('has-error');
		} else {
			$('#notesBlock').removeClass('has-warning has-error').addClass('has-success');
		}
	}

	function setAlkuun(date) {
		alkuunDate = date;
		$('#startdate_input').val(date);
		$('#alkuunBlock').removeClass('has-warning has-error').addClass('has-success');
	}
	function setLoppuun(date) {
		loppuunDate = date;
		$('#enddate_input').val(date);
		$('#loppuunBlock').removeClass('has-warning has-error').addClass('has-success');

	}

	function emptyBoth() {
		alkuunDate = undefined;
		loppuunDate = undefined;
		$('#startdate_input').val('');
		$('#enddate_input').val('');
		$('#alkuunBlock').removeClass('has-warning has-error has-success');		
		$('#loppuunBlock').removeClass('has-warning has-error has-success');
	}

	function validateAll() {
		var alkuun = $('#startdate_input').val();
		var loppuun = $('#enddate_input').val();

		if (!alkuun || alkuun.trim() === '') return;
		if (!loppuun || loppuun.trim() === '') return;

		if (loppuun < alkuun) {
			alert("Alkaa-päivämäärä ei voi tulla Loppuu-päivämäärän jälkeen!");
			emptyBoth();
		}
	}

	function dayClicked(date) {

		var dateO = new Date(date);

		var month = dateO.getMonth()+1;
		var day   = dateO.getDate();

		month = month < 10 ? "0" + month : month;
		day   = day < 10 ? "0" + day : day;
		var dateText = day + "." + month + "." + dateO.getFullYear();

		if (!alkuunDate) {
			setAlkuun(dateText);
		}
		else if (!loppuunDate) {
			console.log("Setting loppuun");
			setLoppuun(dateText);
		}
		else {
			emptyBoth();
			setAlkuun(dateText);
		}
		
		validateAll();

	}

	$(document).ready(function() {

		$('#notesBlock').on('change', validateTextarea);
		var hideReserverNames = $('#calendar').width() < 360;
		console.log($('#calendar').width());

	

		$('#javascriptoff').hide();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month'
			},
			allDayDefault: true,
			dayClick: dayClicked,
			defaultDate: '2016-01-12',
			firstDay: 1,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventColor: '#354051',			
			events: [
			@foreach ($reservations as $reservation)

				{
					title: hideReserverNames && ('{{$reservation->startdate}}' === '{{$reservation->enddate}}') ? '{{$reservation->target->name}}'.substring(0,3) : '{{$reservation->target->name}}',
					start: '{{$reservation->startdate}}',
					end: '{{$reservation->enddate}}',
					url: '{{route("varausinfo", ["ryhmaID" => $global_ryhmaID, "kohdeID" => $reservation->target->id, "varausID" => $reservation->id])}}',
				},


			@endforeach


			]
		});
		
	});

</script>
@endsection