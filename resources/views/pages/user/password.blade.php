@extends('layout.full')
@section('title', 'Modifier mot de passe')
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

                    <h4 class="card-title mb-1 text-center">Modification mot de passe </h4>

                    <form class="auth-login-form mt-1" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $userPassword->user_id }}">
                        <input type="hidden" name="id" value="{{ $userPassword->id }}">
                        <div class="form-group mb-1">
                            <div class="d-flex justify-content-between">
                                <label for="password">Nouveau mot de passe</label>
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
                                    <span class="input-group-text cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span id="reset-password-confirm-error"
                                    class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-1">
                            <div class="d-flex justify-content-between">
                                <label for="password_confirmation">Confirmation</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control form-control-merge" id="password_confirmation"
                                    name="password_confirmation" tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password_confirmation" required />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span id="reset-password-confirm-error"
                                    class="error">{{ $errors->first('password_confirmation') }}</span>
                            @endif

                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-1" tabindex="4">Valider</button>
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
