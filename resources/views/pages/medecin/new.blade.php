@extends('layout.main')

@section('title', 'Gestion des médécins')

@section('content')

<div class="row">
    {{--create form --}}
    <div class="col-md-12">
        <form action="{{ route('medecin.store') }}" method='POST' role="form" id="form" class="form-horizontal">
            @csrf
        <input type="hidden" name="id" value="{{ $medecin->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                   <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                    value="{{ $medecin != null ? $medecin->code : old('code') }}" placeholder="Code" required/>
                            @if($errors->has('code'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('code') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}"
                                    value="{{ $medecin != null ? $medecin->nom : old('nom') }}" placeholder="Nom" required/>
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
                            <label class="control-label">Prenom <span class="text-danger">*</span></label>
                            <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}"
                                    value="{{ $medecin != null ? $medecin->prenom : old('prenom') }}" placeholder="Prénom" required/>
                            @if($errors->has('prenom'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('prenom') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Genre">Genre <span class="text-danger">*</span></label>
                            <select data-placeholder="Choisir genre ..." class="select2 form-control"  id="genre" name="genre" required>
                                <option value="">Choisir genre ...</option>
                                <option value="Homme" {{ $medecin != null ? $medecin->genre =="Homme" : old('genre') == "Homme" ? 'selected' : '' }}>Homme</option>
                                <option value="Femme" {{ $medecin != null ? $medecin->genre =="Femme" : old('genre') == "Femme" ? 'selected' : '' }}>Femme</option>
                            </select>
                            @if($errors->has('genre'))
                            <span class="help-block text-danger">
                                <ul role="alert"><li>{{ $errors->first('genre') }}</li></ul>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Specialite <span class="text-danger">*</span></label>
                            <select class="form-control" name="medecin_specialite_id" id="medecin_specialite_id">
                                <option value="">Veuillez selectionner une specialité</option>
                                @foreach($medecin_specialites as $medecin_specialite)
                                    <option  value="{{ $medecin != null ? $medecin_specialite->id :  $medecin_specialite->id}}" {{  (old('medecin_specialite_id') == $medecin_specialite->id) || ($medecin ? ($medecin->medecin_specialite_id == $medecin_specialite->id) : false ) ? 'selected' : '' }}>{{$medecin_specialite->libelle}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('medecin_specialite_id'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('medecin_specialite_id') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">E-mail <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    value="{{ $medecin != null ? $medecin->email : old('email') }}" placeholder="E-mail" required/>
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
                            <input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                                    value="{{ $medecin != null ? $medecin->telephone : old('telephone') }}" placeholder="Téléphone"/>
                            @if($errors->has('telephone'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('telephone') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destinataire" class="mt-1">Prestataire</label>
                            <select class="select2 form-control" name="prestataires_id[]" multiple>
                                @foreach($prestataires as $prestataire)
                                    @if ($medecin)
                                        @if(in_array($prestataire->id, $ids))
                                        <option value="{{ $prestataire->id }}" selected="true">{{ $prestataire->libelle }}</option>
                                        @else
                                        <option value="{{ $prestataire->id }}">{{ $prestataire->libelle }}</option>
                                        @endif
                                    @else
                                     <option value="{{ $prestataire->id }}">{{ $prestataire->libelle }}</option>
                                    @endif
                                @endforeach
                            </select>
                                @if($errors->has('prestataires_id'))
                                    <span class="help-block text-danger">
                                        <li>{{ $errors->first('prestataires_id') }}</li>
                                    </span>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 col-md-12">
                        <button type="submit" class="btn btn-gradient-primary ml-1">Enregistrer</button>
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

        $('#table-javascript').bootstrapTable({
            data: @json($medecins),
            toolbar: "#toolbar",
            cache: false,
            striped: true,
            pagination: true,
            pageSize: 10,
            pageList: [10, 25, 50, 100, 200],
            sortOrder: "asc",
            sortName: "libelle",
            locale: "fr-FR",
            search: true,
            searchAlign : "right",
            minimumCountColumns: 2,
            clickToSelect: false,
            toolbar: "#toolbar",
            toggle: "tooltip",
            tooltip: true,
            showFooter: false,
            showLoading: true,
            showExport: true,
            showPaginationSwitch: true,
            exportTypes: ['json', 'xml', 'csv', 'txt', 'excel', 'pdf'],
            exportDataType : "selected",
            mobileResponsive: true,
            showColumns: true,
            showMultiSort: true,
            filterControl: true,
            fixedNumber: 8,
            fixedRightNumber: 10,
            columns: [
                {
                    title: 'state',
                    checkbox: true,
                },
                {
                    field: 'code',
                    title: "Code",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'nom',
                    title: "Nom",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prenom',
                    title: "Prénom",
                    sortable: true,
                    filterControl: "input",
                },
                 {
                    field: 'email',
                    title: "E-mail",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'specialite',
                    title: "Specialité",
                    sortable: true,
                    filterControl: "input",
                },

                {
                    field: 'id',
                    title: "Actions",
                    align: "center",
                    formatter: actionsFormatter,
                    width : "200"
                }
            ]

        });


        function actionsFormatter(value, row, index) {
            return `
                    <div class="btn-group" role="group">

                        <a href="{{ route('medecin.index')}}/${value}" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button data-id="${row.id}" class="deleteBtn btn btn-outline-danger waves-effect btn-xs" data-toggle="tooltip" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </button>

                    </div>`;
        }



        $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault()
            var id = $(this).data("id");

            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: "Annuler",
                customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1',
                closeOnConfirm: false
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    loader();
                    $.ajax({
                        url: "{{route('medecin.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                location.reload();
                            }else{
                                $.unblockUI();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression !'
                                });
                            }

                        },
                        error: function (error) {
                            $.unblockUI();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression  !!!'
                                });
                            location.reload();
                        }
                    });
                }
            });

        });


</script>
@endsection
