<!doctype html>
<html lang="fr">
<head>
    <title>Modification : {{ $products->nameP }} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
@if($errors->all())
    @foreach($errors->all() as $error)
        <p> {{ $error }} </p>
    @endforeach
@endif
<form action="{{ route('products.update', $products->id) }}" enctype="multipart/form-data" method="POST">
    @method('put')
    @csrf
    <label for="categorie">Catégorie</label>
        <select name="categorie_id">
            <option value="{{ $products->categorie_id }}">Actuelle : {{ $products->categorie->name }}</option>
            @foreach($categories as $categorie)
                @if($categorie->id==$products->categorie_id)
                    @continue
                @endif
                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
            @endforeach
        </select>

    <div class="form-example">
        <label for="name">Nom du Produit: </label>
        <input type="text" name="nameP" value="{{ old('nameP', $products->nameP) }}" placeholder="Description du Produit">
    </div>
    <div class="form-example">
        <label for="name">Description: </label>
        <textarea id="description" name="description" rows="10" cols="100">
            {{ old('description', $products->description) }}
        </textarea>
    </div>
    <div class="form-example">
        <label for="prix">Prix: </label>
        <input type="number" name="price" step=0.01 value="{{ old('price', $products->price) }}" placeholder="Prix du Produit">
    </div>
    <div class="form-example">
        <label for="prix">Stock: </label>
        <input type="number" name="stock" value="{{ old('stock', $products->stock) }}" placeholder="Stock">
    </div>
    <div class="form-example">
        @if($products->image == null )
            <p>Image : <img src="/image/notAvailable.png"/></p>
        @else
            <p>Image : <img src="{{ URL::to($products->image) }}"/></p>
        @endif
        <input type="file" name="image" class="input" value="{{ old('image', $products->image) }}">
    </div>

    <div class="form-example">
        <input type="submit" value="Mettre à Jour">
    </div>
</form>
</body>
</html>
