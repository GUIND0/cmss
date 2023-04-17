@extends('layout.main')

@section('title', 'Gestion des profils')

@section('first')
  <a href="#">Accueil</a>
@endsection
@section('second')
  <a href="#">Administration</a>
@endsection
@section('third')
  <a href="#">Profil</a>
@endsection

@section('content')

<div class="row">
    @if(!isset($profil))
    {{--create form --}}
    <div class="col-md-4">
        <form action="{{ url('profil') }}" method='POST' role="form" id="form" class="form-horizontal">
        @csrf
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}"
                                    value="{{ old('libelle') }}" placeholder="Libellé" required/>
                            @if($errors->has('libelle'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('libelle') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 col-md-12">
                        <button type="submit" class="btn btn-gradient-primary">Enregistrer</button>
                        <button type="reset" class="btn btn-outline-danger ml-1">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    {{-- end create form --}}
    @else
    {{--edit form --}}
    <div class="col-md-4">
        <form action="{{ route('profil.update', $profil->id) }}" method='POST' role="form" id="form" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="card card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}"
                                    value="{{ $profil->libelle }}" placeholder="Libellé" required/>
                            @if($errors->has('libelle'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('libelle') }}</li>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="offset-md-1 col-md-12">
                        <button type="submit" class="btn btn-gradient-primary">Enregistrer</button>
                        <button type="reset" class="btn btn btn-outline-danger ml-1">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    {{-- end edit form --}}
    @endif
    {{-- liste --}}
    <div class="col-md-8">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('profil.index') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouveau profil
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

        $('#table-javascript').bootstrapTable({
            data: @json($profils),
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
            return `<form action="{{ route('profil.destroy', '')}}/${value}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a href="{{ url('profil')}}/${value}/permission" class="btn btn-outline-dark waves-effect btn-xs" data-toggle="tooltip title="Permissions"> 
                            <i class="fa fa-key"></i> 
                        </a>
                        <a href="{{ url('profil')}}/${value}/edit" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" type="button" class="deleteBtn btn btn-outline-danger waves-effect btn-xs" data-id="${value}" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>`;
        }

        $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault()
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer ce profil ?",
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
                    $(e.target).closest('form').submit();
                }
            });

        });

</script>
@endsection
