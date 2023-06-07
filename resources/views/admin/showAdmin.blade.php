<!DOCTYPE html>
<html>
<head>
    <title>WoodyCraft</title>
    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="{{ URL::asset('styles.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('description.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
</head>
<body>
<header>
    <!-- En-tête du site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('admin.home') }}">WoodyCraft Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">Accueil</a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produits
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('products.index') }}">Produits en ligne</a>
                        <a class="dropdown-item" href="{{ route('admin.archive') }}">Produits archivés</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.cat') }}">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.admin') }}">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.userList') }}">Utilisateur</a>
                </li>
                @guest

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('login') }}">
                            Connexion
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('Senregistrer') }}" >
                            S'inscrire
                        </a>
                    </li>

                @else

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('signout') }}">
                            Déconnexion
                        </a>
                    </li>

            @endguest



        </div>
    </nav>
    @if(session()->has('info'))
        <div class="alert alert-secondary" role="alert">
            {{ session('info') }}
        </div>
    @endif

</header>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="product-image">
                @if($product->image == null )
                    <p><img src={{ URL::to('image/notAvailable.png') }}/></p>
                @else
                    <p><img src="{{ URL::to($product->image) }}"/></p>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-details">
                <h2 class="category">{{ $categories }}</h2>
                <h5 class="card-title">{{$product->nameP}}</h5>
                <p class="price">Prix : {{ $product->price }}€</p>
                <p class="description">{{ $product->description }}</p>
                <div class="row">
                    <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}">Modifier</a><p>ㅤ</p>
                    <form action="{{ route('products.destroy',$product->id )}}" method="post">
                        @csrf
                        <input class="btn btn-danger" type="submit" value="Supprimer">
                    </form>
                </div>
        </div>
    </div>
</div>
</body>



<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

