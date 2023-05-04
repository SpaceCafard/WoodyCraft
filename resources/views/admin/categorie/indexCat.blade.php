<!doctype html>
<html lang="fr">
<head>
    <title>Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<h1>Les Enfants Terribles</h1>

<!-- Message Pop Up -->

@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif



<!-- Fin Message Pop Up -->


<!-- Connexion/Inscription -->

@guest

    <a class="nav-link" href="{{ route('login') }}">Login</a>
    <a class="nav-link" href="{{ route('Senregistrer') }}">Register</a>

@else

    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    <a href="{{ route('user.profil') }}">Profile</a>

@endguest
<!-- Fin Connexion/Inscription -->

<a href="{{ route('admin.createCat') }}">Ajouter une categorie</a>

<!-- Affichage des données -->

<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    @foreach ($categories as $categorie)

        <tr>
            <td>{{ $categorie->name }}</td>
            <td>{{ $categorie->description }}</td>
            <td>
                <a href="{{ route('admin.showCat', $categorie->id) }}">Voir</a>
                <a href="{{ route('admin.editCat', $categorie->id) }}">Modifier</a>
            </td>

        </tr>
    @endforeach
</table>

<!-- Fin Affichage des données -->


</body>
</html>


