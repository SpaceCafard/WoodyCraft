<!doctype html>
<html lang="fr">
<head>
    <title>Liste Woody</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
<form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <label for="categorie">Catégorie</label>
    <select name="categorie_id">
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
        @endforeach
    </select>

    <div class="form-example">
        <label for="name">Nom du Produit: </label>
        <input type="text" name="nameP" placeholder="Description du Produit">
    </div>
    <div class="form-example">
        <label for="name">Description: </label>
        <textarea id="description" name="description" rows="10" cols="100">

        </textarea>
    </div>
    <div class="form-example">
        <label for="prix">Prix: </label>
        <input type="number" name="price" step=0.01 placeholder="Prix du Produit">
    </div>
    <div class="form-example">
        <label for="prix">Stock: </label>
        <input type="number" name="stock" placeholder="Stock">
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
