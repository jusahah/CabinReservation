<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Varausmestari - kirjaudu sisään</title>
  
        <!-- Error CSS -->
        <link href="{{asset('css/login.css')}}" rel="stylesheet" media="screen">

        <!-- Animate CSS -->
        <link href="{{asset('css/animate.css')}}" rel="stylesheet" media="screen">

        <!-- Font Awesome -->
        <link href="{{asset('fonts/font-awesome.min.css')}}" rel="stylesheet">
    </head>
    <body>
   

    <div style="height: 180px;">
    <h1 class="animated flipInY" style="text-align: center; font-size: 54px; margin-bottom: 0px; width: 480px; margin: auto; margin-top: 24px;">Mökkivaraus.fi</h1>
    <h3 id="siellaneon" style="color: #F56B6B; text-align: center; font-size: 32px; line-height: 32px; margin-top: 0px; width: 380px; margin: auto;"></h3>
    </div>

    <p style="text-align: center; color: white;">Rekisteröidy ryhmän <i> {{$group->name}} </i> jäseneksi täyttämällä ja lähettämällä allaoleva lomake</p> 
        <form method="POST" action="{{route('hakemussisaan', ['ryhmaURINimi' => $ryhmaURINimi])}}">
            {!! csrf_field() !!}
            <input type="hidden" name="groupID" value="{{$group->id}}">
            <div id="box" class="" style="height: 470px;">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="background-color: #F56B6B; width: 320px; margin: auto;">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="top_header">

                    <h5>
                    <span style="color: #F56B6B; margin: 12px; font-size: 12px;">Ryhmä: {{$group->name}}</span>
                    </h5>
                </div>
                <div id="inputs">
                    <div class="form-control">
                 
                        <input type="text" placeholder="Käyttäjänimi" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-control">
                 
                        <input type="text" placeholder="Sähköpostiosoite" name="email" value="{{ old('email') }}">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="form-control">
     
                        <input type="password" placeholder="Salasana" name="password">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="form-control">
                    <input type="password" name="password_confirmation" placeholder="Vahvista salasana" >
                        <i class="fa fa-key"></i>
                    </div>
                    <input type="submit" value="Rekisteröidy">
                </div>

            </div>


        </form>

<div style="position: fixed; bottom: 0px; width: 100%;">
    <p style="color: white; font-size: 12px; text-align: center;">Copyright Nollaversio IT | 2016 | Proudly using Laravel 5.1.0</p>
</div>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var siella = document.getElementById('siellaneon');
                siella.innerHTML = 'Siellä ne mökit on.';
                siella.className = 'animated flipInX';
            }, 1500);

        });

        </script>
    </body>
</html>


