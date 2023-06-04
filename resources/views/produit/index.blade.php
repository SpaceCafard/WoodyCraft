<!DOCTYPE html>
<html>
<head>
    <title>WoodyCraft</title>
    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="{{ URL::asset('styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
</head>
<body>
<header>
    <!-- En-tête du site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">WoodyCraft</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('products.index') }}">Produits</a>
                </li>
                @guest

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('login') }}">
                            Connexion
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('Senregistrer') }}">
                            S'inscrire
                        </a>
                    </li>

                @else

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$user->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('order.list') }}">Mes Commandes</a>
                            <a class="dropdown-item" href="{{ route('user.profil') }}">Mon Profil</a>
                            <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Modifer le Profil</a>
                            <a class="dropdown-item" href="{{ route('user.identifiant', $user->id) }}">Modifier le Mot de Passe</a>
                            <a class="dropdown-item" href="{{ route('signout') }}">Se deconnecter</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panier.liste') }}">
                            <span class="fa fa-shopping-cart"></span> Panier[{{$count}}]
                        </a>
                    </li>

                @endguest


            </ul>

        </div>
    </nav>

        @if(session()->has('info'))
        <div class="alert alert-secondary" role="alert">
                {{ session('info') }}
            </div>
        @endif


</header>


<div class="container">
    <h1>Touvez votre bonheur parmis nos articles.</h1>

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
    <div class="row">
        @foreach ($products as $product)
            @if($product->categorie->status == 0)
                @if($product->status == 0)
                    <div class="col-md-4">
                        <div class="card">
                            @if($product->image == null )
                                <img src="{{ URL::to('image/notAvailable.png') }}" class="card-img-top" alt="{{ $product->nameP }}">
                            @else
                                <img src="{{ URL::to($product->image) }}" class="card-img-top" alt="{{ $product->nameP }}">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $product->nameP }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                @if( $product->stock <= 0 )
                                    Hors-Stock
                                @else
                                    <form action="{{route('panier.ajout', $product->id)}}" method="POST">
                                        @csrf

                                        <input type="number" value="1" min="1" max="{{ $product->stock }}" name="quantity">
                                        <input type="submit" class="btn btn-primary" value="Ajouter au Panier">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</div>



<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
