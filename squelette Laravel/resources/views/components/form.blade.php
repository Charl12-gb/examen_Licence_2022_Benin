@extends('layouts.app')

@section('form')
<div class="container">
    <!-- Si nous avons un Post $post -->
    @if (isset($cluster))
        <h1>Editer un cluster</h1>
        <!-- Le formulaire est géré par la route "posts.update" -->
        <form method="POST" action="" enctype="multipart/form-data">

        @else
            <h1>Créer un cluster</h1>
            <!-- Le formulaire est géré par la route "posts.store" -->
            <form method="POST" action="" enctype="multipart/form-data">
    @endif

    <!-- Le token CSRF -->
    @csrf

    <div class="mb-3">
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">Nom</label>
                <input type="text" class="form-control" placeholder="First name" aria-label="First name">
            </div>
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">Prénoms</label>
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
            </div>
          </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Select</label>
        <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nom </label>
        <input type="text" class="form-control" id="nomCluster" value="{{ isset($cluster->nomCluster) ? $cluster->nomCluster : old('nomCluster') }}" name="nomCluster" placeholder="Nom cluster">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
    <div class="mb-3">
        <!-- S'il y a une image $post->picture, on l'affiche -->
        @if (isset($cluster->imgCluster))
            <p>
                <span>Couverture actuelle</span><br />
                <img src="{{ asset('storage/' . $cluster->imgCluster) }}" alt="image de couverture actuelle"
                    style="max-height: 200px;">
            </p>
        @endif

        <p>
            <label for="picture">Image Cluster</label><br />
            <input type="file" name="imgCluster" id="imgCluster">
        </p>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">{{ isset($cluster) ? "Mettre à jour" : "Enregistrer" }}</button>
      </div>
    </form>
</div>
@endsection
