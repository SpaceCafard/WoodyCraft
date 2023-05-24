<!doctype html>
<html lang="fr">
<head>
    <title>Woody : {{$customers->user->name}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Pseudo :{{$customers->user->name}}</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>

@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>


@endguest
<!-- Fin Connexion/Inscription -->

<div>
    <p>Information:<br><br>

        Prénom : {{$customers->forname}}<br>
        Nom : {{$customers->surname}}<br>
        @if($customers->add2 == null && $customers->add3 == null)
            Adresse 1: {{ $customers->add1 }}<br>
        @elseif($customers->add1 == null && $customers->add3 == null)
            Adresse 2: {{ $customers->add2 }}<br>
        @elseif($customers->add1 == null && $customers->add2 == null)
            Adresse 3: {{ $customers->add3 }}<br>
        @elseif($customers->add1 == null)
            Adresse 2: {{ $customers->add2 }}<br>
            Adresse 3: {{ $customers->add3 }}<br>
        @elseif($customers->add2 == null)
            Adresse 1: {{ $customers->add1 }}<br>
            Adresse 3: {{ $customers->add3 }}<br>
        @elseif($customers->add3 == null)
            Adresse 1: {{ $customers->add1 }}<br>
            Adresse 2: {{ $customers->add2 }}<br>
        @else
            Adresse 1: {{ $customers->add1 }}<br>
            Adresse 2: {{ $customers->add2 }}<br>
            Adresse 2: {{ $customers->add3 }}<br>
        @endif
        Code Postal : {{$customers->postcode}}<br>
        Téléphone : {{$customers->phone}}<br>
        Email : {{ $customers->user->email }} </p>
</div>

</body>
</html>

