@extends('layouts.app')

@section('show')
    <h1 class="container">Oeuvre Détails</h1>
    <div class="container">
        <div class="card mb-3" style="max-width: 2040px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('storage/' . $oeuvre->image) }}" class="img-fluid rounded-start" alt="Image">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><strong>{{ $oeuvre->nom }}</strong></h5>
                  <p class="card-text">
                    {{ $oeuvre->description }} <hr>
                    <strong>Année : {{ $oeuvre->annee }}</strong>
                  </p>
                  <p class="card-text"><span>Categorie : {{ $oeuvre->categorie->nomCategorie }}</span> <br> <span>Artiste : {{ $oeuvre->artiste->nom }} {{ $oeuvre->artiste->prenom }}</span> </p>
                  <p class="card-text"><small class="text-muted">Créé le : {{ $oeuvre->created_at->format('d-m-Y') }}</small></p>
                </div>
              </div>
            </div>
          </div>
    </div>

@endsection
