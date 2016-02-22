<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Network Helper Dashboard</title>
        
        <!-- Error CSS -->
        <link href="{{asset('css/login.css')}}" rel="stylesheet" media="screen">

        <!-- Animate CSS -->
        <link href="{{asset('css/animate.css')}}" rel="stylesheet" media="screen">

        <!-- Font Awesome -->
        <link href="{{asset('fonts/font-awesome.min.css')}}" rel="stylesheet">
    </head>
    <body>

        <form id="wrapper" method="POST" action="{{route('login')}}">
            {!! csrf_field() !!}
            <div id="box" class="animated bounceIn">
                <div id="top_header">

                    <h5>
                        Vaatii kirjautumisen
                    </h5>
                </div>
                <di id="inputs">
                    <div class="form-control">
                        <input type="text" placeholder="" name="email" value="{{ old('email') }}">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="form-control">
                        <input type="password" name="password" placeholder="Password">
                        <i class="fa fa-key"></i>
                    </div>
                    <input type="submit" value="Kirjaudu">
                </di>
                <div id="bottom">
                    <div class="squared-check">
                        <input type="checkbox" value="None" id="remember" name="check" checked="">
                        <label for="remember"></label>
                        <div class="cb-label">Muista minut</div>
                    </div>
                    <a class="right_a" href="#">Unohtuiko salasana?</a>
                </div>
            </div>
        </form>

    </body>
</html>


