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
   


    <h1 class="animated flipInX" style="text-align: center; font-size: 54px; margin-bottom: 0px;">Mökkivaraus.fi</h1>
    <h3 id="siellaneon" style="color: #F56B6B; text-align: center; font-size: 32px; line-height: 32px; margin-top: 0px; width: 380px; margin: auto;"></h3>


        <form id="wrapper" method="POST" action="{{route('login')}}">
            {!! csrf_field() !!}

            <div id="box" class="animated bounceIn" style="margin-top: -240px;">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="background-color: #F56B6B; width: 320px; margin: auto;">
                        <ul style="list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('operationsuccess'))
                            <div class="alert alert-success">
                            <div class="alert-body">
                            <p>{{Session::get('operationsuccess')}}</p>
                            </div>
                            </div>
                @endif  
                <div id="top_header">

                    <h5>
                        Vaatii kirjautumisen
                    </h5>
                </div>
                <div id="inputs">
                    <div class="form-control">
                        <input type="text" placeholder="Sähköpostiosoitteesi" name="email" value="{{ old('email') }}">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="form-control">
                        <input type="password" name="password" placeholder="Salasanasi">
                        <i class="fa fa-key"></i>
                    </div>
                    <input type="submit" value="Kirjaudu">
                    <hr style="width: 30%;">
                    <a class="button btn btn-primary" href="{{route('uusiadmin')}}" style="text-align: center; display: block; margin: auto; width: 220px; background-color: #F56B6B; color: white; padding: 6px;">Luo uusi admin-tunnus</a>
                </div>

                <p style="color: #F56B6B; margin: 8px; font-size: 10px; bottom: 8px; left: 10px; position: absolute;"></i>Copyright Nollaversio IT | 2016 | Proudly using Laravel 5.1.0</i></p>
            </div>
        </form>

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


