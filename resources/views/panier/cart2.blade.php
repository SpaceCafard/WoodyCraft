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
    <h1>Votre Panier</h1>


    <div class="row">
        <div class="col-md-9">

      <span hidden>
        {{$total = 0}}
          {{$nbProd = 0}}
    </span>
            @if($count == 0)
                <h5 class="card-title">Votre Panier est vide...</h5>
            @else
            @foreach($paniers as $panier)
                <div class="row">
                    <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <center>
                                @if($panier->product->image == null )
                                    <img src="{{ URL::to('image/notAvailable.png') }}" class="card-img-top" alt="{{ $panier->product->nameP }}">
                                @else
                                    <img src="{{ URL::to($panier->product->image) }}" class="card-img-top" alt="{{ $panier->product->nameP }}">
                                @endif
                                </center>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">{{$panier->product->nameP}}</h5>
                                    <p class="card-text">
                                        {{ $panier->product->description }}<br>
                                        Prix : {{$totalProd = $panier->product->price * $panier->quantity}}€<br>
                                        <div class="row">
                                            <form action="{{ route('panier.update', $panier->id) }}" width="400" method="POST">
                                                @csrf
                                                <label>Quantité : </label>
                                                <input type="hidden" name="id" value="{{ $panier->id }}">
                                                <input type="number" name="quantity" min="1" value="{{ $panier->quantity }}"/>
                                                <input type="submit" class="btn btn-primary" value="Mettre à jour">
                                            </form><p>ㅤ</p>
                                            <form action="{{ route('panierProd.remove',$panier->id )}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Supprimer">
                                            </form>
                                        </div>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div></div>
                </div>
                <span hidden>
          {{ $total = $total+$totalProd }}
                    {{ $nbProd = $nbProd+1 }}
      </span>
            @endforeach
            @endif
        </div>




        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Détail du panier</h5>
                        <p class="card-text">
                            Nombre de produit : {{ $nbProd }}<br>
                            Total : {{ $total }}<br><br>
                        </p>
                        <a href="{{ route('order.user') }}" class="btn btn-success">Passer commande</a>
                        <form action="{{route('panier.remove')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Supprimer le Panier">
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
