<!doctype html>
<html lang="fr">
<head>
    <title>Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Produit Archivé</h1>

<!-- Message Pop Up -->

@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif



<!-- Fin Message Pop Up -->

<!-- Ajout d'un Produit -->

<a href="{{ route('products.create') }}">Ajouter un produit</a>

<!-- Fin Ajout d'un Produit -->

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a class="nav-link" href="{{ route('products.index') }}">Tout les Produits</a>
    <a class="nav-link" href="{{ route('admin.cat') }}">Toute les Catégories </a>
    <a class="nav-link" href="{{ route('order.admin') }}">Toute les Commandes</a>
    <a class="nav-link" href="{{ route('admin.userList') }}">Toute les Utilisateur</a>


@endguest
<!-- Fin Connexion/Inscription -->

<!-- Affichage des données -->

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Categorie</th>
        <th>Stock</th>
        <th>Action</th>

    </tr>
    @foreach ($products as $product)

        @if($product->status == 1)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->nameP }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->categorie->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>

                    <form action="{{ route('products.actived',$product->id )}}" method="post">
                        @csrf
                        <input type="submit" value="Réactiver">
                    </form>
                </td>
                @else
                    @continue
                @endif
            </tr>
            @endforeach
</table>

<!-- Fin Affichage des données -->


</body>
</html>


<?php
