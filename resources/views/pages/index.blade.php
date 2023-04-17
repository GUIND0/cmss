@extends('layout.principal')

@section('title', 'Accueil')

@section('page-style')
    <style>
        .card:hover {
            box-shadow: 8px 8px 8px;
            transform: scale(1.01);
        }

        a {
            color: transparent;
        }

        a:hover {
            color: #b9b9c3;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('compagnie.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Gestion des compagnies</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-building font-medium-5"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('feuille.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0"> feuilles de soins</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-file-text-o font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('medecin.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Gestion des medecins</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-user-md font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('prestataire.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Gestion des prestataires</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-user font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('agence.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Gestion des agences</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="fa fa-home font-medium-5"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('prestation.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Gestion des prestations</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="command" class="font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('user.index') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Administration</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="users" class="font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('dashboard') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="font-weight-bolder mb-0">Tableau de board</h3>
                            <p class="card-text"></p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="activity" class="font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

    </script>
@endsection
