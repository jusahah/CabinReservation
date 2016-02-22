@extends('member/home')

@section('pagename', 'Luo uusi kohde')



@section('content')
<div class="row no-gutter">
<div class="col-md-12 col-sm-12 col-xs-12">
    <form method="POST" action="{{route('luokohde', ['ryhmaID' => $global_ryhmaID])}}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="exampleInputEmail1">Kohteen nimi</label>
            
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Kohteen kuvaus</label>
           
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <hr>
        <div class="form-group">
            <label for="exampleInputEmail1">Voiko käyttäjällä olla useampi varaus kerrallaan?</label>
            <select name='allowTwoReservationsBySameUser' class="form-control input-lg" name="emailWhenSomebodyCancels">
                <option value="1">Kyllä</option>
                <option value="0">Ei</option>

            </select>
        </div>          
        <div class="form-group">
            <label for="exampleInputEmail1">Sähköposti-ilmoitus varauksesta?</label>
            <p>Jos valitset vaihdoehdon "Kaikille jäsenille", sähköposti-ilmoitus lähetetään kaikille ryhmän jäsenille, jotka
            ovat sallineet sähköposti-ilmoitusten vastaanoton.</p>

            <select class="form-control input-lg" name="emailWhenSomebodyCancels">
                <option value="2">Kaikille jäsenille</option>
                <option value="1">Vain Adminille</option>
                <option value="0">Ei kellekään</option>
            </select>


        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Sähköposti-ilmoitus varauksen perumisesta?</label>
            <p>Jos valitset vaihdoehdon "Kaikille jäsenille", sähköposti-ilmoitus lähetetään kaikille ryhmän jäsenille, jotka
            ovat sallineet sähköposti-ilmoitusten vastaanoton.</p>

            <select class="form-control input-lg" name="emailWhenSomebodyCancels">
                <option value="2">Kaikille jäsenille</option>
                <option value="1">Vain Adminille</option>
                <option value="0">Ei kellekään</option>
            </select>


        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Sähköposti-ilmoitus info-viestistä?</label>
            <p>Jos valitset vaihdoehdon "Kaikille jäsenille", sähköposti-ilmoitus lähetetään kaikille ryhmän jäsenille, jotka
            ovat sallineet sähköposti-ilmoitusten vastaanoton.</p>

            <select class="form-control input-lg" name="emailWhenGeneralAnnouncement">
                <option value="2">Kaikille jäsenille</option>
                <option value="1">Vain Adminille</option>
                <option value="0">Ei kellekään</option>
            </select>


        </div>
        <hr>
        <div class="form-group">
            <label for="exampleInputEmail1">Varauksen minimikesto (päivissä)?</label>
            <input type="number" name="minReservationLength" class="form-control" value="{{ old('minReservationLength') }}">


        </div>      
        <div class="form-group">
            <label for="exampleInputEmail1">Varauksen maksimikesto (päivissä)?</label>
            <input type="number" name="maxReservationLength" class="form-control" value="{{ old('maxReservationLength') }}">

        </div>               
        <div>
            <button type="submit" class="btn btn-primary">Luo uusi varauskohde</button>
        </div>
    </form>

    
</div>
</div>

@endsection