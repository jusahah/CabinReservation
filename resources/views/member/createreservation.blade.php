@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('operationfail'))
    <p>{{Session::get('operationfail')}}</p>
@endif


<form method="POST" action="{{route('luovaraus', ['kohdeID' => $target->id])}}">
    {!! csrf_field() !!}

    <div>
        Start date
        <input type="text" name="startdate" value="{{ old('startdate') }}">
    </div>


    <div>
        End date
        <input type="text" name="enddate" value="{{ old('enddate') }}">
    </div>
    <div>
        Lisätietoja varauksesta
        <input type="text" name="notes" value="{{ old('notes') }}">
    </div>
    <div>
        <button type="submit">Tee varaus</button>
    </div>
</form>