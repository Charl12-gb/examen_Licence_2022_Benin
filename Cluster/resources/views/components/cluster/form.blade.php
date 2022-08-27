@extends('layouts.app')

@section('cluster_form')
<div class="container">
    <!-- Si nous avons un Post $post -->
    @if (isset($cluster))
        <h1>Editer un cluster</h1>
        <!-- Le formulaire est géré par la route "posts.update" -->
        <form method="POST" action="{{ route('cluster.update', ['id'=>$cluster->id]) }}" enctype="multipart/form-data">

        @else
            <h1>Créer un cluster</h1>
            <!-- Le formulaire est géré par la route "posts.store" -->
            <form method="POST" action="{{ route('cluster.store') }}" enctype="multipart/form-data">
    @endif

    <!-- Le token CSRF -->
    @csrf

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Filiere</label>
        <select class="form-select" name="filiere" id="filiere">
            <option selected>Selectionner filiere</option>
            @forelse ($filieres as $filiere)
                <option value="{{ $filiere->id }}" <?php if( isset( $cluster ) ) { if( $cluster->filiere->id == $filiere->id ) echo 'selected'; } ?> >{{ $filiere->nomFiliere }}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Departement</label>
        <select class="form-select" name="departement" id="departement" onchange="gCommune(this.value, 'commune')">
            <option selected>Selectionner un departement</option>
            @forelse ($departements as $departement)
                <option value="{{ $departement->id }}">{{ $departement->nomDepartement }}</option>
            @empty
            @endforelse
        </select>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Commune</label>
        <select class="form-select" name="commune" id="commune" onchange="gCommune(this.value, 'arrondissement')">
            <option selected>Selectionner commune</option>
            @forelse ($communes as $commune)
                <option value="{{ $commune->id }}">{{ $commune->nomCommune }}</option>
            @empty
            @endforelse
        </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Arrondissement</label>
            <select class="form-select" name="arrondissement" id="arrondissement" onchange="gCommune(this.value, 'village')">
                <option selected>Selectionner arrondissement</option>
                @forelse ($arrondissements as $arrondissement)
                    <option value="{{ $arrondissement->id }}">{{ $arrondissement->nomArrondissement }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Village</label>
        <select class="form-select" name="village" id="village">
            <option selected>Selectionner village</option>
            @forelse ($villages as $village)
                <option value="{{ $village->id }}" <?php if( isset( $cluster ) ) { if( $cluster->village->id == $village->id ) echo 'selected'; } ?>>{{ $village->nomVillage }}</option>
            @empty
            @endforelse
        </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nom Cluster</label>
        <input type="text" class="form-control" id="nomCluster" value="{{ isset($cluster->nomCluster) ? $cluster->nomCluster : old('nomCluster') }}" name="nomCluster" placeholder="Nom cluster">
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
<script>
    function gCommune(departement, categorie){
        if( departement.length == 0 ){
            return;
        }else{
            var xmlhtpp = new XMLHttpRequest();
            var selectElement = document.getElementById(categorie);
            xmlhtpp.onreadystatechange = function(){
                if( this.readyState == 4 && this.status == 200 ){
                    selectElement.innerHTML = this.responseText;
                }
            };
            var routeUrl;
            if( categorie == 'commune' ){
                document.getElementById('commune').innerHTML = '<option selected>Selectionner une commune</option>';
                document.getElementById('arrondissement').innerHTML = '<option selected>Selectionner un Arrondissement</option>';
                document.getElementById('village').innerHTML = '<option selected>Selectionner un village</option>';
                routeUrl = "{{ url('cluster.commune') }}/" + departement;
            }
            else if( categorie == 'arrondissement' ){
                document.getElementById('arrondissement').innerHTML = '<option selected>Selectionner un Arrondissement</option>';
                document.getElementById('village').innerHTML = '<option selected>Selectionner un village</option>';
                routeUrl = "{{ url('cluster.arrondissement') }}/" + departement;
            }
            else{
                document.getElementById('village').innerHTML = '<option selected>Selectionner un village</option>';
                routeUrl = "{{ url('cluster.village') }}/" + departement;
            }

            xmlhtpp.open("GET",routeUrl,true);
            xmlhtpp.send();
        }
    }
</script>
@endsection
