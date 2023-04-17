@extends('layout.main')

@section('title', 'Gestion des Feuilles de soins')

@section('content')

<style>
    table th td{
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="card card-box">
            <div class="card-body">

                <h5 class="float-left">Recherche Avancée</h5>
                <a class="float-right" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <div class="collapse multi-collapse py-3" id="multiCollapseExample1">
                                <form action="{{ route('feuille.index') }}" method="GET">
                                    @csrf

                                    <div class="form-row px-1">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Date début</label>
                                                <input autocomplete="off" type="date" class="form-control"  value="{{ request()->input('date_debut') }}" name="date_debut" placeholder="Date début" />
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Date fin</label>
                                                <input autocomplete="off" type="date" class="form-control"  value="{{ request()->input('date_fin') }}" name="date_fin" placeholder="Numero dossier" />
                                            </div>
                                        </div>

                                    </div>



                                    <div class="form-row px-1">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="type_imm">Médécin</label>
                                                <select  class="select2 form-control" name="medecin">
                                                    <option value="none">Choisir un medecin ...</option>
                                                    @foreach ($medecins as $medecin)
                                                        <option {{ request()->input('medecin') == $medecin->id ? 'selected' : '' }} value="{{ $medecin->id }}">{{ $medecin->prenom }}&nbsp;{{ $medecin->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="type_imm">Créer par</label>
                                                <select  class="select2 form-control" name="user_id">
                                                    <option value="none">Choisir un utilisateur ...</option>
                                                    @foreach ($users as $user)
                                                        <option {{ request()->input('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->prenom }}&nbsp;{{ $user->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-row px-1">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="code_compagnie">Code compagnie</label>
                                                <select  class="select2 form-control"  name="code_compagnie">
                                                    <option value="none">Choisir une compagnie ...</option>
                                                    @foreach ($compagnies as $compagnie)
                                                        <option {{ request()->input('code_compagnie') == $compagnie->id ? 'selected' : '' }} value="{{ $compagnie->code }}">{{ $compagnie->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type_imm">Adhérent</label>
                                                <select  class="select2 form-control"  name="adherent">
                                                    <option value="none">Choisir un adhérent ...</option>
                                                    @foreach ($adherents as $adherent)
                                                        <option {{ request()->input('adherent') == $adherent->id ? 'selected' : '' }} value="{{ $adherent->id }}">{{ $adherent->nom }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type_imm">Prestation</label>
                                                <select  class="select2 form-control"  name="prestation">
                                                    <option value="none">Choisir une Prestation ...</option>
                                                    @foreach ($prestations as $prestation)
                                                        <option {{ request()->input('prestation') == $prestation->id ? 'selected' : '' }} value="{{ $prestation->id }}">{{ $prestation->libelle }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row px-1">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Taux</label>
                                                <input  autocomplete="off" type="number" class="form-control" value="{{ request()->input('taux') }}" name="taux" placeholder="taux" />
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Ticket Modérateur</label>
                                                <input id="toFormat3" autocomplete="off" type="text" class="form-control" value="{{ request()->input('ticket_mod') }}" name="ticket_mod" placeholder="ticket modérateur" />
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Tiers payant</label>
                                                <input id="toFormat2" autocomplete="off" type="text" class="form-control" value="{{ request()->input('tiers_payant') }}" name="tiers_payant" placeholder="tiers payant" />
                                            </div>
                                        </div>

                                    </div>



                                    <div class="form-row px-1">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Montant</label>
                                                <input id="toFormat1" autocomplete="off" type="text" class="form-control" value="{{ request()->input('montant') }}"  name="montant" placeholder="montant"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Accord</label>
                                                <select  class="select2 form-control"  name="accord">
                                                    <option value="none">Choisir l'etat de l'accord ...</option>
                                                    <option {{ request()->input('accord') == 'attente' ? 'selected' : '' }} value="attente">Attente</option>
                                                    <option {{ request()->input('accord') == 'validé' ? 'selected' : '' }} value="validé">Validé</option>
                                                    <option {{ request()->input('accord') == 'refusé' ? 'selected' : '' }} value="refusé">Refusé</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Date Accord</label>
                                                <input autocomplete="off" type="date" class="form-control"  value="{{ request()->input('date_accord') }}" name="date_accord" />
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">Motif</label>
                                                <input autocomplete="off" type="text" class="form-control"  value="{{ request()->input('motif') }}" name="motif" placeholder="Motif" />
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row d-flex justify-content-center">
                                        <h5 class="card-title"><button class="btn btn-primary ml-1 mt-1"><i class="fa fa-search mr-1"></i>Lancer la recherche</button>
                                            <a href="{{ request()->url() }}" class="btn btn-danger ml-1 mt-1" type="reset"><i class="fa fa-eraser mr-1"></i> Reinitialiser  </a></h5>
                                    </div>

                                </form>
                        </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    {{-- listes --}}
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-body">

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
            data: @json($soins),
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
                    field: 'created_at',
                    formatter: dateFormatter,
                    title: "Date création",
                    sortable: true,
                    filterControl: "input",

                },
                {
                    field: 'libelle_compagnie',
                    title: "Compagnie",
                    sortable: true,
                    filterControl: "select"
                },
                {
                    field: 'adherent_libelle',
                    title: "Adhérant",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'prestation_libelle',
                    title: "Prestation",
                    sortable: true,
                    filterControl: "select",
                },
                {
                    field:'prestataire_libelle',
                    title: "Prestataire",
                    sortable: true,
                    filterControl: "select"
                },
                {
                    field: 'medecin_libelle',
                    title: "Médecin",
                    sortable: true,
                    filterControl: "input",
                },
                {
                    field: 'user_libelle',
                    title: "Créer Par",
                    sortable: true,
                    filterControl: "input",

                },

            ]

        });

         function dateFormatter(value, row, index){
            if(value){
            let d = new Date(value);
            let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
            let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
            let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
            let hour = new Intl.DateTimeFormat('en', { hour12: false, hour: 'numeric' }).format(d);
                let minute = new Intl.DateTimeFormat('en', { minute: '2-digit' }).format(d);
                   if(parseInt(minute)<10){
                            minute = "0"+minute;
                        }
                        return `${da}/${mo}/${ye} ${hour}:${minute}`
                    }
        }



        function amountFormatter(value, row, index){
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

        function accordFormatter(value, row, index){
            if(value == 'validé'){
              return '<p class="badge badge-success">validé</p>';
            }
            if(value == 'attente'){
              return '<p class="badge badge-warning">Attente</p>';
            }
            if(value == 'refusé'){
              return '<p class="badge badge-danger">refusé</p>';
            }
            return '<p class="badge badge-danger">Erreur</p>';
        }

        $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault()
            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer ce utilisateur ?",
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
                    loader();
                    $(e.target).closest('form').submit();
                }
            });

        });
</script>
<script>
  $(function() {
    $('#toFormat1').maskMoney();
    $('#toFormat2').maskMoney();
    $('#toFormat3').maskMoney();
  })
</script>
@endsection
