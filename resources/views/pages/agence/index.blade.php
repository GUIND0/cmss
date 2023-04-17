@extends('layout.main')

@section('title', 'Gestion des agences')



@section('content')

<div class="row">
    {{--create form --}}
    <div class="col-md-4">


        <form action="{{ route('agence.store') }}" method='POST' role="form" id="form" class="form-horizontal">
            @csrf
        <input type="hidden" name="id" value="{{ $agence->id ?? '' }}">
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">Libellé <span class="text-danger">*</span></label>
                            <input required type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}"
                                    value="{{ $agence != null ? $agence->libelle : old('libelle') }}" placeholder="Libellé" required/>
                            @if($errors->has('libelle'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('libelle') }}</li>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Code <span class="text-danger">*</span></label>
                            <input required type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                    value="{{ $agence != null ? $agence->code : old('code') }}" placeholder="Code" required/>
                            @if($errors->has('code'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('code') }}</li>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Code Compagnie <span class="text-danger">*</span></label>
                            <select required class="form-control" name="code_compagnie">
                                <option value="">Veuillez choisir une compagnie</option>
                                @foreach ($compagnies as $compagnie)
                                    <option value="{{ $agence != null ? $compagnie->code :  $compagnie->code}}" {{  (old('code_compagnie') == $compagnie->code) || ($agence ? ($agence->code_compagnie == $compagnie->code) : false ) ? 'selected' : '' }} >{{ $compagnie->libelle }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('code_compagnie'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('code_compagnie') }}</li>
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 col-md-12">
                        <button type="submit" class="btn btn-gradient-primary mt-1">Enregistrer</button>
                        <button type="reset" class="btn btn-outline-danger ml-1 mt-1">Annuler</button>
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
                    <a href="{{ route('agence.index') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouvelle agence
                    </a>
                </div>
                <div class="table-responsive  table-scrollable">
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

        $('#table-javascript').bootstrapTable({
            data: @json($agences),
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
            mobileResponsive: false,
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
                    field: 'libelle_compagnie',
                    title: "Code Compagnie",
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

                        <a href="{{ route('agence.index')}}/${value}" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
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
                        url: "{{route('agence.delete','')}}/"+id,
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
                            location.reload();
                        }
                    });
                }
            });

        });


</script>
@endsection
