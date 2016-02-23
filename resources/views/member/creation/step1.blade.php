@extends('member/home')

@section('pagename', 'Varaus 1/2 - Valitse kohde')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:70%"></th>
			                      <th style="width:30%" class="hidden-phone"></th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  @foreach($targets as $target)
			                    <tr>
			                      <td>
			                        <span class="name">{{$target->name}}</span>
			                      </td>
			                      <td class="hidden-phone">
			                      <a class="btn btn-primary btn-xs" href="{{route('varausvaihe2', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}">Valitse</a>
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