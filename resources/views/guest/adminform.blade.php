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
   

    <div style="height: 150px;">
    <h1 class="animated flipInY" style="text-align: center; font-size: 54px; margin-bottom: 0px; width: 480px; margin: auto; margin-top: 24px;">Mökkivaraus.fi</h1>
    <h3 id="siellaneon" style="color: #F56B6B; text-align: center; font-size: 32px; line-height: 32px; margin-top: 0px; width: 380px; margin: auto;"></h3>
    </div>

    <p style="text-align: center; color: white;">Luo uusi ryhmä ja siihen liitettävä admin-käyttäjä</p> 
        <form method="POST" action="{{route('luoryhma')}}">
            {!! csrf_field() !!}
            <div id="box" class="" style="height: 640px; margin-top: -240px;">
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


                </div>
                <div id="inputs">
                    <h4 style="color: #222; text-align: center;">Adminin tiedot</h4>
                    <div class="form-control">
                 
                        <input type="text" placeholder="Admin-käyttäjänimi" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-control">
                 
                        <input type="text" placeholder="Sähköpostiosoite" name="email" value="{{ old('email') }}">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="form-control">
     
                        <input type="password" placeholder="Salasana (min. 4 merkkiä)" name="password">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="form-control">
                    <input type="password" name="password_confirmation" placeholder="Vahvista salasana" >
                        <i class="fa fa-key"></i>
                    </div>
                    <h4 style="color: #222; text-align: center;">Ryhmän tiedot</h4>
                    <div class="form-control">
                    <input type="text" name="ryhmanimi" placeholder="Ryhmän nimi (max. 64 merkkiä)" >

                    </div>
                    <div class="form-control">
                    <input type="text" name="ryhmakuvaus" placeholder="Ryhmän kuvaus (max. 512 merkkiä)" >
         
                    </div>                                        
                    <input type="submit" value="Luo ryhmä">
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
