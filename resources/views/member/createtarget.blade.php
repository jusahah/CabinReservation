@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{route('luokohde')}}">
    {!! csrf_field() !!}

    <div>
        Nimi
        <input type="text" name="name" value="{{ old('name') }}">
    </div>


    <div>
        Kuvaus
        <input type="text" name="description" value="{{ old('description') }}">
    </div>

    <div>
        <button type="submit">Luo uusi varauskohde</button>
    </div>
</form>