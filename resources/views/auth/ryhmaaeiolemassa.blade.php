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
   


    
    <h3 id="siellaneon" style="color: #F56B6B; text-align: center; font-size: 32px; line-height: 32px; margin-top: 60px;">Ryhmää ei löytynyt!</h3>
    <p style="text-align: center; color: white; margin: 16px;">Emme löytäneet tietokannastamme ryhmää tunnuksella <span style="color: #F56B6B;">{{$ryhmaURINimi}}</span>. Varmista, että olet saanut
    kutsusähköpostin ja että URL-osoitteesi (näkyvissä www-selaimesi osoiterivillä) vastaa sähköpostissa olevaa osoitelinkkiä.</p><p style="text-align: center; color: white; margin: 16px;">Ongelmatilanteen jatkuessa ota yhteyttä saamasi kutsusähköpostin lähettäjään tai palvelun ylläpitäjään (email alla).</p>
    <p style="text-align: center; color: white; font-size: 18px; margin: 16px;">jussi@nollaversio.fi</p>


    </body>
</html>


