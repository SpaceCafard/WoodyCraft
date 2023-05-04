<!doctype html>
<html lang="fr">
<head>
    <title>Commander Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif
@if($errors->all())
    @foreach($errors->all() as $error)
        <p> {{ $error }} </p>
    @endforeach
@endif
<h2>Resume de la commande</h2>

<table>
    <tr>
        <td>Nom Produit</td>
        <td>Quantité</td>
        <td>Prix</td>
    </tr>

    <span hidden>{{$total = 0}}</span>
    @foreach($paniers as $panier)
        <tr>
            <td>{{$panier->product->nameP}}</td>
            <td>
                    {{ $panier->quantity }}

            </td>
            <td>{{$totalProd = $panier->product->price * $panier->quantity}}€</td>
        </tr>
        <span hidden>{{ $total = $total+$totalProd }}</span>
    @endforeach
</table>

<p>Total = {{ $total }} </p>

<h2>Adresse de livraison</h2>

<form action="{{ route('order.store') }}" method="post">
    @csrf
    <input type="hidden" name="total" value="{{ $total }}"/>
    @if($errors->has('firstname'))
        <div class="error">{{ $errors->first('firstname') }}</div>
    @endif
    <div class="form-example">
        <label for="firstname">Nom: </label>
        <input type="text" name="firstname" placeholder="Nom de Famille">
    </div>
    <div class="form-example">
        <label for="lastname">Prénom: </label>
        <input type="text" name="lastname" placeholder="Prénom">
    </div>
    <div class="form-example">
        <label for="add1">Adresse 1: </label>
        <input type="text" name="add1" placeholder="Première Adresse">
    </div>
    <div class="form-example">
        <label for="add2">Adresse 2: </label>
        <input type="text" name="add2" placeholder="Seconde Adresse">
    </div>
    <div class="form-example">
        <label for="city">Ville: </label>
        <input type="text" name="city" placeholder="Ville">
    </div>
    <div class="form-example">
        <label for="postcode">Code Postal: </label>
        <input type="text" name="postcode" placeholder="Code Postal">
    </div>
    <div class="form-example">
        <label for="phone">Numéro de téléphone: </label>
        <input type="text" size="10" name="phone" placeholder="01.23.45.67.89">
    </div>
    <div class="form-example">
        <label for="email">Adresse Mail: </label>
        <input type="email" name="email" placeholder="Smith@mail.com">
    </div>
    <label for="payment_id">Méthode de Paiement</label>
    <select name="payment_id" >

        @foreach($payments as $payment)
            <option value="{{ $payment->id }}" >{{ $payment->name }}</option>
        @endforeach
    </select>
    <div class="form-example">
        <input type="submit" value="Crée">
    </div>

</form>
</body>
</html>
