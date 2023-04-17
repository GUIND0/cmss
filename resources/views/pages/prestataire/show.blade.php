@extends('layout.main')

@section('title', "Détail prestataire : ".$prestataire->libelle)

@section('content')
<div class="card">
    <div class="card-body">
        @if ($medecin_prestataires->isNotEmpty())
        <h3 class="text-bold">Medecins prestataires : </h3>
        <div class="row d-flex justify-content-center">
             @foreach ($medecin_prestataires as $medecin )
                <div class="col-md-3 col-sm-12 kb-search-content">
                    <div class="card border-primary">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex justify-content-start">
                                <img class="img-fluid rounded" src="{{ asset('app-assets/images/avatars/profil.jpg') }}" height="100" width="100" alt="User avatar" />
                                <div class="d-flex d-sm-flex flex-column ml-1" style="overflow: hidden;">
                                    <div class="user-info mb-1">
                                        <h4 class="mb-0" >{{ $medecin->medecin_libelle}}</h4>
                                        <span class="card-text"><i data-feather="user" class="mr-1"></i>{{ $medecin->genre }}</span><br>
                                        @if ($medecin->email)
                                        <span class="card-text"><i data-feather="mail" class="mr-1"></i>{{ $medecin->email }}</span><br>
                                        @endif
                                        @if ($medecin->telephone)
                                        <span class="card-text"><i data-feather="phone" class="mr-1"></i>{{ $medecin->telephone }}</span>
                                        @endif


                                    </div>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
            @endforeach

        </div>
        @endif

        @if ($compagnie_prestataires->isNotEmpty())
        <h3 class="text-bold">Compagnies prestataires : </h3>
        <div class="row d-flex justify-content-center">
            @foreach ($compagnie_prestataires as $compagnie_prestataire)
                    <div class="col-md-3 col-12 kb-search-content">
                        <div class="card border-primary">
                                @if ($compagnie_prestataire->logo != null && $compagnie_prestataire->logo != "")
                                    <img src="/{{$compagnie_prestataire->logo}}" width="200" height="130" class="card-img-top">
                                @else
                                    <img src="{{ asset('app-assets/images/background/care.jpg')}}" width="200" height="130" class="card-img-top">
                                @endif
                                <div class="card-body text-center" style="border-top: 1px solid blue">
                                    <h4>{{ $compagnie_prestataire->libelle }}</h4>
                                    <h3>{{ $compagnie_prestataire->code }}</h3>
                                </div>
                        </div>
                    </div>
            @endforeach

        </div>
    </div>
</div>
@endif
@endsection
