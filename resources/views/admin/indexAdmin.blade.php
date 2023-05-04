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

<!-- Choix de la catégorie -->

<div class="select">
    <select onchange="window.location.href = this.value">
        <option value="{{ route('products.index') }}" @unless($name)  selected @endunless>Toutes catégories</option>
        @foreach($categories as $categorie)
            <option
                value="{{ route('products.categorie', $categorie->name) }}" {{$name == $categorie->name ? 'selected' : '' }}>{{ $categorie->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Fin Choix de la catégorie -->

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
    <a class="nav-link" href="{{ route('admin.userList') }}">Toute les Utilisateur</a><br>
    <a class="nav-link" href="{{ route('admin.archive') }}">Produit Archivé</a>


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

        @if($product->status == 0)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->nameP }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->categorie->name }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                    <a href="{{ route('products.show', $product->id) }}">Voir</a>
                    <a href="{{ route('products.edit', $product->id) }}">Modifier</a>
                    <form action="{{ route('products.destroy',$product->id )}}" method="post">
                        @csrf
                        <input type="submit" value="Supprimer">
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


