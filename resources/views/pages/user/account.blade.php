@extends('layout.main')

@section('title', 'Mon Compte')

@section('first')
  <a href="#">Accueil</a>
@endsection
@section('second')
  <a href="#">Utilisateur</a>
@endsection
@section('third')
  <a href="#">Mon Compte</a>
@endsection

@section('page-style')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- account setting page -->
                        <section id="page-account-settings">
                            <div class="row">
                                <!-- left menu section -->
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <ul class="nav nav-pills flex-column nav-left">
                                        <!-- general -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ ($actif==1)? 'active':'' }}" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                                <span class="font-weight-bold">Information générale</span>
                                            </a>
                                        </li>
                                        <!-- change password -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ ($actif==2)? 'active':'' }}" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                                <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                                <span class="font-weight-bold">Mot de passe</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ left menu section -->
                                <!-- right content section -->
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <!-- general tab -->
                                                <div role="tabpanel" class="tab-pane {{ ($actif==1)? 'active':'' }}" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                    <!-- header media -->
                                                    <div class="media">
                                                        <a href="javascript:void(0);" class="mr-25">
                                                            @if(json_decode(auth()->user()->photo) != "")
                                                                <img src="{{ url('uploads/user/photo/'.json_decode(auth()->user()->photo)) }}" class="rounded mr-50" alt="Photo" height="80" width="80" />
                                                            @else
                                                                <img src="{{ url('app-assets/images/avatars/profil.jpg')}}" class="rounded mr-50" alt="avatar" height="80" width="80" />
                                                            @endif
                                                        </a>
                                                        <!-- upload and reset button -->
                                                        <div class="media-body mt-75 ml-1">
                                                            <span class="user-name font-weight-bolder">{{ auth()->user()->prenom." ".auth()->user()->nom}}</span>
                                                            <p></p>
                                                        </div>
                                                        <!--/ upload and reset button -->
                                                    </div>
                                                    <!--/ header media -->

                                                    <!-- form -->
                                                    <form action="{{ route('user.info') }}" method='POST' class="validate-form mt-2" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="Téléphone">Téléphone <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" value="{{ auth()->user()->telephone }}" />
                                                                    @if($errors->has('telephone'))
                                                                    <span class="help-block text-danger">
                                                                        <ul role="alert"><li>{{ $errors->first('telephone') }}</li></ul>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
                                                                <button type="reset" class="btn btn-outline-danger mt-2 ml-1">Annuler</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--/ form -->
                                                </div>
                                                <!--/ general tab -->
                                                <!-- change password -->
                                                <div role="tabpanel" class="tab-pane {{ ($actif==2)? 'active':'' }}" id="account-vertical-password"  aria-labelledby="account-pill-password" aria-expanded="false">
                                                    <!-- form -->
                                                    <form action="{{ route('user.password') }}" method='POST' class="validate-form">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="ancien_mot_de_passe">Ancien mot de passe <span class="text-danger">*</span></label>
                                                                    <div class="input-group form-password-toggle input-group-merge">
                                                                        <input type="password" class="form-control {{ $errors->has('ancien_mot_de_passe') ? 'is-invalid' : '' }}" id="ancien_mot_de_passe" name="ancien_mot_de_passe" placeholder="Ancien mot de passe" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text cursor-pointer">
                                                                                <i data-feather="eye"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('ancien_mot_de_passe'))
                                                                    <span class="help-block text-danger">
                                                                        <ul role="alert"><li>{{ $errors->first('ancien_mot_de_passe') }}</li></ul>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="password">Nouveau mot de passe <span class="text-danger">*</span></label>
                                                                    <div class="input-group form-password-toggle input-group-merge">
                                                                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Nouveau mot de passe" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text cursor-pointer">
                                                                                <i data-feather="eye"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('password'))
                                                                        <span class="help-block text-danger">
                                                                            <ul role="alert"><li>{{ $errors->first('password') }}</li></ul>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="password_confirmation">Confirmation <span class="text-danger">*</span></label>
                                                                    <div class="input-group form-password-toggle input-group-merge">
                                                                        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="Confirmation" />
                                                                        <div class="input-group-append">
                                                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('password_confirmation'))
                                                                        <span class="help-block text-danger">
                                                                            <ul role="alert"><li>{{ $errors->first('password_confirmation') }}</li></ul>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary mt-1">Enregistrer</button>
                                                                <button type="reset" class="btn btn-outline-danger mt-1 ml-1">Annuler</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!--/ form -->
                                                </div>
                                                <!--/ change password -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ right content section -->
                            </div>
                        </section>
                    <!-- / account setting page -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

    </script>
@endsection
