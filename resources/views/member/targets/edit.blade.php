@extends('member/home')

@section('pagename', 'Muokkaa kohteen asetuksia')



@section('content')



<div class="row no-gutter">
<div class="col-md-12 col-sm-12 col-xs-12">

    <form method="POST" action="{{route('vahvistakohteenmuokkaus', ['ryhmaID' => $global_ryhmaID, 'kohdeID' => $target->id])}}">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="put" />

        <div class="form-group">
            <label for="exampleInputEmail1">Kohteen nimi</label>
            
            <input type="text" name="name" class="form-control" value="{{$target->name}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Kohteen kuvaus</label>
           
            <input type="text" name="description" class="form-control" value="{{$target->description}}">
        </div>
        <hr>
        <div class="form-group">
            <label for="exampleInputEmail1">Voiko käyttäjällä olla useampi varaus kerrallaan?</label>
            <select name='allowTwoReservationsBySameUser' class="form-control input-lg">
                <option value="1" @if($target->allowTwoReservationsBySameUser == 1) selected="selected" @endif>Kyllä</option>
                <option value="0" @if($target->allowTwoReservationsBySameUser == 0) selected="selected" @endif>Ei</option>

            </select>
        </div>          
        <div class="form-group">
            <label for="exampleInputEmail1">Sähköposti-ilmoitus varauksesta?</label>
            <p>Jos valitset vaihdoehdon "Kaikille jäsenille", sähköposti-ilmoitus lähetetään kaikille ryhmän jäsenille, jotka
            ovat sallineet sähköposti-ilmoitusten vastaanoton.</p>

            <select class="form-control input-lg" name="emailWhenSomebodyReserves">

                <option value="2" @if($target->emailWhenSomebodyReserves == 2) selected="selected" @endif>Kaikille jäsenille</option>
                <option value="1" @if($target->emailWhenSomebodyReserves == 1) selected="selected" @endif>Vain Adminille</option>
                <option value="0" @if($target->emailWhenSomebodyReserves == 0) selected="selected" @endif>Ei kellekään</option>
            </select>


        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Sähköposti-ilmoitus varauksen perumisesta?</label>
            <p>Jos valitset vaihdoehdon "Kaikille jäsenille", sähköposti-ilmoitus lähetetään kaikille ryhmän jäsenille, jotka
            ovat sallineet sähköposti-ilmoitusten vastaanoton.</p>

            <select class="form-control input-lg" name="emailWhenSomebodyCancels">
                <option value="2" @if($target->emailWhenSomebodyCancels == 2) selected="selected" @endif>Kaikille jäsenille</option>
                <option value="1" @if($target->emailWhenSomebodyCancels == 1) selected="selected" @endif>Vain Adminille</option>
                <option value="0" @if($target->emailWhenSomebodyCancels == 0) selected="selected" @endif>Ei kellekään</option>
            </select>


        </div>

        <hr>
        <div class="form-group">
            <label for="exampleInputEmail1">Varauksen minimikesto (päivissä)?</label>
            <input type="number" name="minReservationLength" class="form-control" value="{{$target->minReservationLength}}">


        </div>      
        <div class="form-group">
            <label for="exampleInputEmail1">Varauksen maksimikesto (päivissä)?</label>
            <input type="number" name="maxReservationLength" class="form-control" value="{{$target->maxReservationLength}}">

        </div>               
        <div>
            <button type="submit" class="btn btn-primary">Päivitä asetukset</button>
        </div>
    </form>

    
</div>
</div>

@endsection