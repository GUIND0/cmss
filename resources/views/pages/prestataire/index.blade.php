@extends('layout.main')

@section('title', 'Gestion des Prestataires')

@section('content')

<div class="row">
   
    {{-- liste --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">
                <div id="toolbar" class="btn-group">
                    <a href="{{ route('prestataire.createOrUpdate') }}" id="addRow" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Nouveau prestataire
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
            data: @json($prestataires),
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
                    field: 'libelle',
                    title: "Libellé",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'logo',
                    title: "Logo",
                    sortable: true,
                    filterControl: "input",
                    formatter:ImgFormatter,
                },
                {
                    field: 'pharmacie',
                    title: "Pharmacie",
                    sortable: true,
                    filterControl: "input",
                     formatter:  actifFormatter,
                },
                {
                    field: 'hopital',
                    title: "Hopital",
                    sortable: true,
                    filterControl: "input",
                    formatter:  actifFormatter,
                },
                {
                    field: 'examen',
                    title: "Examen",
                    sortable: true,
                    filterControl: "input",
                    formatter:  actifFormatter,
                },

                {
                    field: 'latitude',
                    title: "Latitude",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'longitude',
                    title: "Longitude",
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

        function actifFormatter(value, row, index){
            if(value == 1){
              return '<span class="badge badge-success">Oui</span>';
            }
            return '<span class="badge badge-danger">Non</span>';
        }
        function ImgFormatter(value, row, index){
            if(value){
            return `<img src="${value}" class="img-fluid" style="max-height: 100px; width="100" heigth="100" />`;

            }else{
                return null;
            }

        }
        function actionsFormatter(value, row, index) {

            return `
                    <div class="btn-group" role="group">
                         <a href="{{ route('prestataire.show','') }}/${row.id}"  class="btn btn-outline-success waves-effect btn-xs" title="Voir"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('prestataire.createOrUpdate')}}/${value}" class="btn btn-outline-primary waves-effect btn-xs" data-toggle="tooltip" title="Modifier">
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
                        url: "{{route('prestataire.delete','')}}/"+id,
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
