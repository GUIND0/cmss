@extends('layout.main')

@section('title', "Médecin détails: ")

@section('content')
<div class="row d-flex justify-content-center">
    <!-- Plan Card starts-->
    <div class="d-flex flex-column ml-1 col-md-4 col-xs-12  col-md-6 ">
        <div class="card plan-card border-primary">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start" >
                        <img class="img-fluid rounded" src="{{ asset('app-assets/images/avatars/profil.jpg') }}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1" style="overflow: hidden;">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">{{ $medecin->prenom }} {{ $medecin->nom }}</h4>
                                <span class="card-text"><i data-feather="star" class="mr-1"></i>{{ $medecin->specialite->libelle }}</span><br>
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
    <!-- /Plan CardEnds -->
    <!-- User Card starts-->

</div>

<h3 class="text-bold">Les prestataires : </h3>
<div class="row d-flex justify-content-center">

    @foreach ($medecin_prestataires as $item)
            <div class="col-md-4 col-xs-12 col-6 kb-search-content" style="overflow: hidden;">
                <div class="card">
                    <a href="">
                        @if ($item->prestataire_logo != null && $item->prestataire_logo != "")
                            <img src="{{$item->prestataire_logo}}" width="200" height="130" class="card-img-top">
                        @else
                            <img src="{{ asset('app-assets/images/background/care.jpg')}}" width="200" height="130" class="card-img-top">
                        @endif
                        <div class="card-body text-center" >
                            <h4>{{ $item->prestataire_libelle }}</h4>
                            <h3>{{ $item->prestataire_code }}</h3>

                            @if ($item->prestataire_pharmacie === 1)
                               <span class="badge badge-primary badge-glow" >PHARMACIE</span>
                            @endif
                            @if ($item->prestataire_hopital === 1)
                                <span class="badge badge-primary badge-glow">Hopital</span>
                            @endif
                            @if ($item->prestataire_examen === 1)
                                <span class="badge badge-primary badge-glow">EXAMEN</span>
                            @endif

                        </div>
                    </a>
                </div>
            </div>
    @endforeach

</div>
@endsection
