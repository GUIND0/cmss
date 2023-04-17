@extends('layout.full')

@section('title','Erreur 404')

@section('page-style')
@endsection  

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <a class="navbar-brand" href="{{ route("home") }}">
            <h2 class="brand-logo text-primary mt-1 ml-1">
                {{ config('app.name') }}
            </h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">Objet non trouvé</h2>
                <p class="mb-2">
                    La ressource demandée est introuvable.
                </p>
                <a class="btn btn-primary mb-1 btn-sm-block" href="{{ route("home") }}"> <i class="fa fa-arrow-left"></i> Retour à l'accueil</a>
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection 

@section('page-script')

@endsection