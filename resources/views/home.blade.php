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




<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Categorie</th>
        <th>Stock</th>
        <th>Panier</th>
    </tr>
    @foreach ($products as $product)
        @if($product->categorie->status == 0)
        @if($product->status == 0)
            <tr>
                <td>{{ $product->nameP }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->categorie->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}">Voir</a>
                </td>
                <td>
                    @if( $product->stock <= 0 )
                        Hors-Stock
                    @else
                        <form action="{{route('panier.ajout', $product->id)}}" method="POST">
                            @csrf

                            <input type="number" value="1" min="1" max="{{ $product->stock }}" name="quantity">
                            <input type="submit" value="Ajouter au Panier">
                        </form>
                    @endif
                </td>
                @else
                    @continue
                @endif
                @else
                    @continue
                @endif
            </tr>
            @endforeach
</table>



</body>
</html>
