<!doctype html>
<html lang="fr">
<head>
    <title>Woody Commande</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Toutes les Commandes</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>


@endguest
<!-- Fin Connexion/Inscription -->

<table>


    @foreach($orders as $order)
        <p>Commande de l'utilisateur {{$order->customer->forname}} {{ $order->customer->surname }} du {{ $order->created_at }}</p>
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
            Email : {{$order->delivery->email}}</p>

        <form action="{{route('order.update', $order->id)}}" method="post">
            <input type="hidden" name="id" value="{{ $order->id }}">
            @csrf
            <select name="status">
                <option value="0" {{ ($order->status == '0') ? 'selected' : '' }}>Commandé</option>
                <option value="1" {{ ($order->status == '1') ? 'selected' : '' }}>En cours de Préparation</option>
                <option value="2" {{ ($order->status == '2') ? 'selected' : '' }}>Expédié</option>
                <option value="3" {{ ($order->status == '3') ? 'selected' : '' }}>Livré</option>
            </select>
            <input type="submit" value="Mis à Jour">

        </form>
@endforeach

</body>
</html>
