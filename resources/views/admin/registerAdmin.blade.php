<!doctype html>
<html lang="fr">
<head>
    <title>S'inscrire Admin Woody</title>
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
<?php
