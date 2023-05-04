
<!doctype html>
<html lang="fr">
<head>
    <title>Woody : {{ $product->nameP }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Nom :{{ $product->nameP }}</h1>

<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>



@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('panier.liste') }}">Panier User[{{$count}}]</a>

@endguest
<!-- Fin Connexion/Inscription -->

<div >
    <p>Catégorie : {{ $categories }} </p>
    <p>Description : {{ $product->description }}</p>
    <p>Stock : {{ $product->stock }}</p>
    @if($product->image == null )
        <p>Image : <img src="http://{{ $ip }}/WoodyCraft/public/image/notAvailable.png"/></p>
    @else
        <p>Image : <img src="{{ URL::to($product->image) }}"/></p>
    @endif
</div>

    <form action="{{route('panier.ajout', $product->id)}}" method="POST">
        @csrf

        <input type="number" value="1" min="1" max="{{ $product->stock }}" name="quantity">
        <input type="submit" value="Ajouter au Panier">

    </form>




</body>
</html>
