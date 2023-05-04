<!doctype html>
<html lang="fr">
<head>
    <title>Woody Profil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Pseudo : {{ $user->name}}</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('panier.liste') }}">Panier User[{{$count}}]</a>

@endguest
<!-- Fin Connexion/Inscription -->


    <p>Nom : {{ $customers->forname }} </p>
    <p>Prénom : {{ $customers->surname }}</p>

    @if($customers->add2 == null && $customers->add3 == null)
        <p>Adresse 1: {{ $customers->add1 }}</p>
    @elseif($customers->add1 == null && $customers->add3 == null)
        <p>Adresse 2: {{ $customers->add2 }}</p>
    @elseif($customers->add1 == null && $customers->add2 == null)
        <p>Adresse 3: {{ $customers->add3 }}</p>
    @elseif($customers->add1 == null)
        <p>Adresse 2: {{ $customers->add2 }}</p>
        <p>Adresse 3: {{ $customers->add3 }}</p>
    @elseif($customers->add2 == null)
        <p>Adresse 1: {{ $customers->add1 }}</p>
        <p>Adresse 3: {{ $customers->add3 }}</p>
    @elseif($customers->add3 == null)
        <p>Adresse 1: {{ $customers->add1 }}</p>
        <p>Adresse 2: {{ $customers->add2 }}</p>
    @else
        <p>Adresse 1: {{ $customers->add1 }}</p>
        <p>Adresse 2: {{ $customers->add2 }}</p>
        <p>Adresse 2: {{ $customers->add3 }}</p>
    @endif
    <p>N° Tel : {{ $customers->phone }}</p>
    <p>Email : {{ $customers->user->email }}</p>

    <p>Code Postal : {{ $customers->postcode }}</p>

<a href="{{ route('user.edit', $customers->id) }}">Modifier le profil</a><br>
<a href="{{ route('user.identifiant', $user->id) }}">Modifier le Mot de Passe</a>





</body>
</html>
