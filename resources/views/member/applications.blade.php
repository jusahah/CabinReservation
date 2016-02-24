@extends('member/home')

@section('pagename', 'Jäsenhakemukset ryhmään')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			            @if (count($applicants) != 0)
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:30%" class="hidden-phone">Nimi</th>
			                      <th style="width:40%" class="hidden-phone">Email</th>
			                      <th style="width:20%" class="hidden-phone">Hakemus jätetty</th>
			                      <th style="width:10%" class="hidden-phone">Hyväksy</th>
			                    </tr>
			                  </thead>
			                  <tbody>

			                  @foreach($applicants as $applicant)
			                  	<tr>
			                  	<td>{{$applicant->name}}</td>
			                  	<td>{{$applicant->email}}</td>
			                  	<td>{{date('d.m.y', strtotime($applicant->created_at))}}</td>
			                  	<td><a class="btn btn-primary btn-xs" href="{{route('hyvaksyjasen', ['ryhmaID' => $global_ryhmaID, 'jasenID' => $applicant->id])}}">Hyväksy</a></td>

			                  	</tr>

			                  @endforeach


			                  </tbody>
			                </table>
			              </div>
			              @else
							<div class="alert alert-info">
								Ei avoimia hakemuksia!
							</div>			              	
			              @endif
			            </div>
			          </div>
			        </div>
@endsection