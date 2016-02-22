@extends('member/home')

@section('pagename', 'Varattavissa olevat kohteet')



@section('content')



    <div class="col-md-12 col-sm-12 col-sx-12">
			          <div class="panel panel-default">

			            <div class="panel-body">
			              <div class="table-responsive">
			                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
			                  <thead>
			                    <tr>
			                      <th style="width:30%">Kohteen nimi</th>
			                      <th style="width:10%" class="hidden-phone">Vapaana</th>
			                      <th style="width:25%" class="hidden-phone">Seuraava varaus</th>
			                      <th style="width:25%" class="hidden-phone">Varaaja</th>
			                      <th style="width:10%" class="hidden-phone">Toimenpiteet</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  @foreach($targets as $target)
			                    <tr>
			                      <td>
			                        <span class="name">{{$target->name}}</span>
			                      </td>
			                      <td class="hidden-phone">

			                      @if($target->isFreeNow())
			                      <span class="label label label-success">Kyllä</span>
			                      @else
			                      <span class="label label label-danger">Ei</span>
			                      @endif

			                      </td>
			                      <td class="hidden-phone">
			                      <?php $r = $target->getNextReservation(); ?>
			                        @if($r)
			                        <p>{{date("d.m", strtotime($r->startdate))}} --> {{date("d.m", strtotime($r->enddate))}}</p>
			                        @else 
			                        <p><i>---</i></p>
			                        @endif
			                      </td>
			                      <td class="hidden-phone">
			                        @if($r)
			                        <p>{{$r->user->name}}</p>
			                        @else 
			                        <p><i>---</i></p>
			                        @endif			                      	

			                      </td>
			                      <td class="hidden-phone">
			                        <div class="btn-group">
			                          <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle">
			                            Action 
			                            <span class="caret">
			                            </span>
			                          </button>
			                          <ul class="dropdown-menu pull-right">
			                            <li>
			                               <a href="{{route('kohdeinfo', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}" data-original-title="">Avaa Info</a>
			                            </li>
			                            <li>
			                              <a href="{{route('tuhoakohde', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}" data-original-title="">Poista</a>
			                            </li>
			                          </ul>
			                        </div>
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