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
        <p>Utilisateur {{$customer->user->name}}</p>

        <p>Information:<br><br>

            Prénom : {{$customer->forname}}<br>
        @if($customer->add2 == null && $customer->add3 == null)
            Adresse 1: {{ $customer->add1 }}<br>
        @elseif($customer->add1 == null && $customer->add3 == null)
            Adresse 2: {{ $customer->add2 }}<br>
        @elseif($customer->add1 == null && $customer->add2 == null)
            Adresse 3: {{ $customer->add3 }}<br>
        @elseif($customer->add1 == null)
            Adresse 2: {{ $customer->add2 }}<br>
            Adresse 3: {{ $customer->add3 }}<br>
        @elseif($customer->add2 == null)
            Adresse 1: {{ $customer->add1 }}<br>
            Adresse 3: {{ $customer->add3 }}<br>
        @elseif($customer->add3 == null)
            Adresse 1: {{ $customer->add1 }}<br>
            Adresse 2: {{ $customer->add2 }}<br>
        @else
            Adresse 1: {{ $customer->add1 }}<br>
            Adresse 2: {{ $customer->add2 }}<br>
            Adresse 2: {{ $customer->add3 }}<br>
        @endif
            Code Postal : {{$customer->postcode}}<br>
            Téléphone : {{$customer->phone}}<br>
            Email : {{ $customer->user->email }} </p>

@endforeach

</body>
</html>

