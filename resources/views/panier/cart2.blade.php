<!doctype html>
<html lang="fr">
<head>
    <title>Woody Panier</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Panier Utilisateur</h1>

<!-- Message Pop Up -->




<div>
    {{$info}}
</div>

<!-- Fin Message Pop Up -->



<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>
    <a href="{{ route('cart.list') }}">Panier Session</a>


@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('panier.liste') }}">Panier User[{{$count}}]</a>

@endguest
<!-- Fin Connexion/Inscription -->

<!-- Données -->
<table>
    <tr>
        <td>Nom Produit</td>
        <td>Quantité</td>
        <td>Prix</td>
        <td>Action</td>
    </tr>

    <span hidden>{{$total = 0}}</span>
    @foreach($paniers as $panier)
        <tr>
            <td>{{$panier->product->nameP}}</td>
            <td>
                <form action="{{ route('panier.update', $panier->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $panier->id }}">
                    <input type="number" name="quantity" value="{{ $panier->quantity }}"/>
                    <input type="submit" value="Mettre à jour">
                </form>
            </td>
            <td>{{$totalProd = $panier->product->price * $panier->quantity}}€</td>
            <td>
                <form action="{{ route('panierProd.remove',$panier->id )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
        <span hidden>{{ $total = $total+$totalProd }}</span>
    @endforeach
</table>
<p>Total : {{$total}}€</p>
<form action="{{route('panier.remove')}}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Supprimer le Panier">
</form>
<input type="hidden" name="total" value="{{ $total }}">
<!-- Fin Données -->

<a href="{{ route('order.user') }}">Commander</a>
</body>
</html>

