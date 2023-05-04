<!doctype html>
<html lang="fr">
<head>
    <title>Woody Admin</title>
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





@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>

@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>

@endguest
<!-- Fin Connexion/Inscription -->

<!-- Affichage des données -->

<a class="nav-link" href="{{ route('products.index') }}">Tout les Produits</a>
<a class="nav-link" href="{{ route('admin.cat') }}">Toute les Catégories </a>
<a class="nav-link" href="{{ route('order.admin') }}">Toute les Commandes</a>
<a class="nav-link" href="{{ route('admin.userList') }}">Toute les Utilisateur</a>

<!-- Fin Affichage des données -->


</body>
</html>
