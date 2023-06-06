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
                    <li class="nav-item active">
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
    <!-- Contenu principal du site -->
    <center>
        <h1>Passer votre commande</h1>
    </center>
    <form action="{{ route('order.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Résumé de la commande</h5>
                        <span hidden>
                            {{$total = 0}}
                            {{$nbProd = 0}}
                        </span>
                        @foreach($paniers as $commande)
                            <p class="card-text">
                                {{$commande->quantity}} | {{$commande->product->nameP}} {{$commande->product->price}}€<br>
                                <span hidden>
                                    {{$totalProd = $commande->product->price * $commande->quantity}}
                                    {{ $nbProd = $nbProd+1 }}
                                    {{ $total = $total+$totalProd }}
                                </span>
                                @endforeach
                                <br>
                                <strong>Total</strong> : {{$total}}€
                            </p>
                            </p>
                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Détail du panier</h5>
                        <p class="card-text">
                            Nombre de produit : {{ $nbProd }}<br>
                            Total : {{ $total }}<br><br>
                        </p>
                        <input type="submit" class="btn btn-success"value="Passer la commande">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-5">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Adresse de livraison</h5>
                        @if ($errors->has('lastname'))
                            <span class="text-danger">Vous devez renseigner le nom de famille</span>
                        @endif
                        <input type="text" placeholder="Nom de famille" name="lastname" class="form--input">
                        @if ($errors->has('firstname'))
                            <span class="text-danger">Vous devez renseigner le prénom</span>
                        @endif
                        <input type="text" placeholder="Prenom" name="firstname" class="form--input">
                        @if ($errors->has('add1'))
                            <span class="text-danger">Vous devez renseigner l'adresse</span>
                        @endif
                        <input type="text" placeholder="Premiére adresse" name="add1" class="form--input">
                        <input type="text" placeholder="Seconde adresse(Facultative)" name="add2" class="form--input">
                        @if ($errors->has('city'))
                            <span class="text-danger">Vous devez renseigner la ville</span>
                        @endif
                        <input type="text" placeholder="Ville" name="city" class="form--input">
                        @if ($errors->has('postcode'))
                            <span class="text-danger">Vous devez renseigner votre code postal</span>
                        @endif
                        <input type="text" placeholder="Code postal" name="postcode" class="form--input">
                        @if ($errors->has('phone'))
                            <span class="text-danger">Vous devez renseigner votre numéro de téléphone</span>
                        @endif
                        <input type="text" placeholder="Numéro de telephone" name="phone" size="10" class="form--input">
                        @if ($errors->has('email'))
                            <span class="text-danger">Vous devez renseigner votre email</span>
                        @endif
                        <input type="email" placeholder="Adresse mail" name="email" class="form--input">
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Moyen de paiement</h5>
                        @if ($errors->has('nameCarte'))
                            <span class="text-danger">Vous devez renseigner le nom de la carte</span>
                        @endif
                        <input type="text" placeholder="Nom de la carte" name="nameCarte" class="form--input">
                        @if ($errors->has('numero'))
                            <span class="text-danger">Vous devez renseigner le numéro de la carte</span>
                        @endif
                        <input type="text" placeholder="Numéro de la carte" name="numero" class="form--input">
                        @if ($errors->has('cvv'))
                            <span class="text-danger">Vous devez renseigner votre le CVV de la carte</span>
                        @endif
                        <input type="text" placeholder="CVV" name="cvv" class="form--input">
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="total" value="{{ $total }}"/>
    </form>
</div>




<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
