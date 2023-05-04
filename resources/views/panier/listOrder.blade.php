<!doctype html>
<html lang="fr">
<head>
    <title>Woody Commande</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Mes Commandes</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('panier.liste') }}">Panier User[{{$count}}]</a>

@endguest
<!-- Fin Connexion/Inscription -->

<table>


@foreach($orders as $order)
    <p>Commande du {{ $order->created_at }}</p>
        <table>
            <tr>
                <td>Nom Produit</td>
                <td>Quantité</td>
                <td>Prix</td>
                <td>Action</td>
            </tr>

    @foreach($order->commandes as $commande)
        <tr>
                <td>{{$commande->product->nameP}}</td>
                <td>{{$commande->product->price}}</td>
                <td>{{$commande->quantity}}</td>

    @endforeach
            <td>{{$order->total}}</td>

            </tr>
    </table>
        <p>Adresse de Livraison<br><br>
            Nom : {{$order->delivery->lastname}}<br>
            Prénom : {{$order->delivery->firstname}}<br>
            Adresse : {{$order->delivery->add1}}<br>
            Ville : {{$order->delivery->city}}<br>
            Code Postal : {{$order->delivery->postcode}}<br>
            Téléphone : {{$order->delivery->phone}}<br>
            Email : {{$order->delivery->email}}<br><br>
            Avancé de la commande : @if($order->status == 0) Commandé @elseif($order->status == 1) En cours de Préparation @elseif($order->status == 2) Expédié @elseif($order->status == 3) Livrée @endif</p>

@endforeach

</body>
</html><?php
