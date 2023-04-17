@extends('layout.full')
@section('title', 'Mot de passe oublié')
@section('page-style')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->
    <style>
        .blank-page {
            background-image: url("{{ url('/app-assets/images/background/care.jpg') }}");
            height: 100%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
@endsection
@section('content')
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <h2 class="brand-text text-primary ml-1">{{ config('app.name') }}</h2>
                    </a>
                    <h4 class="card-title mb-1 text-center">Mot de passe oublié ?</h4>
                    <p class="card-text mb-2 text-center">
                        Veuillez saisir votre adresse e-mail pour récuperer votre mot de passe.
                    </p>
                    @if (isset($message))
                        <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body">
                                <i class="fa fa-check mr-1"></i>
                                <span>{{ $message }}</span>
                            </div>
                        </div>
                    @endif
                    <form class="auth-login-form mt-1" action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                                    aria-describedby="E-mail" tabindex="1" autofocus value="{{ old('email') }}"
                                    required />
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('email') }}</li>
                            </span>
                        @endif

                        <button type="submit" class="btn btn-primary btn-block mb-1" tabindex="4">Envoyer</button>
                        <p class="text-center mt-2">
                            <a href="{{ route('login') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-left">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                                Retour à la page connexion
                            </a>
                        </p>
                    </form>
                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
@endsection

@section('page-script')

@endsection
