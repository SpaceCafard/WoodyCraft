<!doctype html>
<html lang="fr">
<head>
    <title>Liste Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<form action="{{ route('admin.storeCat') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-example">
        <label for="name">Nom de la catégorie: </label>
        <input type="text" name="name" placeholder="nom">
    </div>
    <div class="form-example">
        <label for="name">Description: </label>
        <textarea name="description" rows="10" cols="100">

        </textarea>
    </div>
    <label class="label">Insigne:</label>
    <div class="form-example">
        <input type="file" name="image" class="input">
    </div>
    <p>Format : PNG, JPEG ou JPG inferieur à 2Mo</p>
    <div class="form-example">
        <input type="submit" value="Crée">
    </div>
</form>
</body>
</html>

