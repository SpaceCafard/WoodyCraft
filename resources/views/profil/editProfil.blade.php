<!doctype html>
<html lang="fr">
<head>
    <title>Woody Profil </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">

<h1>Modification du Profil</h1>

<form action="{{ route('user.update', $customers->id) }}" method="POST">

    @csrf
    <div class="form-example">
        <label for="forname">Prenom : </label>
        <input type="text" name="forname" value="{{ old('forname', $customers->forname) }}" placeholder="Prénom">
    </div>
    <div class="form-example">
        <label for="surname">Nom de famille : </label>
        <input type="text" name="surname" value="{{ old('surname', $customers->surname) }}" placeholder="Nom de famille">
    </div>
    <div class="form-example">
        <label for="add1">Adresse 1 : </label>
        <input type="text" name="add1" value="{{ old('add1', $customers->add1) }}" placeholder="Adresse 1">
    </div>
    <div class="form-example">
        <label for="add2">Adresse 2 : </label>
        <input type="text" name="add2" value="{{ old('add2', $customers->add2) }}" placeholder="Adresse 2">
    </div>
    <div class="form-example">
        <label for="add2">Adresse 3 : </label>
        <input type="text" name="add3" value="{{ old('add3', $customers->add3) }}" placeholder="Adresse 3">
    </div>
    <div class="form-example">
        <label for="postcode">Code Postal : </label>
        <input type="text" name="postcode" value="{{ old('postcode', $customers->postcode) }}" placeholder="Code Postal">
    </div>
    <div class="form-example">
        <label for="phone">N° Tel : </label>
        <input type="text" name="phone" value="{{ old('phone', $customers->phone) }}" placeholder="01.02.03.04.05">
    </div>
    <div class="form-example">
        <label for="email">Email : </label>
        <input type="email" name="email" value="{{ old('email', $customers->user->email) }}" placeholder="01.02.03.04.05">
    </div>
    <div class="form-example">
        <input type="submit" value="Mettre à Jour">
    </div>
</form>
</body>
</html>

