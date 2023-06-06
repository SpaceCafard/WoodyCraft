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
                <li class="nav-item dropdown">
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
                <li class="nav-item active">
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
    <h1>Commande</h1>

    @foreach($orders as $order)

        <div class="card">
            <br>
            <center>

                <h5 class="card-title">Commande du {{ $order->customer->forname }} {{ $order->customer->surname }}, le {{ $order->created_at }}</h5>
            </center>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">Produit</h5>
                        </center>

                        @foreach($order->commandes as $commande)
                            <p class="card-text">
                                {{$commande->quantity}} | {{$commande->product->nameP}} {{$commande->product->price}}€<br>

                                @endforeach
                                <br>
                                <strong>Total</strong> : {{$order->total}}€
                            </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">Adresse de livraison</h5>
                        </center>
                        <p class="card-text">
                            Nom : {{$order->delivery->lastname}}<br>
                            Prénom : {{$order->delivery->firstname}}<br>
                            Adresse 1 : {{$order->delivery->add1}}<br>
                            @if($order->delivery->add2 != null)
                                Adresse 2 : {{$order->delivery->add2}}<br>
                            @endif
                            Ville : {{$order->delivery->city}}<br>
                            Code Postal : {{$order->delivery->postcode}}<br>
                            Téléphone : {{$order->delivery->phone}}<br>
                            Email : {{$order->delivery->email}}<br><br>
                        <form action="{{route('order.update', $order->id)}}" method="post">
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            @csrf
                            <label> Etat de la commande : </label>
                            <select name="status">
                                <option value="0" {{ ($order->status == '0') ? 'selected' : '' }}>Commandé</option>
                                <option value="1" {{ ($order->status == '1') ? 'selected' : '' }}>En cours de Préparation</option>
                                <option value="2" {{ ($order->status == '2') ? 'selected' : '' }}>Expédié</option>
                                <option value="3" {{ ($order->status == '3') ? 'selected' : '' }}>Livré</option>
                            </select>
                            <input type="submit" class="btn btn-primary" value="Mis à Jour">
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</div>


<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
