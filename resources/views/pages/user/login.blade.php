@extends('layout.full')
@section('title', 'Authentification')
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
                    <h4 class="card-title mb-1 text-center">Authentification</h4>
                    @if (isset($message))
                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body">
                                <i class="fa fa-check mr-1"></i>
                                <span>{{ $message }}</span>
                            </div>
                        </div>
                    @endif
                    <form autocomplete="off" class="auth-login-form mt-1" action="#" method="POST">
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
                        <div class="form-group mb-1">
                            <div class="d-flex justify-content-between">
                                <label for="password">Mot de passe</label>
                                <a href="{{ route('mot_de_passe.form') }}">
                                    <small>Mot de passe oublié?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control form-control-merge" id="password" name="password"
                                    tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="Password" required />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('login') or $errors->has('password'))
                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                <div class="alert-body">
                                    <i data-feather='alert-circle'></i>
                                    <span> {{ $errors->first() }}</span>
                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary btn-block mb-1" tabindex="4">Connexion</button>
                    </form>
                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endsection
