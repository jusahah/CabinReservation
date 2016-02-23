@extends('member/home')

@section('pagename', 'Varauskalenteri | ' . $target->name)



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">

			        <div class="row no-gutter">
			          <div class="col-md-7 col-sm-7 col-sx-12">
			          <div class="panel">
									<div class="panel-heading">

										<div class="alert alert-danger" id="javascriptoff">Javascript-tuki vaaditaan!</div>
										<ul class="links">
											<li>
		
											</li>
										</ul>
									</div>
									<div class="panel-body">
										<div id='calendar' style="margin: auto;"></div>
									</div>
								</div>
			        </div>
			          <div class="col-md-5 col-sm-5 col-sx-12">
			          <div class="panel">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<form method="POST" action="{{route('luovaraus', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}">
								        {!! csrf_field() !!}
								        <p><i>Voit lisätä päivämäärät joko kirjoittamalla ne muodossa '31.12.2015' tai klikkaamalla kalenterista!</i></p>
								        <div id="alkuunBlock" class="form-group">
								            <label for="exampleInputEmail1">Alkaa (pvm)</label>
								            
								            <input type="text" id="startdate_input" name="startdate" placeholder="01.01.2016" class="form-control">
								        </div>

								        <div id="loppuunBlock" class="form-group">
								            <label for="exampleInputEmail1">Loppuu (pvm)</label>
								           
								            <input type="text" id="enddate_input" name="enddate" class="form-control" placeholder="05.01.2016">
								        </div>
								        <hr>
								        <div id="notesBlock" class="form-group has-success">
								            <label for="exampleInputEmail1">Lisätiedot muille ryhmän jäsenille (max. 512 merkkiä)</label>
								            <textarea name='notes' id="notesArea" rows="4" class="form-control input-lg" style="font-size: 14px;"></textarea>
								        </div>          
             							<p><i>Ennen varauksen vahvistamista, tarkistathan vielä, että päivämäärät ovat oikein. Varaus ei mene lävitse jos
             							päivämäärät ovat väärät (esim. sisältävät päiviä, jotka eivät ole vapaina).</i></p>
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

	var alkuunDate;
	var loppuunDate;

	var alkuunCell;
	var loppuunCell;

	function validateTextarea() {
		console.log("VALIDATING NOTES INPUT");
		var text = $('#notesArea').val();

		if (text.length > 512) {
			$('#notesBlock').removeClass('has-warning has-success').addClass('has-error');
		} else {
			$('#notesBlock').removeClass('has-warning has-error').addClass('has-success');
		}
	}

	function setAlkuun(date, cell) {
		alkuunDate = date;
		alkuunCell = cell;
		$('#startdate_input').val(date);
		$('#alkuunBlock').removeClass('has-warning has-error').addClass('has-success');
		alkuunCell.css('background-color', '#85C754');
	}
	function setLoppuun(date, cell) {
		loppuunDate = date;
		loppuunCell = cell;
		$('#enddate_input').val(date);
		$('#loppuunBlock').removeClass('has-warning has-error').addClass('has-success');
		loppuunCell.css('background-color', '#85C754');

	}

	function emptyBoth() {
		alkuunDate = undefined;
		loppuunDate = undefined;
		$('#startdate_input').val('');
		$('#enddate_input').val('');
		$('#alkuunBlock').removeClass('has-warning has-error has-success');		
		$('#loppuunBlock').removeClass('has-warning has-error has-success');

		if (alkuunCell) {
			alkuunCell.css('background-color', 'white');
			alkuunCell = null;
		}
		if (loppuunCell) {
			loppuunCell.css('background-color', 'white');
			loppuunCell = null;
		}
	}

	function validateAll() {
		var alkuun = $('#startdate_input').val();
		var loppuun = $('#enddate_input').val();

		var alkuunOsat = alkuun.split('.');
		var loppuunOsat = loppuun.split('.');

		if (!alkuun || alkuun.trim() === '') return;
		if (!loppuun || loppuun.trim() === '') return;

		console.log(alkuunOsat);
		console.log(loppuunOsat);

		var alkuunO = new Date(alkuunOsat[2], alkuunOsat[1], alkuunOsat[0]);
		var loppuunO = new Date(loppuunOsat[2], loppuunOsat[1], loppuunOsat[0]);

		console.log(alkuunO);
		console.log(loppuunO);

		if (loppuunO < alkuunO) {
			$('#alkuunBlock').removeClass('has-warning has-error has-success').addClass('has-warning');		
			$('#loppuunBlock').removeClass('has-warning has-error has-success').addClass('has-warning');
			alkuunCell.css('background-color', '#F38733');			
			loppuunCell.css('background-color', '#F38733');			

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
			setAlkuun(dateText, $(this));
		}
		else if (!loppuunDate) {
			console.log("Setting loppuun");
			setLoppuun(dateText, $(this));
		}
		else {
			emptyBoth();
			setAlkuun(dateText, $(this));
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
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventColor: '#354051',
			events: [
			@foreach ($target->reservations as $reservation)

				{
					title: hideReserverNames && ('{{$reservation->startdate}}' === '{{$reservation->enddate}}') ? '{{$reservation->user->name}}'.substring(0,3) : '{{$reservation->user->name}}',
					start: '{{$reservation->startdate}}',
					end: '{{$reservation->enddate}}',
					url: '{{route("varausinfo", ["ryhmaID" => $global_ryhmaID, "kohdeID" => $target->id, "varausID" => $reservation->id])}}',
				},


			@endforeach


			]
		});
		
	});

</script>



@endsection