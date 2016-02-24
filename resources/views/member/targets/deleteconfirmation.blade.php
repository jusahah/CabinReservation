@extends('member/home')

@section('pagename', 'Poistamisen vahvistus')



@section('content')

			        <div class="col-md-12 col-sm-12 col-xs-12">
			          <div class="panel panel-default">
			            <div class="panel-heading">
							<h4>Vahvista kohteen poisto</h4>
						</div>
			            <div class="panel-body">
			                <p><strong>Huomioi, että tätä toimenpidettä ei voi perua.</strong></p>

    <p>Huomioithan myös, että mikäli kohteeseen on varauksia olemassa, ne poistuvat automaattisesti poistaessasi kohteen.</p>
		<p>Suosittelemme poistoa vain mikäli kohde on luotu vahingossa esim. väärällä nimellä eikä siihen ole ehtinyt tulla varauksia.</p>
			              <form role="form" method="POST" action="{{route('tuhoakohdevahvistettu', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}">
			              	{!! csrf_field() !!}
			                <button type="submit" class="btn btn-danger">Vahvista poisto</button>
		
			              </form>
			            </div>
			          </div>
			        </div>


@endsection