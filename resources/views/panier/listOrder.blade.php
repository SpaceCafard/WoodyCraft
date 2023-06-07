<!DOCTYPE html>
<html>
<head>
    <title>WoodyCraft</title>
    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="{{ URL::asset('formulaire.css') }}">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Produits</a>
                </li>
                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Senregistrer') }}">
                            S'inscrire
                        </a>
                    </li>

                @else

                    <li class="nav-item dropdown active">
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
    <h1>Commandes en cours</h1>
    @if($count2 == 0)
        <h5 class="card-title">Vous n'avez aucunes commandes en cours ...</h5>
    @else
    @foreach($orders as $order)
        @if($order->status != 3)
        <div class="card">
            <br>
            <center>

                <h5 class="card-title">Détail de la commande du {{ $order->created_at }}</h5>
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
                            État de la commande : @if($order->status == 0) Commandé @elseif($order->status == 1) En cours de Préparation @elseif($order->status == 2) Expédié @elseif($order->status == 3) Livrée @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
            @continue
        @endif
    @endforeach
    @endif

    @if($count3 > 0)
    <h1>Historique des commandes</h1>
    @foreach($orders as $order)
        @if($order->status == 3)
            <div class="card">
                <br>
                <center>
                    <h5 class="card-title">Détail de la commande du {{ $order->created_at }}</h5>
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
                                État de la commande : @if($order->status == 0) Commandé @elseif($order->status == 1) En cours de Préparation @elseif($order->status == 2) Expédié @elseif($order->status == 3) Livrée @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @continue
        @endif
    @endforeach
    @endif

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
