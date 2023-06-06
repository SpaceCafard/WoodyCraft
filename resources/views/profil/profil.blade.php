<!DOCTYPE html>
<html>
<head>
    <title>Ma Boutique de Jouets</title>
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

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="{{ route('user.profil') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $user->name }}
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
    <!-- Contenu principal du site -->


    <div class="row">
        <div class="col-md-4"></div>

        <div class="form">
            <center><h5 class="card-title">Profil de {{ $user->name }}</h5></center>
            <p>
                <strong>Nom </strong> : {{ $customers->forname }} <br>
                <strong>Prénom </strong> : {{ $customers->surname }} <br>
                @if($customers->add2 == null && $customers->add3 == null)
                    <strong>Adresse 1 </strong> : {{ $customers->add1 }} <br>
                @elseif($customers->add1 == null && $customers->add3 == null)
                    <strong>Adresse 2 </strong> : {{ $customers->add2 }} <br>
                @elseif($customers->add1 == null && $customers->add2 == null)
                    <strong>Adresse 3 </strong> :  {{ $customers->add3 }}<br>
                @elseif($customers->add1 == null)
                    <strong>Adresse 2 </strong> : {{ $customers->add2 }}<br>
                    <strong>Adresse 3 </strong> : {{ $customers->add3 }}<br>
                @elseif($customers->add2 == null)
                    <strong>Adresse 1 </strong> : {{ $customers->add1 }} <br>
                    <strong>Adresse 3 </strong> : {{ $customers->add3 }}<br>
                @elseif($customers->add3 == null)
                    <strong>Adresse 1 </strong> : {{ $customers->add1 }} <br>
                    <strong>Adresse 2 </strong> : {{ $customers->add2 }}<br>
                @else
                    <strong>Adresse 1 </strong> : {{ $customers->add1 }} <br>
                    <strong>Adresse 2 </strong> : {{ $customers->add2 }}<br>
                    <strong>Adresse 3 </strong> : {{ $customers->add3 }}<br>
                @endif

                <strong>N° Tél </strong> : {{ $customers->phone }} <br>
                <strong>Email </strong> : {{ $customers->user->email }} <br>
                <strong>Code Postal </strong> : {{ $customers->postcode }} <br>
            </p>
        </div>
        <div class="col-md-4"></div>
    </div>

</div>



<!-- Liens vers les fichiers JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
