<!doctype html>
<html lang="fr">
<head>
    <title>Woody Commande</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Toutes les Utilisateurs</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>


@endguest
<!-- Fin Connexion/Inscription -->




    @foreach($customers as $customer)
        <p>{{$customer->forname}} {{$customer->surname}} aka {{$customer->user->name}} </p>
        <a href="{{ route( 'admin.userShow' , $customer->id) }}">Voir</a>

@endforeach

</body>
</html>

