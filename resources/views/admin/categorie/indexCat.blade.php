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
        @if($categorie->status == 0)
        <tr>
            <td>{{ $categorie->name }}</td>
            <td>{{ $categorie->description }}</td>
            <td>
                <a href="{{ route('admin.showCat', $categorie->id) }}">Voir</a>
                <a href="{{ route('admin.editCat', $categorie->id) }}">Modifier</a>
                <form action="{{ route('categorie.destroy',$categorie->id )}}" method="post">
                    @csrf
                    <input type="submit" value="Supprimer">
                </form>
            </td>
            @else
                @continue
            @endif

        </tr>

    @endforeach
</table><br><br>

<p>Catégorie Archivé</p>

<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    @foreach ($categories as $categorie)
        @if($categorie->status == 1)
            <tr>
                <td>{{ $categorie->name }}</td>
                <td>{{ $categorie->description }}</td>
                <td>

                    <form action="{{ route('categorie.actived',$categorie->id )}}" method="post">
                        @csrf
                        <input type="submit" value="Réactiver">
                    </form>
                </td>
                @else
                    @continue
                @endif

            </tr>

            @endforeach
</table>
<!-- Fin Affichage des données -->


</body>
</html>


