@extends('layout.main')

@section('title', 'Gestion des utilisateurs')

@section('content')

<div class="row">
    {{-- liste --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('user.create') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouvel utilisateur
                    </a>
                </div>
                <div class="table-responsive table-scrollable">
                    <table class="table text-center table-bordered table-hover" id="table-javascript">
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
            data: @json($users),
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
                    field: 'prenom',
                    title: "Prénom",
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
                    field: 'genre',
                    title: "Genre",
                    sortable: true,
                    filterControl: "select",
                },
                {
                    field: 'email',
                    title: "Email",
                    sortable: true,
                    filterControl: "input",
                },
                  {
                    field: 'telephone',
                    title: "Telephone",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'active',
                    title: "Actif",
                    sortable: true,
                    filterControl: "input",
                    formatter: actifFormatter,
                },
                {
                    field: 'profil',
                    title: "Profil",
                    sortable: true,
                    filterControl: "input",
                    formatter: ProfilFormatter

                },
                {
                    field: 'prestataire_libelle',
                    title: "Prestataire",
                    sortable: true,
                    filterControl: "input",

                },
                {
                    field: 'compagnie_libelle',
                    title: "Compagnie",
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

        function ProfilFormatter(value, row, index){
            if(value == 'admin'){
              return '<p class="badge badge-light-primary" >Admin</p>';
            }
            if(value == 'admin_local'){
              return '<p class="badge badge-light-info">Admin Local</p>';
            }

            return '<p class="badge badge-light-danger" >INCONNU</p>';
        }


        function actionsFormatter(value, row, index) {
            return `<form action="{{ route('user.delete', '')}}/${value}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a href="{{ route('user.create', '')}}/${value}" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                         <button data-id="${row.id}" class="deleteBtn btn btn-outline-danger waves-effect btn-xs" data-toggle="tooltip" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>`;
        }

        function actifFormatter(value, row, index){
            if(value == 1){
              return '<span class="badge badge-success">Oui</span>';
            }
            return '<span class="badge badge-danger">Non</span>';
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
                        url: "{{route('user.delete','')}}/"+id,
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
