@extends('member/home')

@section('pagename', 'Kutsu jäsen')




@section('content')
<div class="row no-gutter">

    <div class="col-md-12 col-sm-12 col-sx-12">
            <div class="form-group">
            <label for="exampleInputEmail1"> Kopioi linkki alta leikepöydällesi!</label>
           
            <input type="text" placeholder="Kutsulinkin pitäisi näkyä tässä" class="form-control" value="{{$group->getInvitationLink()}}">
        </div>

        <hr>
        <h3>Käyttöohjeet</h3>
        <p>Kopioituasi ylläolevan linkin lähetä se sähköpostilla haluamallesi henkilölle. Hän voi jättää liittymishakemuksen ryhmäsi jäseneksi linkkiä seuraamalla.
       Linkki <u>ei</u> ole yksilöllinen. Jaa linkki ainoastaan niille tahoille, jotka haluat kutsua ryhmäsi jäseniksi!</p>
        <p><strong>HUOM! Jäsenen vahvistus vaaditaan!</strong> Huomioithan, että ennen kuin uusi jäsen pystyy tekemään varauksia, on ryhmän adminin (eli sinun) hyväksyttävä hänen jäsenhakemuksensa. 
        Avoimet jäsenhakemukset näet sivuvalikosta kohdasta <a href="{{route('jasenhakemukset', ['ryhmaID' => $global_ryhmaID])}}">Jäsenhakemukset</a>. Kutsumasi henkilön hakemus ilmestyy "Jäsenhakemukset"-listaan hänen täytettyään liittymislomakkeen.</p>
    </div>

</div>



    
@endsection





