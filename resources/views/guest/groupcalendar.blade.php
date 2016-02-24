<!DOCTYPE html>
<html>


<head>
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
		<link href="{{asset('css/fullcalendar.css')}}" rel="stylesheet">

		<!-- Font Awesome -->
		<link href="{{asset('fonts/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="row no-gutter">
    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel">
									<div class="panel-heading">

										<div class="alert alert-danger" id="javascriptoff">Javascript-tuki vaaditaan!</div>

									</div>
									<div class="panel-body">
										<h3 style="text-align: center;">{{$group->name}}</h3>
										<p style="text-align: center;">{{$group->description}}</p>
										<hr>
										<div id='calendar' style="margin: auto; max-width: 960px; max-height: 960px;"></div>
										<hr style="width: 30%;">
										<p style="text-align: center;"><i>Tämä on vieraille tarkoitettu näkymä kalenteriin. Jos haluat tehdä/muokata varauksia,
										sinun täytyy olla <a href="{{url('auth/login')}}">kirjautuneena palveluun</a> ja hyväksytty kohteen jäseneksi. Vain ryhmän jäsenet voivat
										tehdä varauksia.</i></p>
									</div>
					  </div>   
	</div>
</div>

		<script src="{{asset('js/jquery.js')}}"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<!-- Flot Charts 
		<script src="js/flot/jquery.flot.js"></script>
		<script src="js/flot/jquery.flot.time.js"></script>
		<script src="js/flot/jquery.flot.selection.js"></script>
		<script src="js/flot/jquery.flot.resize.js"></script>
		<script src="js/flot/jquery.flot.tooltip.js"></script>
		<script src="js/flot/flot.excanvas.min.js"></script>
		-->

		<script src="{{asset('js/calendar/fullcalendar.min.js')}}"></script>


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
			defaultDate: '2016-01-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventColor: '#354051',			
			events: [
			@foreach ($reservations as $reservation)

				{
					title: hideReserverNames && ('{{$reservation->startdate}}' === '{{$reservation->enddate}}') ? '{{$reservation->target->name}}'.substring(0,3) : '{{$reservation->target->name}} ({{$reservation->user->name}})',
					start: '{{$reservation->startdate}}',
					end: '{{$reservation->enddate}}',
					
				},


			@endforeach


			]
		});
		
	});

</script>
</body>
</html>