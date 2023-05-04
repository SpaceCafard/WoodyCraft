<!doctype html>
<html lang="fr">
<head>
    <title>S'inscrire Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif
<form action="{{ route('user.storeReg') }}" method="post">
    @csrf
    <div class="form-example">
        <label for="surname">Nom: </label>
        <input type="text" name="surname" placeholder="Nom de Famille">
    </div>
    <div class="form-example">
        <label for="forname">Prénom: </label>
        <input type="text" name="forname" placeholder="Prénom">
    </div>
    <div class="form-example">
        <label for="add1">Adresse 1: </label>
        <input type="text" name="add1" placeholder="Première Adresse">
    </div>
    <div class="form-example">
        <label for="add2">Adresse 2: </label>
        <input type="text" name="add2" placeholder="Seconde Adresse">
    </div>
    <div class="form-example">
        <label for="add3">Adresse 3: </label>
        <input type="text" name="add3" placeholder="Troisième Adresse">
    </div>
    <div class="form-example">
        <label for="postcode">Code Postal: </label>
        <input type="text" name="postcode" placeholder="Code Postal">
    </div>
    <div class="form-example">
        <label for="phone">Numéro de téléphone: </label>
        <input type="text" size="10" name="phone" placeholder="01.23.45.67.89">
    </div>
    <div class="form-example">
        <label for="email">Adresse Mail: </label>
        <input type="email" name="email" placeholder="Smith@mail.com">
    </div>
    <div class="form-example">
        <label for="name">Pseudo: </label>
        <input type="text" name="name" placeholder="Pseudo">
    </div>
    <div class="form-example">
        <label for="password">Mot de Passe: </label>
        <input type="password" name="password" placeholder="Mot de Pass">
    </div>


    <div class="form-example">
        <input type="submit" value="Crée">
    </div>
</form>
</body>
</html>
