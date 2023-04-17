@extends('layout.main')

@section('title', 'Gestion des Compagnies')

@section('content')
<div class="content-body">
    <!-- Knowledge base Jumbotron -->
    <section id="knowledge-base-search">
        <div class="row">
            <div class="col-sm-12 offset-md-2 col-md-8 offset-lg-2 col-lg-8">
                <div class="card  text-center">
                    @if($compagnie->logo != '')
                        <img class="img-thumbnail mx-auto d-block" style="width: 20em; height: 15em;" src="/{{$compagnie->logo}}">
                    @endif
                    <div class="card-body">
                        <h2 class="text-primary">{{ $compagnie->libelle }}</h2>
                        <p class="card-text mb-2">
                            <span>Code: </span><span class="font-weight-bolder">{{ $compagnie->code }}</span>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
     @if ($compagnie_prestataires->isNotEmpty())
    <!--/ Knowledge base Jumbotron -->
    <h2>Prestataires</h2>
    <!-- Knowledge base -->
    <section id="knowledge-base-content">
        <div class="row kb-search-content-info match-height">
            <!-- sales card -->
            @foreach ($compagnie_prestataires as $item)
            <div class="col-md-4 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="">
                        @if ($item->prestataire->logo != null && $item->prestataire->logo != "")
                            <img src="{{$item->prestataire->logo}}" style="width: 15em; height: 10em;" class="card-img-top mx-auto d-block" alt="knowledge-base-image">
                        @else
                            <img src="{{ asset('app-assets/images/background/care.jpg')}}"  class="card-img-top" alt="knowledge-base-image">
                        @endif
                        <div class="card-body text-center">
                            <h4>{{ $item->prestataire->libelle }}</h4>
                            <h3>{{ $item->prestataire->code }}</h3>

                            @if ($item->prestataire->pharmacie === 1)
                               <span class="badge badge-primary badge-glow">PHARMACIE</span>
                            @endif
                            @if ($item->prestataire->hopital === 1)
                                <span class="badge badge-primary badge-glow">HOPITAL</span>
                            @endif
                            @if ($item->prestataire->examen === 1)
                                <span class="badge badge-primary badge-glow">EXAMEN</span>
                            @endif

                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Knowledge base ends -->
    @endif

</div>
@endsection
@section('page-script')

<script>

        $('#table-javascript').bootstrapTable({
            data: @json([]),
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

                        <a href="{{ route('compagnie.index')}}/${value}" class="btn btn-outline-warning waves-effect btn-xs" data-toggle="tooltip" title="Voir">
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
                            location.reload();
                        }
                    });
                }
            });

        });


</script>
@endsection
