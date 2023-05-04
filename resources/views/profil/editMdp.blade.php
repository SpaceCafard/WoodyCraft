<!doctype html>
<html lang="fr">
<head>
    <title>Woody Profil </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">

<h1>Modification du Profil</h1>

@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif

@if($errors->all())
    @foreach($errors->all() as $error)
        <p> {{ $error }} </p>
    @endforeach
@endif

<form action="{{ route('user.updateId', $user->id) }}" method="POST">
    @csrf
    <div class="form-example">
        <label for="oldPwd">Ancien Mot de Passe : </label>
        <input type="password" name="oldPwd">
    </div>
    <div class="form-example">
        <label for="verifPwd">Nouveau Mot de Passe : </label>
        <input type="password" name="verifPwd">
    </div>
    <div class="form-example">
        <label for="password">Saisissez une seconde fois le nouveau mot de passe  : </label>
        <input type="password" name="password">
    </div>
    <div class="form-example">
        <input type="submit" value="Mettre à Jour">
    </div>

</form>
</body>
</html>
