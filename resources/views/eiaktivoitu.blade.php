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
   


    
    <h3 id="siellaneon" style="color: #F56B6B; text-align: center; font-size: 32px; line-height: 32px; margin-top: 60px;">Tunnustasi ei ole vielä aktivoitu!</h3>
    <p style="text-align: center; color: white; margin: 16px;">Löysimme käyttäjätunnuksesi, mutta ryhmäsi admin ei ole vielä aktivoinut sitä. Kokeile kirjautumista
    myöhemmin uudestaan.</p>
    <hr style="width: 40%;">
    <p style="text-align: center; color: white; margin: 16px;">Ryhmäsi admin-käyttäjä käyttäjätunnus on <i>{{$admin->name}}</i> ja hänen sähköpostinsa tiedusteluja varten on <i>{{$admin->email}}</i> </p>



    </body>
</html>


