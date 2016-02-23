@extends('member/home')

@section('pagename', 'Varausloki')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:30%">Kohde</th>
			                      <th style="width:25%" class="hidden-phone">Varaaja</th>
			                      <th style="width:30%" class="hidden-phone">Ajankohta</th>
			                      <th style="width:15%" class="hidden-phone">Avaa info</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  @foreach($reservations as $reservation)
			                    <tr>
			                      <td>
			                        <span class="name">{{$reservation->target->name}}</span>
			                      </td>
			                      <td class="hidden-phone">
			                     	{{$reservation->user->name}}
			                      </td>
			                      <td class="hidden-phone">
			                      @if($reservation->startdate == $reservation->enddate)
			                      {{date("d.m.y", strtotime($reservation->startdate))}}
			                      @else
			                       {{date("d.m.y", strtotime($reservation->startdate)) . " - " . date("d.m.y", strtotime($reservation->enddate))}}
			                      @endif
			                      </td>
			                      <td class="hidden-phone">
			                        <a class="btn btn-primary" href="{{route('varausinfo', [
			                        	'ryhmaID' => $global_ryhmaID,
			                        	'kohdeID' => $reservation->target_id,
			                        	'varausID' => $reservation->id
			                        ])}}">Info</a>	                      	
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