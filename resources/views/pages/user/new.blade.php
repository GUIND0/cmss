@extends('layout.main')
@section('title', 'Gestion des utilisateurs')

@section('page-style')
<style>
    input[type=radio]{
  transform:scale(1.5);
}
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('user.store') }}" method='POST' role="form" id="form" class="form-horizontal" enctype="multipart/form-data">
            @csrf
             <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
            <div class="card card-box">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                                        value="{{  $user != null ? $user->prenom : old('prenom') }}" placeholder="Prénom" required/>
                                @if($errors->has('prenom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('prenom') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                        value="{{ $user != null ? $user->nom : old('nom') }}" placeholder="Nom" required/>
                                @if($errors->has('nom'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('nom') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Genre">Genre <span class="text-danger">*</span></label>
                                <select data-placeholder="Choisir genre ..." class="select2 form-control" id="genre" name="genre" required>
                                    <option></option>
                                    <option value="Homme" {{ $user != null ? $user->genre == "Homme" : old('genre') == "Homme" ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ $user != null ? $user->genre == "Femme": old('genre') == "Femme" ? 'selected' : '' }}>Femme</option>
                                </select>
                                @if($errors->has('genre'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('genre') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">E-mail <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ $user != null ? $user->email : old('email') }}" placeholder="E-mail" required/>
                                @if($errors->has('email'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('email') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Téléphone </label>
                                <input type="number" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                                        value="{{ $user != null ? $user->telephone : old('telephone') }}" placeholder="Téléphone" onKeyPress="if(this.value.length==8) return false;"/>
                                @if($errors->has('telephone'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('telephone') }}</li>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profil">Profil <span class="text-danger">*</span></label>
                                <select  class="select2 form-control" id="profil" name="profil" onchange='ShowChoice()' required>
                                    <option value="none">Choisir un profil...</option>
                                    <option value="admin" {{ $user != null ? $user->profil == 'admin' ? 'selected' : '' : old('profil') == "admin" ? 'selected' : '' }}>Admin</option>
                                    <option value="admin_local" {{ $user != null ? $user->profil == 'admin_local' ? 'selected' : '' : old('profil') == "admin_local" ? 'selected' : '' }}>Admin local</option>
                                </select>
                                @if($errors->has('profil'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('profil') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-6" id="block_type_profil" style="{{ $user != null ? ($user->profil == "admin_local") ? 'display: block;' : 'display: none;' : 'display: none;' }}">
                            <div class="form-group">
                                <label for="profil">Type Profil <span class="text-danger">*</span></label>
                                <select  class="select2 form-control" id="type_profil" name="type_profil" onchange='ShowProfil()' required>
                                    <option value="none">Choisir un type de profil...</option>
                                    <option value="prestataire" {{ $user != null ? ($user->prestataire_id != '' && $user->prestataire_id != null) ? 'selected' : '' : '' }}>Prestataire</option>
                                    <option value="compagnie" {{ $user != null ? ($user->compagnie_id != '' && $user->compagnie_id != null) ? 'selected' : '' : '' }}>Compagnie</option>
                                </select>
                                @if($errors->has('profil'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('profil') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>




                        <div class="col-md-6" style="{{ $user != null ? ($user->prestataire_id != "" && $user->prestataire_id != null && $user->prestataire_id != 'none') ? 'display: block;' : 'display: none;' : 'display: none;' }}" id="block_prestataire">
                            <div class="form-group">
                                <label for="prestataire">Prestataire <span class="text-danger">*</span></label>
                                <select  class="select2 form-control" id="prestataire" name="prestataire" required>
                                    <option value="none">Choisir un prestaire...</option>
                                    @foreach ($prestataires as $prestataire)
                                        <option {{ $user != null ? $user->prestataire_id == $prestataire->id ? 'selected' : '' : old('prestataire') == $prestataire->id ? 'selected' : '' }} value="{{ $prestataire->id }}">{{ $prestataire->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('prestataire'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('prestataire') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6" style="{{ $user != null ? ($user->compagnie_id != "" && $user->compagnie_id != null && $user->compagnie_id != 'none') ? 'display: block;' : 'display: none;' : 'display: none;' }}" id="block_compagnie">
                            <div class="form-group">
                                <label for="compagnie">Compagnie <span class="text-danger">*</span></label>
                                <select  class="select2 form-control" id="compagnie" name="compagnie" required>
                                    <option value="none">Choisir une compagnie...</option>
                                    @foreach ($compagnies as $compagnie)
                                        <option {{ $user != null ? $user->compagnie_id == $compagnie->id ? 'selected' : '' : old('compagnie') == $compagnie->id ? 'selected' : '' }} value="{{ $compagnie->id }}">{{ $compagnie->libelle }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('compagnie'))
                                <span class="help-block text-danger">
                                    <ul role="alert"><li>{{ $errors->first('compagnie') }}</li></ul>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="invoice-terms mt-1">
                                <div class="d-flex justify-content-between">
                                    <label class="invoice-terms-title mb-0" for="paymentTerms">Etat compte</label>
                                    <div class="custom-control custom-switch">
                                        <input {{ old('actif') === "on" ? 'checked':''}} {{  $user != null ? $user->active == 1 ? 'checked' : '': '' }} id="paymentTerms" type="checkbox"  id="actif"  name="actif" class="custom-control-input"/>
                                        <label class="custom-control-label" for="paymentTerms"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div style="{{ $user != null ? ($user->profil == "admin_local") ? 'display: block;' : 'display: none;' : 'display: none;' }}" id="choix">
                        <div class="row mt-1 d-flex justify-content-around">
                            <div>
                                <input class="form-check-input" type="radio" name="mode" id="prestataire_radio" value="prestataire" {{ $user != null ? ($user->compagnie_id != "" && $user->compagnie_id != null && $user->compagnie_id != 'none') ? '' : 'checked' : 'checked' }}>
                                <label class="form-check-label" for="mode">
                                   Prestataire
                                </label>
                            </div>


                            <div>
                                <input class="form-check-input" type="radio" name="mode" id="compagnie_radio" value="compagnie" {{ $user != null ? ($user->compagnie_id != "" && $user->compagnie_id != null && $user->compagnie_id != 'none') ? 'checked' : '' : '' }}>
                                <label class="form-check-label" for="exampleRadios10">
                                    Compagnie
                                </label>
                            </div>
                        </div>
                    </div> --}}



                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="offset-md-1 col-md-12 ml-1">
                            <button type="submit" class="btn btn-gradient-primary">Enregistrer</button>
                            <button type="reset" class="btn btn-outline-danger ml-1">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

        $(document).ready(function(){

            var profil = document.getElementById('profil');
            var choix = document.getElementById('choix');
            var hidden_type = document.getElementById('hidden_type');
            var prestataire_radio = document.getElementById('prestataire_radio');
            var compagnie_radio = document.getElementById('compagnie_radio');


            if(profil.value === 'admin_local'){
                choix.style.display = 'block';
            }


            // $('input:radio[name="mode"]').change(function(){

            //     if($('input:radio[name="mode"]').is(':checked') && $(this).val() == 'compagnie') {

            //         $('#block_compagnie').css("display", "block");
            //         $('#block_prestataire').css("display", "none");
            //     }

            //     if($('input:radio[name="mode"]').is(':checked') && $(this).val() == 'prestataire') {

            //          $('#block_prestataire').css("display", "block");
            //         $('#block_compagnie').css("display", "none");
            //     }
            // });


        });

        function ShowProfil(){
            var block_type_profil =  document.getElementById('type_profil');
            var block_compagnie   =  document.getElementById('block_compagnie');
            var block_prestataire =  document.getElementById('block_prestataire');

            if(block_type_profil.value === 'none'){
                block_prestataire.style.display = 'none';
                block_compagnie.style.display = 'none';
            }

            if(block_type_profil.value === 'prestataire'){
                block_prestataire.style.display = 'block';
                block_compagnie.style.display = 'none';
            }else{
                block_prestataire.style.display = 'none';
                block_compagnie.style.display = 'block';

            }

        }

        function ShowChoice(){

                var block_type_profil =  document.getElementById('block_type_profil');
                var choix = document.getElementById('choix');
                var profil = document.getElementById('profil');
                var block_prestataire = document.getElementById('block_prestataire');
                var block_compagnie = document.getElementById('block_compagnie');
                if(profil.value === 'admin_local'){
                    block_type_profil.style.display = 'block';

                }else{
                    block_type_profil.style.display = 'none';
                    block_prestataire.style.display = 'none';
                    block_compagnie.style.display = 'none';

                }
        }




    </script>
@endsection
