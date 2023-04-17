@extends('layout.main')

@section('title', 'Gestion des Compagnies')

@section('content')

<div class="row">
    {{--create form --}}
    <div class="col-md-4">


        <form action="{{ route('compagnie.store') }}" enctype="multipart/form-data" method='POST' role="form" id="form" class="form-horizontal">
            @csrf
        <input type="hidden" name="id" value="{{ $compagnie->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="form-group">
                            <label class="control-label">Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                    value="{{ $compagnie != null ? $compagnie->code : old('code') }}" placeholder="Code" required/>
                            @if($errors->has('code'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('code') }}</li>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}"
                                    value="{{ $compagnie != null ? $compagnie->libelle : old('libelle') }}" placeholder="Libellé" required/>
                            @if($errors->has('libelle'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('libelle') }}</li>
                            </span>
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <img id="preview-image-before-upload" class="img-fluid" src="{{ $compagnie != null ? ($compagnie->logo != '' && $compagnie->logo != null) ? '/'.$compagnie->logo : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                alt="preview image" style="max-height: 150px;">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Logo</label>
                            <input id="image" type="file" name="logo" accept="image/png, image/gif, image/jpeg" class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                    placeholder="Logo" />
                            @if($errors->has('logo'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('logo') }}</li>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-5">
                            <label for="prestataire" class="mt-1">Prestataires</label>
                            <div class="{{ $errors->has('prestataire[]') ? 'is-invalid' : '' }}">
                                <select class="select2 form-control" name="prestataire[]" data-placeholder="Veuillez choisir les prestataires" multiple>
                                    <option></option>
                                    @foreach ($prestataires as $prestataire )
                                        @if(in_array($prestataire->id, $ids))
                                            <option selected value="{{ $prestataire->id }}">{{ $prestataire->libelle }}</option>
                                        @else
                                            <option value="{{ $prestataire->id }}">{{ $prestataire->libelle }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            <div class="invalid-feedback">ce champs est requis</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 ml-1 col-md-12">
                        <button type="submit" class="btn btn-gradient-primary mt-1">Enregistrer</button>
                        <button type="reset" class="btn btn-outline-danger mt-1">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    {{-- liste --}}
    <div class="col-md-8">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('compagnie.index') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouvelle compagnie
                    </a>
                </div>
                <div class="table-responsive table-scrollable">
                    <table class="table table-bordered table-hover" id="table-javascript">
                        <thead class="thead-light"></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end liste --}}
</div>

@endsection
@section('page-script')

<script>
    $(document).ready(function (e) {


        $('#image').change(function(){

        let reader = new FileReader();

        reader.onload = (e) => {

        $('#preview-image-before-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

        });

    });
</script>

<script>

        $('#table-javascript').bootstrapTable({
            data: @json($compagnies),
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
                    field: 'libelle',
                    title: "Libellé",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'logo',
                    title: "LOGO",
                    sortable: true,
                    formatter: logoFormatter
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


        function logoFormatter(value, row, index){
            if(value){
                 return `<img src="/${value}" class="img-fluid" width="100" heigth="100" />`;

            }else{
                return null;
            }
        }


        function actionsFormatter(value, row, index) {
            return `
                    <div class="btn-group" role="group">

                        <a href="{{ route('compagnie.show','')}}/${value}" class="btn btn-outline-warning waves-effect btn-xs" data-toggle="tooltip" title="Voir">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('compagnie.index')}}/${value}" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
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
                        url: "{{route('compagnie.delete','')}}/"+id,
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

                            Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Suppression Impossible !'
                                });
                                 location.reload();
                               
                        }
                    });
                }
            });

        });


</script>
@endsection
