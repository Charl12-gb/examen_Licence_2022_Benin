@extends('layouts.app')

@section('cluster_show')
    <h1 class="container">Cluster Détails</h1>
    <div class="container">
        <div class="card mb-3" style="max-width: 2040px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('storage/' . $cluster->imgCluster) }}" class="img-fluid rounded-start" alt="{{ $cluster->nomCluster }}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><strong>{{ $cluster->nomCluster }}</strong></h5>
                  <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi eligendi officia eius officiis necessitatibus, mollitia deserunt? Esse eaque accusantium saepe alias hic quae magni veritatis dicta praesentium. Cupiditate, voluptatibus deserunt.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi labore quibusdam praesentium neque. Quia laboriosam quod, neque eveniet a voluptatem illum itaque error ex harum, quasi eaque odio similique nihil!
                  </p>
                  <p class="card-text"><span>Filiere : {{ $cluster->filiere->nomFiliere }}</span> <br> <span>Village : {{ $cluster->village->nomVillage }}</span> </p>
                  <p class="card-text"><small class="text-muted">Créé le : {{ $cluster->created_at->format('D d-m-Y à H:i') }}</small></p>
                </div>
              </div>
            </div>
          </div>
    </div>

@endsection
