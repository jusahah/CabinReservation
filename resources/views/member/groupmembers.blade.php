@extends('member/home')

@section('pagename', 'Ryhmän jäsenet')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:40%">Nimi</th>
			                      <th style="width:10%" class="hidden-phone">Varausten lkm.</th>
			                      <th style="width:25%" class="hidden-phone">Edellinen varaus</th>
			                      <th style="width:25%" class="hidden-phone">Seuraava varaus</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  @foreach($members as $member)
			                    <tr>
			                      <td>
			                        <span class="name">{{$member->name}}</span>
			                      </td>
			                      <td class="hidden-phone">
			                     	{{$member->numberOfReservations()}}
			                      </td>
			                      <td class="hidden-phone">
			                       {{$member->previousReservationDate()}}
			                      </td>
			                      <td class="hidden-phone">
			                        {{$member->nextReservationDate()}}		                      	
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