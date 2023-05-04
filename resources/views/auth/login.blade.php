<!doctype html>
<html lang="fr">
<head>
    <title>Connexion Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
@if(session()->has('info'))
    <div>
        {{ session('info') }}
    </div>
@endif
<form method="POST" action="{{ route('login.custom') }}">
    @csrf
    <div class="form-group mb-3">
        <input type="text" placeholder="Pseudo" id="name" class="form-control" name="name" required
               autofocus>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group mb-3">
        <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group mb-3">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    </div>
    <div class="d-grid mx-auto">
        <input type="submit" value="Crée">
    </div>
</form>



</body>
</html>
