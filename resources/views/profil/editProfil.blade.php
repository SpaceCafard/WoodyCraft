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
    <!-- Contenu principal du site -->


    <center>
        <form action="{{ route('user.update', $customers->id) }}" method="POST" class="form">
            @csrf
            <span class="signup">Modifier son Profil</span>
            @if ($errors->has('surname'))
                <span class="text-danger">{{ $errors->first('surname') }}</span>
            @endif
            <input type="text" placeholder="Nom de famille" value="{{ old('surname', $customers->surname) }}"  name="surname" class="form--input">
            @if ($errors->has('forname'))
                <span class="text-danger">{{ $errors->first('forname') }}</span>
            @endif
            <input type="text" placeholder="Prenom" name="forname"  value="{{ old('surname', $customers->forname) }}" class="form--input">
            @if ($errors->has('add1'))
                <span class="text-danger">{{ $errors->first('add1') }}</span>
            @endif
            <input type="text" placeholder="Premiére adresse" name="add1" value="{{ old('add1', $customers->add1) }}" class="form--input">
            @if ($errors->has('add2'))
                <span class="text-danger">{{ $errors->first('add2') }}</span>
            @endif
            <input type="text" placeholder="Seconde adresse" name="add2" value="{{ old('add1', $customers->add2) }}" class="form--input">
            @if ($errors->has('add3'))
                <span class="text-danger">{{ $errors->first('add3') }}</span>
            @endif
            <input type="text" placeholder="Troisiéme adresse" name="add3" value="{{ old('add1', $customers->add3) }}" class="form--input">
            @if ($errors->has('postcode'))
                <span class="text-danger">{{ $errors->first('postcode') }}</span>
            @endif
            <input type="text" placeholder="Code postal" name="postcode" value="{{ old('postcode', $customers->postcode) }}" class="form--input">
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" placeholder="Numéro de telephone" name="phone" value="{{ old('phone', $customers->phone) }}" size="10" class="form--input">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            <input type="email" placeholder="Adresse mail" name="email" value="{{ old('email', $customers->user->email) }}" class="form--input">


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
