@extends('member/home')

@section('pagename', 'Varauksen tiedot')



@section('content')
<div class="row no-gutter">
    <div class="col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-body">
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <tbody>
			                    <tr>
			                      <td>
			                        <span class="name"><strong>Varauksen kohde</span>
			                      </td>
			                      <td>
			                        <span class="name"><a href="{{route('kohdeinfo', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $reservation->target->id])}}">{{$reservation->target->name}}</a></span>
			                      </td>
			                    </tr>
			                    <tr>
			                      <td>
			                        <span class="name"><strong>Varaaja</strong></span>
			                      </td>
			                      <td>
			                        <span class="name">{{$reservation->user->name}}</span>
			                      </td>
			                    </tr>

			                    <tr>
			                      <td>
			                        <span class="name"><strong>Alkaa</strong></span>
			                      </td>
			                      <td>
			                        <span class="name">{{date('l, d.m.y', strtotime($reservation->startdate))}}</span>
			                      </td>
			                    </tr>

			                    <tr>
			                      <td>
			                        <span class="name"><strong>Loppuu</strong></span>
			                      </td>
			                      <td>
			                        <span class="name">{{date('l, d.m.y', strtotime($reservation->enddate))}}</span>
			                      </td>
			                    </tr>

			                    <tr>
			                      <td>
			                        <span class="name"><strong>Varauksen kesto</strong></span>
			                      </td>
			                      <td>
			                        <span class="name">{{$reservation->getDurationInDays()}} päivää</span>
			                      </td>
			                    </tr>

			                    <tr>
			                      <td>
			                        <span class="name"><strong>Lisätiedot varauksesta</strong></span>
			                      </td>
			                      <td>
			                        <span class="name">{{$reservation->notes}}</span>
			                      </td>
			                    </tr>	





			                  </tbody>
			                </table>
			              </div>



			</div>
		</div>
	</div>
</div>



    
@endsection
