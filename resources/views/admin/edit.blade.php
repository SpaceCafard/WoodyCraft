<!DOCTYPE html>
<html>
<head>
    <title>WoodyCraft</title>
    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="{{ URL::asset('styles.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('formulaire.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <style>
        .product {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .product img {
            width: 80px;
            margin-right: 10px;
        }

        .product .name {
            flex-grow: 1;
        }

        .total {
            font-weight: bold;
        }
    </style>
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
                        <a class="dropdown-item" href="{{ route('admin.archive') }}">Produits archivé</a>

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
<div class="container">
    <!-- Contenu principal du site -->


    <center>
        <form action="{{ route('products.update', $products->id) }}" enctype="multipart/form-data" method="POST" class="form">
            @method('put')
            @csrf
            <span class="signup">Modifier {{ $products->nameP }}</span>
            <div class="select">
                <select name="categorie_id">
                    <option value="{{ $products->categorie_id }}">Actuelle : {{ $products->categorie->name }}</option>
                    @foreach($categories as $categorie)
                        @if($categorie->id==$products->categorie_id)
                            @continue
                        @endif
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div><br>
            @if ($errors->has('nameP'))
                <span class="text-danger">Vous devez entrer un nom pour votre produit</span>
            @endif
            <input type="text" placeholder="Nom du Produit" value="{{ old('nameP', $products->nameP) }}" name="nameP" class="form--input">
            @if ($errors->has('description'))
                <span class="text-danger">Vous devez entrer une description</span>
            @endif
            <textarea placeholder="Description du Produit"  name="description" rows="10" class="form--input"> {{ old('description', $products->description) }} </textarea>
            @if ($errors->has('price'))
                <span class="text-danger">Vous devez entrer un prix</span>
            @endif
            <input type="text" placeholder="Prix du Produit" value="{{ old('price', $products->price) }}" name="price"  class="form--input">
            @if ($errors->has('stock'))
                <span class="text-danger">Vous devez indiquer le stocke disponible</span>
            @endif
            <input type="text" placeholder="Stocke Disponible" value="{{ old('stock', $products->stock) }}" name="stock" class="form--input">
            @if($products->image == null )
                <img src="{{ URL::to('image/notAvailable.png') }}" class="card-img-top" alt="{{ $products->nameP }}">
            @else
                <img src="{{ URL::to($products->image) }}" class="card-img-top" alt="{{ $products->nameP }}">
            @endif
            <label class="label">Image(Inferieur a 2mo, JPEG OU JPG):</label>
            <input type="file" name="image"><br>


            <input type="submit" value="Mettre à jour" class="form--submit">


        </form>
    </center>
</div>

<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
