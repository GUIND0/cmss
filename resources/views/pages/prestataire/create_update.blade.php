@extends('layout.main')

@section('title', 'Gestion des Prestataires')

@section('content')
<div class="row">
    {{--create form --}}
    <div class="col-md-12">
        <form action="{{ route('prestataire.store') }}" enctype="multipart/form-data" method='POST' role="form" id="form" class="form-horizontal">
            @csrf
        <input type="hidden" name="id" value="{{ $prestataire->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="form-group">
                            <label class="control-label">Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                    value="{{ $prestataire != null ? $prestataire->code : old('code') }}" placeholder="Code" required/>
                            @if($errors->has('code'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('code') }}</li>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}"
                                    value="{{ $prestataire != null ? $prestataire->libelle : old('libelle') }}" placeholder="Libellé" required/>
                            @if($errors->has('libelle'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('libelle') }}</li>
                            </span>
                            @endif
                        </div>

                            <div class="form-group">
                                <label class="control-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}"
                                        value="{{ $prestataire != null ? $prestataire->latitude : old('latitude') }}" placeholder="Latitude" required/>
                                @if($errors->has('latitude'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('latitude') }}</li>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}"
                                        value="{{ $prestataire != null ? $prestataire->longitude : old('longitude') }}" placeholder="longitude" required/>
                                @if($errors->has('longitude'))
                                <span class="help-block text-danger">
                                    <li>{{ $errors->first('longitude') }}</li>
                                </span>
                                @endif
                            </div>

                            
                        <div class="form-group">
                            <img id="preview-image-before-upload" class="img-fluid" src="{{ $prestataire != null ? ($prestataire->logo != '' && $prestataire->logo != null) ? $prestataire->logo : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                            alt="preview image" style="max-height: 150px;">
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo </label>
                            <input accept="image/png, image/gif, image/jpeg" type="file" class="form-control" id="logo" name="logo" placeholder="logo" value="{{ $prestataire != null ? $prestataire->logo : old('logo') }}" />
                            @if($errors->has('logo'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('logo') }}</li></ul>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="destinataire" class="mt-1">Medecin</label>
                            <select class="select2 form-control" name="medecins_id[]" multiple>
                                @foreach($medecins as $medecin)
                                    @if ($medecin)
                                        @if(in_array($medecin->id, $idm) || in_array($medecin->id, old('medecins_id') != null ? old('medecins_id') : $idm))
                                            <option value="{{ $medecin->id }}" selected="true">{{ $medecin->nom.' '.$medecin->prenom }}</option>
                                        @else
                                            <option value="{{ $medecin->id }}">{{ $medecin->nom.' '.$medecin->prenom }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $medecin->id }}">{{ $medecin->nom.' '.$medecin->prenom}}</option>
                                    @endif
                                @endforeach
                            </select>
                                @if($errors->has('medecins_id'))
                                    <span class="help-block text-danger">
                                        <li>{{ $errors->first('medecins_id') }}</li>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="destinataire" class="mt-1">Compagnie</label>
                            <select class="select2 form-control" name="compagnies_id[]" multiple>
                                @foreach($compagnies as $compagnie)
                                    @if ($compagnie)
                                        @if(in_array($compagnie->id, $idc) || in_array($compagnie->id, old('compagnies_id') != null ? old('compagnies_id') : $idc))
                                        <option value="{{ $compagnie->id }}" selected="true">{{ $compagnie->libelle}}</option>
                                        @else
                                        <option value="{{ $compagnie->id }}">{{ $compagnie->libelle}}</option>
                                        @endif
                                    @else
                                     <option value="{{ $compagnie->id }}">{{ $compagnie->libelle}}</option>
                                    @endif
                                @endforeach
                            </select>
                                @if($errors->has('compagnies_id'))
                                    <span class="help-block text-danger">
                                        <li>{{ $errors->first('compagnies_id') }}</li>
                                    </span>
                                @endif
                        </div>
                        <div class="invoice-terms mt-1">
                            <div class="d-flex justify-content-between">
                                <label class="invoice-terms-title mb-0" for="paymentTerms">Pharmacie</label>
                                <div class="custom-control custom-switch">
                                    <input {{ old('pharmacie')== "on" ? 'checked':''}} {{  $prestataire != null ? $prestataire->pharmacie == 1 ? 'checked' : '': '' }}  type="checkbox"  id="pharmacie"  name="pharmacie" class="custom-control-input"/>
                                    <label class="custom-control-label" for="pharmacie"></label>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-terms mt-1">
                            <div class="d-flex justify-content-between">
                                <label class="invoice-terms-title mb-0" for="paymentTerms">Hopital</label>
                                <div class="custom-control custom-switch">
                                    <input {{ old('hopital')== "on" ? 'checked':''}} {{  $prestataire != null ? $prestataire->hopital == 1 ? 'checked' : '': '' }}  type="checkbox"  id="hopital"  name="hopital" class="custom-control-input"/>
                                    <label class="custom-control-label" for="hopital"></label>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-terms mt-1">
                            <div class="d-flex justify-content-between">
                                <label class="invoice-terms-title mb-0" for="paymentTerms">Examen</label>
                                <div class="custom-control custom-switch">
                                    <input {{ old('examen')== "on" ? 'checked':''}} {{  $prestataire != null ? $prestataire->examen == 1 ? 'checked' : '': '' }}  type="checkbox"  id="examen"  name="examen" class="custom-control-input"/>
                                    <label class="custom-control-label" for="examen"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 col-md-12 ml-1">
                        <button type="submit" class="btn btn-gradient-primary mt-1">Enregistrer</button>
                        <button type="reset" class="btn btn-outline-danger mt-1">Annuler</button>
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
    $(document).ready(function (e) {


        $('#logo').change(function(){

        let reader = new FileReader();

        reader.onload = (e) => {

        $('#preview-image-before-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

        });

    });
</script>
@endsection
