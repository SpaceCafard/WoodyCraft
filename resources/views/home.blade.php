<!doctype html>
<html lang="fr">
<head>
    <title>Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Les Enfants Terribles</h1>

<!-- Message Pop Up -->

@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif



<!-- Fin Message Pop Up -->


<!-- Ajout d'un Produit -->

<!-- Fin Ajout d'un Produit -->

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('panier.liste') }}">Panier User[{{$count}}]</a>
    <a href="{{ route('order.list') }}">Mes Commandes</a>


@endguest
<!-- Fin Connexion/Inscription -->
<a href="{{ route('products.index') }}">Nos produits</a>



@guest

    <h1>Bienvenue</h1>
@else

    <h1>Bienvenue {{$user->name}}</h1>
@endguest


</body>
</html>
