@extends('layouts.app')

@section('form')
    <div class="container">
        <!-- Si nous avons un Post $post -->
        @if (isset($oeuvre))
            <h1>Editer une oeuvre</h1>
            <!-- Le formulaire est géré par la route "posts.update" -->
            <form method="POST" action="{{ route('oeuvre.update', ['id'=>$oeuvre->id]) }}" enctype="multipart/form-data">
            @else
                <h1>Créer une oeuvre</h1>
                <!-- Le formulaire est géré par la route "posts.store" -->
                <form method="POST" action="{{ route('oeuvre.store') }}" enctype="multipart/form-data">
        @endif

        <!-- Le token CSRF -->
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nom Oeuvre </label>
            <input type="text" class="form-control" id="nom"
                value="{{ isset($oeuvre->nom) ? $oeuvre->nom : old('nom') }}" name="nom"
                placeholder="Nom oeuvre">
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Artiste</label>
                    <select class="form-select" name="artiste" id="artiste" aria-label="Default select example">
                        <option selected>Selectionner un artiste</option>
                        @if ($artistes->count() > 0)
                            @foreach ($artistes as $artiste)
                                <option <?php if( isset( $oeuvre ) ) { if( $oeuvre->artiste->id == $artiste->id ) echo 'selected'; } ?> value="{{ $artiste->id }}">{{ $artiste->nom }} {{ $artiste->prenom }}</option>
                            @endforeach
                        @else
                            <option value="">Pas d'artiste</option>
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Catégorie</label>
                    <select class="form-select" name="categorie" id="categorie" aria-label="Default select example">
                        <option selected>Selectionner une catégorie</option>
                        @if ($categories->count() > 0)
                            @foreach ($categories as $categorie)
                                <option <?php if( isset( $oeuvre ) ) { if( $oeuvre->categorie->id == $categorie->id ) echo 'selected'; } ?> value="{{ $categorie->id }}">{{ $categorie->nomCategorie }}</option>
                            @endforeach
                        @else
                            <option value="">Pas de catégorie</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Année</label>
            <input type="text" class="form-control" id="annee"
                value="{{ isset($oeuvre->annee) ? $oeuvre->annee : 1960 }}" name="annee"
                placeholder="Annee">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ isset($oeuvre->description) ? $oeuvre->description : old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <!-- S'il y a une image $post->picture, on l'affiche -->
            @if (isset($oeuvre->image))
                <p>
                    <span>Image actuelle</span><br />
                    <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="image de couverture actuelle"
                        style="max-height: 200px;">
                </p>
            @endif

            <p>
                <label for="picture">Image Oeuvre</label><br />
                <input type="file" name="image" id="image">
            </p>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">{{ isset($oeuvre) ? 'Mettre à jour' : 'Enregistrer' }}</button>
        </div>
        </form>
    </div>
@endsection
